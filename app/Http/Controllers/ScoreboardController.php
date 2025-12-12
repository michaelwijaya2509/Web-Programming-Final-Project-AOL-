<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

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

    // setup game type + mode - GET
    public function setupGame()
    {
        $players = session('players', []);
        if (count($players) < 2) {
            return redirect('/scoreboard')->with('error', 'Minimal 2 pemain diperlukan.');
        }
        
        return view('scoreboard.setup', compact('players'));
    }

    // save setup game - POST
    public function saveSetup(Request $request)
    {
        $request->validate([
            'game_type' => 'required|in:badminton,tennis,padel',
            'mode' => 'required|in:single,double'
        ]);

        $players = session('players', []);
        
        // Validasi jumlah pemain untuk double
        if ($request->mode === 'double' && count($players) < 4) {
            return redirect('/scoreboard/setup')->with('error', 'Mode double memerlukan minimal 4 pemain.');
        }

        session([
            'game_type' => $request->game_type,
            'mode' => $request->mode,
            'current_match' => null,
            'matches' => session('matches', []),
        ]);

        return redirect('/scoreboard/match');
    }

    // prepare a new match (smart shuffle + init rules state)
    // public function match()
    // {
    //     $players = session('players', []);
    //     if (count($players) < 2) {
    //         return redirect('/scoreboard')->with('error', 'Butuh minimal 2 pemain.');
    //     }

    //     // Check if there's an active match
    //     $current = session('current_match');
    //     if ($current && !isset($current['winner'])) {
    //         // Continue existing match
    //         return view('scoreboard.match', [
    //             'teamA' => $current['teamA'],
    //             'teamB' => $current['teamB'],
    //             'current' => $current
    //         ]);
    //     }

    //     // Create new match
    //     $shuffled = $players;
    //     shuffle($shuffled);

    //     $mode = session('mode', 'single');
    //     $game_type = session('game_type', 'badminton');

    //     // build teams based on mode
    //     if ($mode === 'single') {
    //         $teamA = [$shuffled[0]];
    //         $teamB = [$shuffled[1] ?? null];
    //     } else {
    //         $teamA = [$shuffled[0], $shuffled[1] ?? null];
    //         $teamB = [$shuffled[2] ?? null, $shuffled[3] ?? null];
    //     }

    //     // initialize current match structure depending on game type
    //     $current = [
    //         'teamA' => array_values(array_filter($teamA)),
    //         'teamB' => array_values(array_filter($teamB)),
    //         'pointsA' => 0,
    //         'pointsB' => 0,
    //         'game_type' => $game_type,
    //         'mode' => $mode,
    //         'winner' => null,
    //         'finished' => false,
    //         'started_at' => now()->toDateTimeString(),
    //         'started_timestamp' => now()->timestamp, // Untuk perhitungan durasi
    //     ];

    //     if ($game_type === 'padel') {
    //         $current['sets'] = [
    //             'A' => [0, 0, 0],
    //             'B' => [0, 0, 0],
    //         ];
    //         $current['current_set_index'] = 0;
    //         $current['in_tiebreak'] = false;
    //         $current['tiebreak_points'] = ['A' => 0, 'B' => 0];
    //         $current['best_of_sets'] = 3;
    //     }

    //     if ($game_type === 'tennis') {
    //         $current['tennis'] = [
    //             'scoreA' => 0,
    //             'scoreB' => 0,
    //             'adv' => null,
    //             'gamesA' => 0,
    //             'gamesB' => 0,
    //             'setsA' => 0,
    //             'setsB' => 0,
    //         ];
    //     }

    //     session(['current_match' => $current]);

    //     return view('scoreboard.match', [
    //         'teamA' => $current['teamA'],
    //         'teamB' => $current['teamB'],
    //         'current' => $current
    //     ]);
    // }
    // prepare a new match (smart shuffle + init rules state)
public function match()
{
    $players = session('players', []);
    if (count($players) < 2) {
        return redirect('/scoreboard')->with('error', 'Butuh minimal 2 pemain.');
    }

    // Check if there's an active match
    $current = session('current_match');
    if ($current && !isset($current['winner'])) {
        // Continue existing match - JANGAN reset timer
        return view('scoreboard.match', [
            'teamA' => $current['teamA'],
            'teamB' => $current['teamB'],
            'current' => $current
        ]);
    }

    // Create new match - RESET timer
    $shuffled = $players;
    shuffle($shuffled);

    $mode = session('mode', 'single');
    $game_type = session('game_type', 'badminton');

    // build teams based on mode
    if ($mode === 'single') {
        $teamA = [$shuffled[0]];
        $teamB = [$shuffled[1] ?? null];
    } else {
        $teamA = [$shuffled[0], $shuffled[1] ?? null];
        $teamB = [$shuffled[2] ?? null, $shuffled[3] ?? null];
    }

    // initialize current match structure depending on game type
    $current = [
        'teamA' => array_values(array_filter($teamA)),
        'teamB' => array_values(array_filter($teamB)),
        'pointsA' => 0,
        'pointsB' => 0,
        'game_type' => $game_type,
        'mode' => $mode,
        'winner' => null,
        'finished' => false,
        'started_at' => now()->toDateTimeString(),
        'started_timestamp' => now()->timestamp, // TIMESTAMP SEKARANG
    ];

    if ($game_type === 'padel') {
        $current['sets'] = [
            'A' => [0, 0, 0],
            'B' => [0, 0, 0],
        ];
        $current['current_set_index'] = 0;
        $current['in_tiebreak'] = false;
        $current['tiebreak_points'] = ['A' => 0, 'B' => 0];
        $current['best_of_sets'] = 3;
    }

    if ($game_type === 'tennis') {
        $current['tennis'] = [
            'scoreA' => 0,
            'scoreB' => 0,
            'adv' => null,
            'gamesA' => 0,
            'gamesB' => 0,
            'setsA' => 0,
            'setsB' => 0,
        ];
    }

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
        
        if ($current['finished'] || isset($current['winner'])) {
            return redirect('/scoreboard/match')->with('error', 'Match sudah selesai.');
        }

        $team = $request->team;
        $game_type = $current['game_type'];

        if ($game_type === 'badminton') {
            $this->badmintonPoint($current, $team);
        } elseif ($game_type === 'tennis') {
            $this->tennisPoint($current, $team);
        } elseif ($game_type === 'padel') {
            $this->padelPoint($current, $team);
        }

        // Check if game is finished (winner detected)
        if (isset($current['winner'])) {
            $current['finished'] = true;
            $current['finished_at'] = now()->toDateTimeString();
            $current['finished_timestamp'] = now()->timestamp;
            
            // Auto-process match finish
            $this->processMatchFinish($current);
            
            // Redirect langsung ke leaderboard
            return redirect('/scoreboard/leaderboard')->with('success', 'Pertandingan selesai! Pemenang: Team ' . $current['winner']);
        }

        session(['current_match' => $current]);
        return redirect('/scoreboard/match');
    }

    // manual finish match
    public function finishMatch(Request $request)
    {
        $current = session('current_match');
        if (!$current) return redirect('/scoreboard')->with('error', 'Tidak ada match aktif.');

        // Jika belum ada winner, tetapkan winner berdasarkan skor tertinggi
        if (!isset($current['winner'])) {
            if ($current['game_type'] === 'badminton') {
                $current['winner'] = $current['pointsA'] > $current['pointsB'] ? 'A' : 'B';
            } elseif ($current['game_type'] === 'tennis') {
                if ($current['tennis']['gamesA'] > $current['tennis']['gamesB']) {
                    $current['winner'] = 'A';
                } elseif ($current['tennis']['gamesB'] > $current['tennis']['gamesA']) {
                    $current['winner'] = 'B';
                } else {
                    $current['winner'] = $current['tennis']['scoreA'] > $current['tennis']['scoreB'] ? 'A' : 'B';
                }
            } elseif ($current['game_type'] === 'padel') {
                $setsA = 0; $setsB = 0;
                for ($i = 0; $i < $current['best_of_sets']; $i++) {
                    if (($current['sets']['A'][$i] ?? 0) > ($current['sets']['B'][$i] ?? 0)) $setsA++;
                    if (($current['sets']['B'][$i] ?? 0) > ($current['sets']['A'][$i] ?? 0)) $setsB++;
                }
                $current['winner'] = $setsA > $setsB ? 'A' : 'B';
            }
        }

        $current['finished'] = true;
        $current['finished_at'] = now()->toDateTimeString();
        $current['finished_timestamp'] = now()->timestamp;
        
        // Process match finish
        return $this->processMatchFinish($current);
    }

    // process match finish and update scores
    protected function processMatchFinish($current)
    {
        $scores = session('scores', []);

        // update win/lose using team members
        $teamW = $current['winner'] === 'A' ? $current['teamA'] : $current['teamB'];
        $teamL = $current['winner'] === 'A' ? $current['teamB'] : $current['teamA'];

        foreach ($teamW as $p) {
            if ($p) {
                $scores[$p]['win'] = ($scores[$p]['win'] ?? 0) + 1;
                if (!isset($scores[$p]['first_entry_order'])) {
                    $players = session('players', []);
                    $scores[$p]['first_entry_order'] = array_search($p, $players);
                }
                // Hitung total waktu bermain
                $duration = isset($current['finished_timestamp']) 
                    ? $current['finished_timestamp'] - $current['started_timestamp']
                    : 0;
                $scores[$p]['total_play_time'] = ($scores[$p]['total_play_time'] ?? 0) + $duration;
            }
        }

        foreach ($teamL as $p) {
            if ($p) {
                $scores[$p]['lose'] = ($scores[$p]['lose'] ?? 0) + 1;
                if (!isset($scores[$p]['first_entry_order'])) {
                    $players = session('players', []);
                    $scores[$p]['first_entry_order'] = array_search($p, $players);
                }
                // Hitung total waktu bermain
                $duration = isset($current['finished_timestamp']) 
                    ? $current['finished_timestamp'] - $current['started_timestamp']
                    : 0;
                $scores[$p]['total_play_time'] = ($scores[$p]['total_play_time'] ?? 0) + $duration;
            }
        }

        session(['scores' => $scores]);

        // push finished match to history
        $matches = session('matches', []);
        $matches[] = $current;
        session(['matches' => $matches]);

        // clear current match
        session()->forget('current_match');

        return redirect('/scoreboard/leaderboard')->with('success', 'Pertandingan selesai! Pemenang: Team ' . $current['winner']);
    }

    // leaderboard view
    public function leaderboard()
    {
        $scores = session('scores', []);
        $players = session('players', []);

        // normalize scores entries
        foreach ($players as $p) {
            if (!isset($scores[$p])) {
                $scores[$p] = [
                    'win' => 0, 
                    'lose' => 0, 
                    'first_entry_order' => array_search($p, $players),
                    'total_play_time' => 0
                ];
            } else {
                $scores[$p]['win'] = $scores[$p]['win'] ?? 0;
                $scores[$p]['lose'] = $scores[$p]['lose'] ?? 0;
                $scores[$p]['first_entry_order'] = $scores[$p]['first_entry_order'] ?? array_search($p, $players);
                $scores[$p]['total_play_time'] = $scores[$p]['total_play_time'] ?? 0;
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

        return view('scoreboard.leaderboard', [
            'rank' => $rank,
            'players' => $players
        ]);
    }

    // reset everything
    public function reset()
    {
        session()->forget(['players', 'scores', 'matches', 'current_match', 'game_type', 'mode']);
        return redirect('/scoreboard')->with('success', 'Semua data berhasil direset.');
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
            $current['winner'] = $a > $b ? 'A' : 'B';
        } elseif ($a === 30 || $b === 30) {
            $current['winner'] = $a === 30 ? 'A' : 'B';
        }
    }

    // tennis scoring system
    protected function tennisPoint(array &$current, string $team)
    {
        $state = &$current['tennis'];
        
        if ($team === 'A') {
            if ($state['adv'] === 'B') {
                $state['adv'] = null;
                return;
            }
            if ($state['adv'] === 'A') {
                $state['gamesA']++;
                $this->resetTennisGame($current);
                $this->checkTennisSet($current);
                return;
            }
            $state['scoreA']++;
        } else {
            if ($state['adv'] === 'A') {
                $state['adv'] = null;
                return;
            }
            if ($state['adv'] === 'B') {
                $state['gamesB']++;
                $this->resetTennisGame($current);
                $this->checkTennisSet($current);
                return;
            }
            $state['scoreB']++;
        }

        if ($state['scoreA'] >= 4 && $state['scoreA'] - $state['scoreB'] >= 2) {
            $state['gamesA']++;
            $this->resetTennisGame($current);
            $this->checkTennisSet($current);
        } elseif ($state['scoreB'] >= 4 && $state['scoreB'] - $state['scoreA'] >= 2) {
            $state['gamesB']++;
            $this->resetTennisGame($current);
            $this->checkTennisSet($current);
        } elseif ($state['scoreA'] >= 3 && $state['scoreB'] >= 3) {
            if ($state['scoreA'] === $state['scoreB']) {
                $state['adv'] = null;
            } elseif ($state['scoreA'] - $state['scoreB'] === 1) {
                $state['adv'] = 'A';
            } elseif ($state['scoreB'] - $state['scoreA'] === 1) {
                $state['adv'] = 'B';
            }
        }
    }

    protected function resetTennisGame(array &$current)
    {
        $current['tennis']['scoreA'] = 0;
        $current['tennis']['scoreB'] = 0;
        $current['tennis']['adv'] = null;
    }

    protected function checkTennisSet(array &$current)
    {
        $state = &$current['tennis'];
        
        if ($state['gamesA'] >= 6 && $state['gamesA'] - $state['gamesB'] >= 2) {
            $state['setsA']++;
            $state['gamesA'] = 0;
            $state['gamesB'] = 0;
        } elseif ($state['gamesB'] >= 6 && $state['gamesB'] - $state['gamesA'] >= 2) {
            $state['setsB']++;
            $state['gamesA'] = 0;
            $state['gamesB'] = 0;
        } elseif ($state['gamesA'] === 7 || $state['gamesB'] === 7) {
            if ($state['gamesA'] === 7) {
                $state['setsA']++;
            } else {
                $state['setsB']++;
            }
            $state['gamesA'] = 0;
            $state['gamesB'] = 0;
        }

        // Check for match win (best of 3 sets)
        if ($state['setsA'] >= 2) {
            $current['winner'] = 'A';
        } elseif ($state['setsB'] >= 2) {
            $current['winner'] = 'B';
        }
    }

    // padel scoring
    protected function padelPoint(array &$current, string $team)
    {
        $setIndex = $current['current_set_index'];
        $A_games = $current['sets']['A'][$setIndex];
        $B_games = $current['sets']['B'][$setIndex];

        if ($current['in_tiebreak']) {
            $current['tiebreak_points'][$team]++;
            $tpA = $current['tiebreak_points']['A'];
            $tpB = $current['tiebreak_points']['B'];
            
            if (($tpA >= 7 || $tpB >= 7) && abs($tpA - $tpB) >= 2) {
                if ($tpA > $tpB) {
                    $current['sets']['A'][$setIndex]++;
                } else {
                    $current['sets']['B'][$setIndex]++;
                }
                $current['in_tiebreak'] = false;
                $current['tiebreak_points'] = ['A' => 0, 'B' => 0];
                $this->checkPadelSetWin($current);
            }
            return;
        }

        if ($team === 'A') {
            $current['sets']['A'][$setIndex]++;
        } else {
            $current['sets']['B'][$setIndex]++;
        }

        $A_games = $current['sets']['A'][$setIndex];
        $B_games = $current['sets']['B'][$setIndex];

        if ($A_games === 6 && $B_games === 6) {
            $current['in_tiebreak'] = true;
            $current['tiebreak_points'] = ['A' => 0, 'B' => 0];
            return;
        }

        if (($A_games >= 6 || $B_games >= 6) && abs($A_games - $B_games) >= 2) {
            $this->checkPadelSetWin($current);
        } elseif ($A_games === 7 || $B_games === 7) {
            $this->checkPadelSetWin($current);
        }
    }

    protected function checkPadelSetWin(array &$current)
    {
        $setsWonA = 0; $setsWonB = 0;
        for ($i = 0; $i < $current['best_of_sets']; $i++) {
            if (($current['sets']['A'][$i] ?? 0) > ($current['sets']['B'][$i] ?? 0)) $setsWonA++;
            if (($current['sets']['B'][$i] ?? 0) > ($current['sets']['A'][$i] ?? 0)) $setsWonB++;
        }

        $need = intdiv($current['best_of_sets'], 2) + 1;
        if ($setsWonA >= $need) {
            $current['winner'] = 'A';
        } elseif ($setsWonB >= $need) {
            $current['winner'] = 'B';
        } else {
            $current['current_set_index']++;
        }
    }
}