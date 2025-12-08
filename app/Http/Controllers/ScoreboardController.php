<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScoreboardController extends Controller
{
    public function index()
    {
        $players = session('players', []);
        return view('scoreboard.players', compact('players'));
    }

    // step 1: tambah pemain
    public function addPlayer(Request $request)
    {
        $players = session('players', []);
        $players[] = $request->name;

        session(['players' => $players]);

        return redirect('/scoreboard');
    }

    // step 2: pilih game type
    public function setupGame()
    {
        return view('scoreboard.setup');
    }

    public function saveSetup(Request $request)
    {
        session([
            'game_type'  => $request->game_type, // badminton, tennis, padel
            'mode'       => $request->mode // single, double
        ]);

        return redirect('/scoreboard/match');
    }

    // step 3: match page
    public function match()
    {
        // shuffle player
        $players = session('players', []);
        shuffle($players);

        $mode = session('mode');

        if ($mode === 'single') {
            $teamA = [$players[0]];
            $teamB = [$players[1]];
        } else {
            $teamA = [$players[0], $players[1]];
            $teamB = [$players[2], $players[3]];
        }

        session([
            'current_match' => [
                'teamA' => $teamA,
                'teamB' => $teamB,
                'scoreA' => 0,
                'scoreB' => 0
            ]
        ]);

        return view('scoreboard.match', compact('teamA', 'teamB'));
    }

    // step 4: tambah skor
    public function addPoint(Request $request)
    {
        $match = session('current_match');

        if ($request->team == 'A') {
            $match['scoreA']++;
        } else {
            $match['scoreB']++;
        }

        session(['current_match' => $match]);

        return redirect('/scoreboard/match');
    }

    // step 5: finish match
    public function finishMatch()
    {
        $match  = session('current_match');
        $scores = session('scores', []);

        $winner = $match['scoreA'] > $match['scoreB'] ? 'teamA' : 'teamB';
        $loser  = $winner === 'teamA' ? 'teamB' : 'teamA';

        foreach ($match[$winner] as $player) {
            $scores[$player]['win'] = ($scores[$player]['win'] ?? 0) + 1;
        }

        foreach ($match[$loser] as $player) {
            $scores[$player]['lose'] = ($scores[$player]['lose'] ?? 0) + 1;
        }

        session(['scores' => $scores]);

        return redirect('/scoreboard/leaderboard');
    }

    // step 6: leaderboard
    public function leaderboard()
    {
        $scores = session('scores', []);

        uasort($scores, function ($a, $b) {
            $pointA = ($a['win'] ?? 0) - ($a['lose'] ?? 0);
            $pointB = ($b['win'] ?? 0) - ($b['lose'] ?? 0);
            return $pointB <=> $pointA;
        });

        return view('scoreboard.leaderboard', compact('scores'));
    }

    public function reset()
    {
        session()->flush();
        return redirect('/scoreboard');
    }
}