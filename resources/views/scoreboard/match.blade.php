@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Game Info Header dengan Timer -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card bg-light">
                <div class="card-body py-3">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <h4 class="mb-0">
                                <i class="fas fa-gamepad text-primary me-2"></i>
                                <strong>{{ strtoupper($current['game_type']) }}</strong>
                                <small class="text-muted">| {{ ucfirst($current['mode']) }}</small>
                            </h4>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="timer-display">
                                <i class="fas fa-clock me-1 text-primary"></i>
                                <strong><span id="match-timer">00:00</span></strong>
                                <small class="text-muted d-block">Durasi Permainan</small>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <small class="text-muted">
                                <i class="fas fa-calendar me-1"></i>
                                Dimulai: <span id="start-time">{{ date('H:i', strtotime($current['started_at'])) }}</span>
                            </small>
                        </div>
                        <div class="col-md-3 text-end">
                            @if(isset($current['winner']))
                                <span class="badge bg-success">
                                    <i class="fas fa-flag-checkered me-1"></i> SELESAI
                                </span>
                            @else
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-spinner me-1"></i> BERLANGSUNG
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Auto Redirect Message (Hanya tampil jika sudah selesai) -->
    @if(isset($current['winner']))
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="alert alert-success text-center">
                <h3 class="mb-3">
                    <i class="fas fa-trophy me-2"></i> 
                    <strong>PERTANDINGAN SELESAI!</strong>
                    <i class="fas fa-trophy ms-2"></i>
                </h3>
                <h2 class="mb-4">
                    <span class="badge bg-warning text-dark fs-2 p-3">
                        🏆 TEAM {{ $current['winner'] }} MENANG! 🏆
                    </span>
                </h2>
                
                <!-- Match Summary -->
                <div class="row justify-content-center mb-4">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-md-4">
                                        <h5>Durasi</h5>
                                        <h4 id="final-duration">00:00</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Game Type</h5>
                                        <h4>{{ strtoupper($current['game_type']) }}</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>Mode</h5>
                                        <h4>{{ ucfirst($current['mode']) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Redirect Countdown -->
                <div class="countdown-box">
                    <div class="spinner-border text-primary me-3" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div>
                        <h5 class="mb-1">Mengarahkan ke leaderboard dalam...</h5>
                        <h3 class="mb-0"><span id="countdown">5</span> detik</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Final Score Display -->
    <div class="row mb-5">
        <div class="col-md-5">
            <div class="card {{ $current['winner'] === 'A' ? 'border-success shadow-lg' : 'border-primary' }}">
                <div class="card-header {{ $current['winner'] === 'A' ? 'bg-success text-white' : 'bg-primary text-white' }}">
                    <h4 class="card-title mb-0">
                        @if($current['winner'] === 'A')
                            <i class="fas fa-crown me-2"></i> 
                        @endif
                        TEAM A
                        @if($current['winner'] === 'A')
                            <span class="float-end">🏆 WINNER</span>
                        @endif
                    </h4>
                </div>
                <div class="card-body text-center">
                    <h5 class="text-primary mb-3">
                        @foreach($teamA as $player)
                            <span class="badge bg-light text-dark border">{{ $player }}</span>
                        @endforeach
                    </h5>
                    
                    @if($current['game_type'] === 'badminton')
                        <h1 class="display-1 {{ $current['winner'] === 'A' ? 'text-success' : 'text-primary' }}">
                            {{ $current['pointsA'] }}
                        </h1>
                    @elseif($current['game_type'] === 'tennis')
                        <h4 class="text-muted mb-2">
                            Set: {{ $current['tennis']['setsA'] }} | Game: {{ $current['tennis']['gamesA'] }}
                        </h4>
                        <h1 class="display-1 {{ $current['winner'] === 'A' ? 'text-success' : 'text-primary' }}">
                            @php
                                $scoreMap = [0 => '0', 1 => '15', 2 => '30', 3 => '40'];
                                $displayScore = $scoreMap[$current['tennis']['scoreA']] ?? $current['tennis']['scoreA'];
                            @endphp
                            {{ $displayScore }}
                        </h1>
                    @elseif($current['game_type'] === 'padel')
                        <h4 class="text-muted mb-2">
                            Set 1: {{ $current['sets']['A'][0] }} | 
                            Set 2: {{ $current['sets']['A'][1] }} | 
                            Set 3: {{ $current['sets']['A'][2] }}
                        </h4>
                        <h1 class="display-1 {{ $current['winner'] === 'A' ? 'text-success' : 'text-primary' }}">
                            {{ $current['sets']['A'][$current['current_set_index']] }}
                        </h1>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-2 d-flex align-items-center justify-content-center">
            <div class="text-center">
                <div class="vs-circle bg-gradient-primary text-white mb-3">
                    <h2 class="mb-0">VS</h2>
                </div>
                <div class="final-badge">
                    <span class="badge bg-success fs-5 p-2">
                        <i class="fas fa-flag-checkered me-1"></i> FINAL
                    </span>
                </div>
            </div>
        </div>
        
        <div class="col-md-5">
            <div class="card {{ $current['winner'] === 'B' ? 'border-success shadow-lg' : 'border-danger' }}">
                <div class="card-header {{ $current['winner'] === 'B' ? 'bg-success text-white' : 'bg-danger text-white' }}">
                    <h4 class="card-title mb-0">
                        @if($current['winner'] === 'B')
                            <i class="fas fa-crown me-2"></i> 
                        @endif
                        TEAM B
                        @if($current['winner'] === 'B')
                            <span class="float-end">🏆 WINNER</span>
                        @endif
                    </h4>
                </div>
                <div class="card-body text-center">
                    <h5 class="text-danger mb-3">
                        @foreach($teamB as $player)
                            <span class="badge bg-light text-dark border">{{ $player }}</span>
                        @endforeach
                    </h5>
                    
                    @if($current['game_type'] === 'badminton')
                        <h1 class="display-1 {{ $current['winner'] === 'B' ? 'text-success' : 'text-danger' }}">
                            {{ $current['pointsB'] }}
                        </h1>
                    @elseif($current['game_type'] === 'tennis')
                        <h4 class="text-muted mb-2">
                            Set: {{ $current['tennis']['setsB'] }} | Game: {{ $current['tennis']['gamesB'] }}
                        </h4>
                        <h1 class="display-1 {{ $current['winner'] === 'B' ? 'text-success' : 'text-danger' }}">
                            @php
                                $scoreMap = [0 => '0', 1 => '15', 2 => '30', 3 => '40'];
                                $displayScore = $scoreMap[$current['tennis']['scoreB']] ?? $current['tennis']['scoreB'];
                            @endphp
                            {{ $displayScore }}
                        </h1>
                    @elseif($current['game_type'] === 'padel')
                        <h4 class="text-muted mb-2">
                            Set 1: {{ $current['sets']['B'][0] }} | 
                            Set 2: {{ $current['sets']['B'][1] }} | 
                            Set 3: {{ $current['sets']['B'][2] }}
                        </h4>
                        <h1 class="display-1 {{ $current['winner'] === 'B' ? 'text-success' : 'text-danger' }}">
                            {{ $current['sets']['B'][$current['current_set_index']] }}
                        </h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    @else
    <!-- GAME MASIH BERLANGSUNG -->
    <div class="row mb-5">
        <!-- Team A -->
        <div class="col-md-5">
            <div class="card border-primary shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title mb-0">
                        <i class="fas fa-flag me-2"></i> TEAM A
                    </h4>
                </div>
                <div class="card-body text-center">
                    <!-- Players -->
                    <div class="mb-4">
                        <h5 class="text-primary">
                            @foreach($teamA as $player)
                                <span class="badge bg-light text-dark border border-primary">{{ $player }}</span>
                            @endforeach
                        </h5>
                    </div>
                    
                    <!-- Score Display -->
                    @if($current['game_type'] === 'badminton')
                        <div class="score-display mb-3">
                            <h1 class="display-1 text-primary" id="scoreA">{{ $current['pointsA'] }}</h1>
                        </div>
                        
                        <div class="progress mb-4" style="height: 25px;">
                            @php 
                                $percentage = min(100, ($current['pointsA'] / 21) * 100);
                                $color = $current['pointsA'] >= 21 ? 'bg-success' : 'bg-primary';
                            @endphp
                            <div class="progress-bar {{ $color }} progress-bar-striped progress-bar-animated" 
                                 style="width: {{ $percentage }}%;">
                                <strong>{{ $current['pointsA'] }}/21</strong>
                            </div>
                        </div>
                        
                    @elseif($current['game_type'] === 'tennis')
                        <h6 class="text-muted mb-2">
                            Set: <strong>{{ $current['tennis']['setsA'] }}</strong> | 
                            Game: <strong>{{ $current['tennis']['gamesA'] }}</strong>
                        </h6>
                        
                        <div class="score-display mb-3">
                            <h1 class="display-1 text-primary">
                                @php
                                    $scoreMap = [0 => '0', 1 => '15', 2 => '30', 3 => '40'];
                                    $displayScore = $scoreMap[$current['tennis']['scoreA']] ?? $current['tennis']['scoreA'];
                                @endphp
                                {{ $displayScore }}
                            </h1>
                        </div>
                        
                        @if($current['tennis']['adv'] === 'A')
                            <div class="mb-4">
                                <span class="badge bg-warning text-dark fs-5 p-2">
                                    <i class="fas fa-crown me-1"></i> ADVANTAGE
                                </span>
                            </div>
                        @endif
                        
                    @elseif($current['game_type'] === 'padel')
                        <h6 class="text-muted mb-2">
                            Set Saat Ini: <strong>{{ $current['current_set_index'] + 1 }}</strong>
                        </h6>
                        
                        <div class="score-display mb-3">
                            <h1 class="display-1 text-primary">
                                {{ $current['sets']['A'][$current['current_set_index']] }}
                            </h1>
                        </div>
                        
                        @if($current['in_tiebreak'])
                            <div class="mb-4">
                                <h4 class="text-warning">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    Tiebreak: <strong>{{ $current['tiebreak_points']['A'] }}</strong>
                                </h4>
                            </div>
                        @endif
                        
                        <div class="text-muted small">
                            <div>Set 1: {{ $current['sets']['A'][0] }}</div>
                            <div>Set 2: {{ $current['sets']['A'][1] }}</div>
                            <div>Set 3: {{ $current['sets']['A'][2] }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- VS Center -->
        <div class="col-md-2 d-flex align-items-center justify-content-center">
            <div class="text-center">
                <div class="vs-circle bg-gradient-primary text-white mb-3">
                    <h2 class="mb-0">VS</h2>
                </div>
                
                <!-- Live Timer -->
                <div class="live-timer">
                    <div class="badge bg-info text-white fs-6 p-2">
                        <i class="fas fa-clock me-1"></i>
                        <span id="live-timer">00:00</span>
                    </div>
                </div>
                
                <!-- Reset Timer Button (Hanya untuk debug) -->
                @if(config('app.debug'))
                <div class="mt-2">
                    <button onclick="resetTimer()" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-sync-alt me-1"></i> Reset Timer
                    </button>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Team B -->
        <div class="col-md-5">
            <div class="card border-danger shadow-sm h-100">
                <div class="card-header bg-danger text-white">
                    <h4 class="card-title mb-0">
                        <i class="fas fa-flag me-2"></i> TEAM B
                    </h4>
                </div>
                <div class="card-body text-center">
                    <!-- Players -->
                    <div class="mb-4">
                        <h5 class="text-danger">
                            @foreach($teamB as $player)
                                <span class="badge bg-light text-dark border border-danger">{{ $player }}</span>
                            @endforeach
                        </h5>
                    </div>
                    
                    <!-- Score Display -->
                    @if($current['game_type'] === 'badminton')
                        <div class="score-display mb-3">
                            <h1 class="display-1 text-danger" id="scoreB">{{ $current['pointsB'] }}</h1>
                        </div>
                        
                        <div class="progress mb-4" style="height: 25px;">
                            @php 
                                $percentage = min(100, ($current['pointsB'] / 21) * 100);
                                $color = $current['pointsB'] >= 21 ? 'bg-success' : 'bg-danger';
                            @endphp
                            <div class="progress-bar {{ $color }} progress-bar-striped progress-bar-animated" 
                                 style="width: {{ $percentage }}%;">
                                <strong>{{ $current['pointsB'] }}/21</strong>
                            </div>
                        </div>
                        
                    @elseif($current['game_type'] === 'tennis')
                        <h6 class="text-muted mb-2">
                            Set: <strong>{{ $current['tennis']['setsB'] }}</strong> | 
                            Game: <strong>{{ $current['tennis']['gamesB'] }}</strong>
                        </h6>
                        
                        <div class="score-display mb-3">
                            <h1 class="display-1 text-danger">
                                @php
                                    $scoreMap = [0 => '0', 1 => '15', 2 => '30', 3 => '40'];
                                    $displayScore = $scoreMap[$current['tennis']['scoreB']] ?? $current['tennis']['scoreB'];
                                @endphp
                                {{ $displayScore }}
                            </h1>
                        </div>
                        
                        @if($current['tennis']['adv'] === 'B')
                            <div class="mb-4">
                                <span class="badge bg-warning text-dark fs-5 p-2">
                                    <i class="fas fa-crown me-1"></i> ADVANTAGE
                                </span>
                            </div>
                        @endif
                        
                    @elseif($current['game_type'] === 'padel')
                        <h6 class="text-muted mb-2">
                            Set Saat Ini: <strong>{{ $current['current_set_index'] + 1 }}</strong>
                        </h6>
                        
                        <div class="score-display mb-3">
                            <h1 class="display-1 text-danger">
                                {{ $current['sets']['B'][$current['current_set_index']] }}
                            </h1>
                        </div>
                        
                        @if($current['in_tiebreak'])
                            <div class="mb-4">
                                <h4 class="text-warning">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    Tiebreak: <strong>{{ $current['tiebreak_points']['B'] }}</strong>
                                </h4>
                            </div>
                        @endif
                        
                        <div class="text-muted small">
                            <div>Set 1: {{ $current['sets']['B'][0] }}</div>
                            <div>Set 2: {{ $current['sets']['B'][1] }}</div>
                            <div>Set 3: {{ $current['sets']['B'][2] }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Control Buttons -->
    <div class="row mb-5">
        <div class="col-md-6 text-center">
            <form action="/scoreboard/point" method="POST">
                @csrf
                <input type="hidden" name="team" value="A">
                <button type="submit" class="btn btn-primary btn-lg control-btn" 
                        style="min-width: 200px; min-height: 100px; font-size: 24px;"
                        onclick="addPointAnimation('A')">
                    <div>
                        <i class="fas fa-plus-circle fa-2x mb-2"></i>
                    </div>
                    <div>+1 POINT</div>
                    <div><small>TEAM A</small></div>
                </button>
            </form>
        </div>
        
        <div class="col-md-6 text-center">
            <form action="/scoreboard/point" method="POST">
                @csrf
                <input type="hidden" name="team" value="B">
                <button type="submit" class="btn btn-danger btn-lg control-btn" 
                        style="min-width: 200px; min-height: 100px; font-size: 24px;"
                        onclick="addPointAnimation('B')">
                    <div>
                        <i class="fas fa-plus-circle fa-2x mb-2"></i>
                    </div>
                    <div>+1 POINT</div>
                    <div><small>TEAM B</small></div>
                </button>
            </form>
        </div>
    </div>
    @endif
    
    <!-- Action Buttons -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        @if(isset($current['winner']))
                            <!-- Redirect Button -->
                            <a href="/scoreboard/leaderboard" class="btn btn-success btn-lg mb-2">
                                <i class="fas fa-chart-line me-1"></i> Lihat Leaderboard
                            </a>
                            
                            <!-- New Match Button -->
                            <a href="/scoreboard/match" class="btn btn-warning btn-lg mb-2">
                                <i class="fas fa-redo me-1"></i> Match Baru
                            </a>
                        @else
                            <!-- Manual Finish Button -->
                            <form action="/scoreboard/finish-match" method="POST" class="mb-2">
                                @csrf
                                <button type="submit" 
                                        class="btn btn-warning btn-lg"
                                        onclick="return confirm('Selesaikan pertandingan sekarang? Pemenang akan ditentukan berdasarkan skor saat ini.')">
                                    <i class="fas fa-stop-circle me-1"></i> Selesaikan Sekarang
                                </button>
                            </form>
                        @endif
                        
                        <!-- Setup Button -->
                        <a href="/scoreboard/setup" class="btn btn-secondary btn-lg mb-2">
                            <i class="fas fa-cog me-1"></i> Setup Ulang
                        </a>
                        
                        <!-- Leaderboard Button -->
                        <a href="/scoreboard/leaderboard" class="btn btn-info btn-lg mb-2">
                            <i class="fas fa-chart-line me-1"></i> Leaderboard
                        </a>
                        
                        <!-- Back to Players Button -->
                        <a href="/scoreboard" class="btn btn-outline-primary btn-lg mb-2">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Game Rules Info -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2"></i> Aturan Permainan
                    </h5>
                </div>
                <div class="card-body">
                    @if($current['game_type'] === 'badminton')
                        <p><strong>🏸 Badminton:</strong> First to 21 points (win by 2), cap at 30 points. Game akan otomatis selesai ketika salah satu tim mencapai 21 dengan selisih minimal 2 poin.</p>
                    @elseif($current['game_type'] === 'tennis')
                        <p><strong>🎾 Tennis:</strong> 0-15-30-40-game. Deuce pada 40-40, harus menang 2 poin beruntun. Set: first to 6 games (win by 2). Match: best of 3 sets.</p>
                    @elseif($current['game_type'] === 'padel')
                        <p><strong>🎾 Padel:</strong> First to 6 games (win by 2). Tiebreak di 6-6 (first to 7 win by 2). Match: best of 3 sets.</p>
                    @endif
                    
                    <div class="alert alert-info mt-3 mb-0">
                        <i class="fas fa-lightbulb me-2"></i>
                        <strong>Tips:</strong> Game akan otomatis selesai dan langsung mencatat ke leaderboard ketika pemenang terdeteksi.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.vs-circle {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.timer-display {
    padding: 10px;
    background: rgba(13, 110, 253, 0.1);
    border-radius: 10px;
    border: 2px solid #0d6efd;
}

.live-timer {
    margin-top: 15px;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.winner-badge, .final-badge {
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

.control-btn {
    transition: all 0.2s ease;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    border: none;
    padding: 20px;
    border-radius: 15px;
}

.control-btn:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 6px 20px rgba(0,0,0,0.15);
}

.control-btn:active {
    transform: translateY(1px);
}

.score-display {
    transition: all 0.3s;
}

.score-update {
    animation: scoreUpdate 0.5s ease;
}

@keyframes scoreUpdate {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.countdown-box {
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.2);
    padding: 20px;
    border-radius: 15px;
    margin-top: 20px;
}
</style>

<script>
// Function untuk format waktu (detik ke mm:ss)
function formatTime(seconds) {
    const minutes = Math.floor(seconds / 60);
    const secs = seconds % 60;
    return `${minutes.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
}

// Storage key untuk timer
const TIMER_STORAGE_KEY = 'match_start_time';

// Hitung durasi dari waktu mulai YANG BENAR
function calculateDuration() {
    // Coba ambil waktu mulai dari localStorage (untuk timer client-side)
    const storedStartTime = localStorage.getItem(TIMER_STORAGE_KEY);
    
    if (storedStartTime) {
        // Gunakan waktu dari localStorage
        const startTime = parseInt(storedStartTime);
        const now = Date.now();
        const durationSeconds = Math.floor((now - startTime) / 1000);
        return Math.max(0, durationSeconds); // Pastikan tidak negatif
    } else {
        // Fallback ke waktu server
        const startedAt = new Date("{{ $current['started_at'] }}").getTime();
        const now = new Date().getTime();
        const durationSeconds = Math.floor((now - startedAt) / 1000);
        return Math.max(0, durationSeconds);
    }
}

// Update timer display
function updateTimer() {
    const duration = calculateDuration();
    
    // Update main timer
    const matchTimer = document.getElementById('match-timer');
    if (matchTimer) {
        matchTimer.textContent = formatTime(duration);
    }
    
    // Update live timer
    const liveTimer = document.getElementById('live-timer');
    if (liveTimer) {
        liveTimer.textContent = formatTime(duration);
    }
    
    // Update final duration
    const finalDuration = document.getElementById('final-duration');
    if (finalDuration) {
        finalDuration.textContent = formatTime(duration);
    }
}

// Reset dan mulai timer dari 0
function resetTimer() {
    // Simpan waktu sekarang di localStorage
    localStorage.setItem(TIMER_STORAGE_KEY, Date.now().toString());
    
    // Update waktu mulai di tampilan
    const now = new Date();
    const startTimeElement = document.getElementById('start-time');
    if (startTimeElement) {
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        startTimeElement.textContent = `${hours}:${minutes}`;
    }
    
    // Update display
    updateTimer();
    
    // Tampilkan pesan
    alert('Timer telah direset ke 00:00');
}

// Animation untuk point
function addPointAnimation(team) {
    const scoreElement = document.getElementById(`score${team}`);
    if (scoreElement) {
        scoreElement.classList.remove('score-update');
        void scoreElement.offsetWidth; // Trigger reflow
        scoreElement.classList.add('score-update');
        
        setTimeout(() => {
            scoreElement.classList.remove('score-update');
        }, 500);
    }
}

// Auto-redirect countdown jika game selesai
@if(isset($current['winner']))
let countdown = 5;
const countdownElement = document.getElementById('countdown');
const countdownInterval = setInterval(() => {
    countdown--;
    if (countdownElement) {
        countdownElement.textContent = countdown;
    }
    if (countdown <= 0) {
        clearInterval(countdownInterval);
        window.location.href = '/scoreboard/leaderboard';
    }
}, 1000);
@endif

// Start timer ketika page load
document.addEventListener('DOMContentLoaded', function() {
    // Cek apakah ini match baru (skor masih 0-0)
    const isNewMatch = {{ $current['pointsA'] }} === 0 && {{ $current['pointsB'] }} === 0;
    
    // Cek apakah game sudah selesai
    const isFinished = {{ isset($current['winner']) ? 'true' : 'false' }};
    
    if (isNewMatch && !isFinished) {
        // Jika match baru, reset timer ke 0
        localStorage.setItem(TIMER_STORAGE_KEY, Date.now().toString());
        
        // Update waktu mulai di tampilan
        const now = new Date();
        const startTimeElement = document.getElementById('start-time');
        if (startTimeElement) {
            const hours = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            startTimeElement.textContent = `${hours}:${minutes}`;
        }
    } else if (!localStorage.getItem(TIMER_STORAGE_KEY)) {
        // Jika tidak ada timer di localStorage, set berdasarkan waktu server
        const startedAt = new Date("{{ $current['started_at'] }}").getTime();
        localStorage.setItem(TIMER_STORAGE_KEY, startedAt.toString());
    }
    
    // Start timer
    updateTimer();
    setInterval(updateTimer, 1000); // Update setiap detik
});

// Clear timer storage ketika pindah halaman (opsional)
window.addEventListener('beforeunload', function() {
    // Jangan clear jika game masih berlangsung
    const isFinished = {{ isset($current['winner']) ? 'true' : 'false' }};
    if (isFinished) {
        localStorage.removeItem(TIMER_STORAGE_KEY);
    }
});
</script>
@endsection