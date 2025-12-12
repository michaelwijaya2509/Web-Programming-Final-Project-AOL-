@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Header -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-trophy me-2"></i> Leaderboard
                    </h3>
                </div>
                <div class="card-body">
                    <!-- Success Message -->
                    @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    </div>
                    @endif
                    
                    <!-- Stats Summary -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card text-center bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fas fa-crown me-2"></i> Top Player
                                    </h5>
                                    <h3 class="mb-0">
                                        @if(count($rank) > 0)
                                            {{ array_key_first($rank) }}
                                        @else
                                            -
                                        @endif
                                    </h3>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="card text-center bg-info text-white">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fas fa-users me-2"></i> Total Players
                                    </h5>
                                    <h3 class="mb-0">{{ count($players) }}</h3>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="card text-center bg-warning text-white">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fas fa-gamepad me-2"></i> Total Matches
                                    </h5>
                                    @php
                                        $totalMatches = 0;
                                        foreach($rank as $stats) {
                                            $totalMatches += ($stats['win'] ?? 0) + ($stats['lose'] ?? 0);
                                        }
                                    @endphp
                                    <h3 class="mb-0">{{ $totalMatches }}</h3>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="card text-center bg-danger text-white">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fas fa-clock me-2"></i> Total Play Time
                                    </h5>
                                    @php
                                        $totalSeconds = 0;
                                        foreach($rank as $stats) {
                                            $totalSeconds += $stats['total_play_time'] ?? 0;
                                        }
                                        $totalHours = floor($totalSeconds / 3600);
                                        $totalMinutes = floor(($totalSeconds % 3600) / 60);
                                    @endphp
                                    <h3 class="mb-0">{{ $totalHours }}h {{ $totalMinutes }}m</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Leaderboard Table -->
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-ranking-star me-2"></i> Player Rankings
                            </h5>
                        </div>
                        <div class="card-body">
                            @if(count($rank) > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="80">Rank</th>
                                                <th>Player</th>
                                                <th class="text-center">Wins</th>
                                                <th class="text-center">Losses</th>
                                                <th class="text-center">Total</th>
                                                <th class="text-center">W/L Ratio</th>
                                                <th class="text-center">Win Rate</th>
                                                <th class="text-center">Play Time</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $position = 1; @endphp
                                            @foreach($rank as $name => $stats)
                                                @php
                                                    $win = $stats['win'] ?? 0;
                                                    $lose = $stats['lose'] ?? 0;
                                                    $total = $win + $lose;
                                                    $diff = $win - $lose;
                                                    $percentage = $total > 0 ? round(($win / $total) * 100, 1) : 0;
                                                    $playSeconds = $stats['total_play_time'] ?? 0;
                                                    $playHours = floor($playSeconds / 3600);
                                                    $playMinutes = floor(($playSeconds % 3600) / 60);
                                                    $playTime = $playHours > 0 ? "{$playHours}h {$playMinutes}m" : "{$playMinutes}m";
                                                    
                                                    // Rank badge
                                                    $rankBadge = '';
                                                    if ($position === 1) {
                                                        $rankBadge = '<span class="badge bg-warning text-dark"><i class="fas fa-crown"></i> 1st</span>';
                                                    } elseif ($position === 2) {
                                                        $rankBadge = '<span class="badge bg-secondary"><i class="fas fa-medal"></i> 2nd</span>';
                                                    } elseif ($position === 3) {
                                                        $rankBadge = '<span class="badge bg-danger"><i class="fas fa-medal"></i> 3rd</span>';
                                                    } else {
                                                        $rankBadge = '<span class="badge bg-light text-dark">#' . $position . '</span>';
                                                    }
                                                    
                                                    // Status
                                                    if ($total === 0) {
                                                        $status = '<span class="badge bg-secondary">New</span>';
                                                    } elseif ($percentage >= 70) {
                                                        $status = '<span class="badge bg-success">Pro</span>';
                                                    } elseif ($percentage >= 50) {
                                                        $status = '<span class="badge bg-primary">Intermediate</span>';
                                                    } else {
                                                        $status = '<span class="badge bg-warning">Beginner</span>';
                                                    }
                                                @endphp
                                                <tr>
                                                    <td class="text-center">{!! $rankBadge !!}</td>
                                                    <td>
                                                        <strong>{{ $name }}</strong>
                                                        @if($position <= 3)
                                                            <i class="fas fa-star text-warning ms-1"></i>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge bg-success">{{ $win }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge bg-danger">{{ $lose }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge bg-info">{{ $total }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        @if($diff > 0)
                                                            <span class="badge bg-success">+{{ $diff }}</span>
                                                        @elseif($diff < 0)
                                                            <span class="badge bg-danger">{{ $diff }}</span>
                                                        @else
                                                            <span class="badge bg-secondary">{{ $diff }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="progress" style="height: 20px;">
                                                            <div class="progress-bar 
                                                                @if($percentage >= 70) bg-success
                                                                @elseif($percentage >= 50) bg-primary
                                                                @elseif($percentage > 0) bg-warning
                                                                @else bg-secondary
                                                                @endif" 
                                                                style="width: {{ $percentage }}%;">
                                                                {{ $percentage }}%
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge bg-dark">{{ $playTime }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        {!! $status !!}
                                                    </td>
                                                </tr>
                                                @php $position++; @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-trophy fa-4x text-muted mb-3"></i>
                                    <h5 class="text-muted">No leaderboard data yet</h5>
                                    <p class="text-muted">Start a match to see rankings</p>
                                    <a href="/scoreboard/match" class="btn btn-primary mt-2">
                                        <i class="fas fa-play me-1"></i> Start Match
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <div>
                            <a href="/scoreboard/match" class="btn btn-primary">
                                <i class="fas fa-plus-circle me-1"></i> New Match
                            </a>
                            <a href="/scoreboard/setup" class="btn btn-outline-primary ms-2">
                                <i class="fas fa-cog me-1"></i> Re-setup
                            </a>
                        </div>
                        
                        <div>
                            <a href="/scoreboard" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-arrow-left me-1"></i> Back to Players
                            </a>
                            <form action="/scoreboard/reset" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" 
                                        class="btn btn-danger"
                                        onclick="return confirm('Reset all data? This cannot be undone!')">
                                    <i class="fas fa-trash-alt me-1"></i> Reset All
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.table th {
    font-weight: 600;
    background-color: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
}

.table tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.02);
}

.progress {
    border-radius: 10px;
    overflow: hidden;
}

.progress-bar {
    font-size: 12px;
    line-height: 20px;
    font-weight: 600;
}

.card {
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.badge {
    font-size: 0.85em;
    padding: 5px 10px;
}
</style>
@endsection