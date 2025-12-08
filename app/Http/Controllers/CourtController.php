<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScoreboardController extends Controller
{
    // input player
    public function index()
    {
        $players = session('players', []);
        return view('scoreboard.players', compact('players'));
    }

    // add player (no duplicates)
    public function addPlayer(Request $request)
    {
        $request->validate(['name' => 'required|string|max:50']);
        $players = session('players', []);
        if (!in_array($request->name, $players)) {
            $players[] = $request->name;
            session(['players' => $players]);
        }
        return redirect('/scoreboard');
    }

    // setup game type + mode
    public function setupGame()
    {
        return view('scoreboard.setup');
    }

    // save setup game
    public function saveSetup(Request $request)
    {
        $request->validate([
            'game_type' => 'required|in:badminton,tennis,padel',
            'mode' => 'required|in:single,double'
        ]);

        session([
            'game_type' => $request->game_type,
            'mode' => $request->mode,
            // reset matches & current match state
            'current_match' => null,
            'matches' => session('matches', []),
        ]);

        return redirect('/scoreboard/match');
    }

    // prepare a new match (smart shuffle + init rules state)
    public function match()
    {
        $players = session('players', []);
        if (count($players) < 2) {
            return redirect('/scoreboard')->with('error', 'Butuh minimal 2 pemain.');
        }

        // shuffle but keep original order in session('players') for leaderboard tiebreaker
        $shuffled = $players;
        shuffle($shuffled);

        $mode = session('mode', 'single');
        $game_type = session('game_type', 'badminton');

        // build teams based on mode
        if ($mode === 'single') {
            // take first two players
            $teamA = [$shuffled[0]];
            $teamB = [$shuffled[1] ?? null];
        } else {
            // double: need at least 4 players; if less, fallback to single for remaining
            $teamA = [$shuffled[0], $shuffled[1] ?? null];
            $teamB = [$shuffled[2] ?? null, $shuffled[3] ?? null];
        }

        // initialize current match structure depending on game type
        $current = [
            'teamA' => array_values(array_filter($teamA)),
            'teamB' => array_values(array_filter($teamB)),
            'pointsA' => 0,    // generic point counter (interpretation depends on game_type)
            'pointsB' => 0,
            'game_type' => $game_type,
            // badminton: points are rally points to 21
            // tennis: points are 0/15/30/40/adv tracked via helper
            // padel: we track games_in_set and tiebreak state below
        ];

        if ($game_type === 'padel') {
            // padel uses sets and games
            $current['sets'] = [
                'A' => [0, 0, 0], // games won in set1,set2,set3
                'B' => [0, 0, 0],
            ];
            $current['current_set_index'] = 0; // 0-based index
            $current['in_tiebreak'] = false;
            // tiebreak points if in_tiebreak true
            $current['tiebreak_points'] = ['A' => 0, 'B' => 0];
            $current['best_of_sets'] = 3; // first to 2 sets
        }

        if ($game_type === 'tennis') {
            // tennis: store score state as strings for display and a small state for advantage/deuce
            $current['tennis'] = [
                'scoreA' => 0, // number of points in current game (0,1,2,3 correspond to 0,15,30,40)
                'scoreB' => 0,
                'adv' => null // 'A'|'B' or null
            ];
            // For simplicity we do single game per "match" here; can be extended to games/sets
        }

        // save current match to session
        session(['current_match' => $current]);

        return view('scoreboard.match', [
            'teamA' => $current['teamA'],
            'teamB' => $current['teamB'],
            'current' => $current
        ]);
    }

    // route to add a point to the current match, $team is 'A' or 'B'
    public function addPoint(Request $request)
    {
        $request->validate(['team' => 'required|in:A,B']);

        $current = session('current_match');
        if (!$current) return redirect('/scoreboard')->with('error', 'Tidak ada match aktif.');

        $team = $request->team;
        $opponent = $team === 'A' ? 'B' : 'A';
        $game_type = $current['game_type'];

        if ($game_type === 'badminton') {
            $this->badmintonPoint($current, $team);
        } elseif ($game_type === 'tennis') {
            $this->tennisPoint($current, $team);
        } elseif ($game_type === 'padel') {
            $this->padelPoint($current, $team);
        }

        session(['current_match' => $current]);

        return redirect('/scoreboard/match');
    }

    // finalise the current match (determine winner, update scores, clear current match)
    public function finishMatch()
    {
        $current = session('current_match');
        if (!$current) return redirect('/scoreboard')->with('error', 'Tidak ada match aktif.');

        $winnerTeam = $this->detectMatchWinner($current);
        if (!$winnerTeam) {
            return redirect('/scoreboard/match')->with('error', 'Match belum selesai.');
        }

        $scores = session('scores', []); // structure: [name => ['win'=>int,'lose'=>int,'first_win_ts'=>timestamp?]]

        // update win/lose using team members
        $teamW = $winnerTeam === 'A' ? $current['teamA'] : $current['teamB'];
        $teamL = $winnerTeam === 'A' ? $current['teamB'] : $current['teamA'];

        foreach ($teamW as $p) {
            $scores[$p]['win'] = ($scores[$p]['win'] ?? 0) + 1;
            // set entry order info (first time they won)
            if (!isset($scores[$p]['first_entry_order'])) {
                $players = session('players', []);
                $scores[$p]['first_entry_order'] = array_search($p, $players);
            }
        }

        foreach ($teamL as $p) {
            $scores[$p]['lose'] = ($scores[$p]['lose'] ?? 0) + 1;
            if (!isset($scores[$p]['first_entry_order'])) {
                $players = session('players', []);
                $scores[$p]['first_entry_order'] = array_search($p, $players);
            }
        }

        session(['scores' => $scores]);

        // push finished match to history (optional)
        $matches = session('matches', []);
        $matches[] = $current;
        session(['matches' => $matches]);

        // clear current match to allow next match
        session()->forget('current_match');

        return redirect('/scoreboard/leaderboard');
    }

    // leaderboard view
    public function leaderboard()
    {
        $scores = session('scores', []);
        $players = session('players', []);

        // normalize scores entries
        foreach ($players as $p) {
            if (!isset($scores[$p])) {
                $scores[$p] = ['win' => 0, 'lose' => 0, 'first_entry_order' => array_search($p, $players)];
            } else {
                $scores[$p]['win'] = $scores[$p]['win'] ?? 0;
                $scores[$p]['lose'] = $scores[$p]['lose'] ?? 0;
                $scores[$p]['first_entry_order'] = $scores[$p]['first_entry_order'] ?? array_search($p, $players);
            }
        }

        // compute points and sort
        $rank = $scores;
        uasort($rank, function ($a, $b) {
            $pointsA = ($a['win'] ?? 0) - ($a['lose'] ?? 0);
            $pointsB = ($b['win'] ?? 0) - ($b['lose'] ?? 0);
            if ($pointsA === $pointsB) {
                // tie-breaker: smaller first_entry_order (earlier entry) wins
                return ($a['first_entry_order'] ?? 999) <=> ($b['first_entry_order'] ?? 999);
            }
            return $pointsB <=> $pointsA;
        });

        return view('scoreboard.leaderboard', ['rank' => $rank]);
    }

    // reset everything
    public function reset()
    {
        session()->forget(['players', 'scores', 'matches', 'current_match', 'game_type', 'mode']);
        return redirect('/scoreboard');
    }

    /* ----------------------
       Helper functions below
       ---------------------- */

    // badminton rally point rules: first to 21 win by 2; cap 30
    protected function badmintonPoint(array &$current, string $team)
    {
        if ($team === 'A') $current['pointsA']++;
        else $current['pointsB']++;

        $a = $current['pointsA'];
        $b = $current['pointsB'];

        // check winner
        if (($a >= 21 || $b >= 21) && abs($a - $b) >= 2) {
            // winner found
            $current['winner'] = $a > $b ? 'A' : 'B';
        } elseif ($a === 30 || $b === 30) {
            // cap at 30
            $current['winner'] = $a === 30 ? 'A' : 'B';
        }
    }

    // tennis single-game scoring: 0,15,30,40 -> deuce -> advantage -> game
    protected function tennisPoint(array &$current, string $team)
    {
        // use tennis state
        $state = &$current['tennis'];
        // convert stored numeric to points
        if ($team === 'A') {
            // if currently adv for B and A scores => back to deuce
            if ($state['adv'] === 'B') {
                $state['adv'] = null; // back to deuce
                return;
            }

            // if adv for A and A scores => A wins
            if ($state['adv'] === 'A') {
                $current['winner'] = 'A';
                return;
            }

            // normal increment
            $state['scoreA']++;

        } else {
            if ($state['adv'] === 'A') {
                $state['adv'] = null;
                return;
            }
            if ($state['adv'] === 'B') {
                $current['winner'] = 'B';
                return;
            }
            $state['scoreB']++;
        }

        // check if both at least 3 (40) => deuce logic
        if ($state['scoreA'] >= 3 && $state['scoreB'] >= 3) {
            if ($state['scoreA'] === $state['scoreB']) {
                // deuce
                $state['adv'] = null;
            } elseif ($state['scoreA'] > $state['scoreB']) {
                if ($state['scoreA'] - $state['scoreB'] >= 2) {
                    $current['winner'] = 'A';
                } else {
                    // if lead by 1 after deuce -> advantage A
                    $state['adv'] = 'A';
                }
            } else {
                if ($state['scoreB'] - $state['scoreA'] >= 2) {
                    $current['winner'] = 'B';
                } else {
                    $state['adv'] = 'B';
                }
            }
        } else {
            // if someone reaches 4 before opponent reaches 3 -> wins (i.e., 0,15,30,40 -> next => win)
            if ($state['scoreA'] >= 4 && $state['scoreA'] - $state['scoreB'] >= 1) {
                $current['winner'] = 'A';
            }
            if ($state['scoreB'] >= 4 && $state['scoreB'] - $state['scoreA'] >= 1) {
                $current['winner'] = 'B';
            }
        }
    }

    // padel: track games per set and tiebreak at 6-6
    protected function padelPoint(array &$current, string $team)
    {
        // if currently in tiebreak for set
        $setIndex = $current['current_set_index'];
        $A_games = $current['sets']['A'][$setIndex];
        $B_games = $current['sets']['B'][$setIndex];

        if ($current['in_tiebreak']) {
            // increment tiebreak points
            $current['tiebreak_points'][$team]++;
            $tpA = $current['tiebreak_points']['A'];
            $tpB = $current['tiebreak_points']['B'];
            // tiebreak first to 7 by 2
            if (($tpA >= 7 || $tpB >= 7) && abs($tpA - $tpB) >= 2) {
                // tiebreak winner wins the set
                if ($tpA > $tpB) {
                    $current['sets']['A'][$setIndex]++;
                } else {
                    $current['sets']['B'][$setIndex]++;
                }
                // end tiebreak and reset
                $current['in_tiebreak'] = false;
                $current['tiebreak_points'] = ['A' => 0, 'B' => 0];
                // after finishing set, maybe check match winner below
                $this->checkPadelSetWin($current);
            }
            return;
        }

        // not in tiebreak: adding a point means awarding a game to that team
        // in padel we usually track games not points; for simplicity, we interpret addPoint as awarding a game (caller should call multiple times to increment games)
        if ($team === 'A') {
            $current['sets']['A'][$setIndex]++;
        } else {
            $current['sets']['B'][$setIndex]++;
        }

        // check if set reached 6-6 to start tiebreak
        $A_games = $current['sets']['A'][$setIndex];
        $B_games = $current['sets']['B'][$setIndex];

        if ($A_games === 6 && $B_games === 6) {
            $current['in_tiebreak'] = true;
            $current['tiebreak_points'] = ['A' => 0, 'B' => 0];
            return;
        }

        // normal set win: first to 6 with 2-game margin OR if someone reaches 7 (win by cap)
        if (($A_games >= 6 || $B_games >= 6) && abs($A_games - $B_games) >= 2) {
            // set finished
            $this->checkPadelSetWin($current);
        } elseif ($A_games === 7 || $B_games === 7) {
            // someone reached 7 (possible if no tie-break was used) -> count as set win
            $this->checkPadelSetWin($current);
        }
    }

    // helper: after set finished, advance set index or determine match winner for padel
    protected function checkPadelSetWin(array &$current)
    {
        $idx = $current['current_set_index'];
        $A_games = $current['sets']['A'][$idx];
        $B_games = $current['sets']['B'][$idx];

        // who won this set?
        if ($A_games > $B_games) {
            // A won this set
            // move to next set
        } else {
            // B won
        }

        // advance set index if match not yet decided
        $setsWonA = 0; $setsWonB = 0;
        for ($i = 0; $i < $current['best_of_sets']; $i++) {
            if (($current['sets']['A'][$i] ?? 0) > ($current['sets']['B'][$i] ?? 0)) $setsWonA++;
            if (($current['sets']['B'][$i] ?? 0) > ($current['sets']['A'][$i] ?? 0)) $setsWonB++;
        }

        // if someone reached majority of sets -> set winner of match
        $need = intdiv($current['best_of_sets'], 2) + 1;
        if ($setsWonA >= $need) {
            $current['winner'] = 'A';
        } elseif ($setsWonB >= $need) {
            $current['winner'] = 'B';
        } else {
            // continue to next set
            $current['current_set_index'] = $idx + 1;
        }
    }

    // detect winner for badminton/tennis (current winner is set by helper funcs),
    // for padel we check 'winner' set in checkPadelSetWin
    protected function detectMatchWinner(array $current)
    {
        // if winner key present -> return it
        if (!empty($current['winner'])) return $current['winner'];

        // badminton: winner set in badmintonPoint
        if ($current['game_type'] === 'badminton') {
            return $current['winner'] ?? null;
        }

        // tennis: winner set in tennisPoint
        if ($current['game_type'] === 'tennis') {
            return $current['winner'] ?? null;
        }

        // padel: winner set in checkPadelSetWin
        if ($current['game_type'] === 'padel') {
            return $current['winner'] ?? null;
        }

        return null;
    }
}
