@extends('layouts.app')

@section('title', 'Leaderboard - Scoreboard')

@section('content')

<!-- Hero Section -->
<div class="relative w-full h-[400px] flex items-center">
    <div class="absolute inset-0 bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 z-0"></div>
    <div class="absolute inset-0 bg-black/30 z-10"></div>
    
    <div class="relative z-20 container mx-auto px-6 md:px-12 text-white">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight drop-shadow-lg">
            Tournament <br>
            Leaderboard
        </h1>
        <p class="text-lg md:text-xl mb-8 max-w-2xl drop-shadow-md text-gray-100">
            Pantau peringkat dan statistik pemain. Lihat siapa yang memimpin pertandingan!
        </p>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-30 mb-12">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Top Player Card -->
        <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl shadow-xl p-6 transform hover:-translate-y-1 transition-transform duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-white/20 backdrop-blur-sm rounded-full p-3">
                    <i class="fas fa-crown text-white text-xl"></i>
                </div>
                <span class="text-white/80 text-sm font-semibold">#1</span>
            </div>
            <h3 class="text-white text-lg font-semibold mb-2">Top Player</h3>
            <div class="text-3xl font-bold text-white">
                @if(count($rank) > 0)
                    {{ array_key_first($rank) }}
                @else
                    -
                @endif
            </div>
            <div class="mt-4 pt-4 border-t border-white/20">
                <p class="text-white/90 text-sm">Pemain dengan kemenangan tertinggi</p>
            </div>
        </div>

        <!-- Total Players Card -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-xl p-6 transform hover:-translate-y-1 transition-transform duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-white/20 backdrop-blur-sm rounded-full p-3">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
                <span class="text-white/80 text-sm font-semibold">Aktif</span>
            </div>
            <h3 class="text-white text-lg font-semibold mb-2">Total Players</h3>
            <div class="text-3xl font-bold text-white">{{ count($players) }}</div>
            <div class="mt-4 pt-4 border-t border-white/20">
                <p class="text-white/90 text-sm">Jumlah pemain terdaftar</p>
            </div>
        </div>

        <!-- Total Matches Card -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl shadow-xl p-6 transform hover:-translate-y-1 transition-transform duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-white/20 backdrop-blur-sm rounded-full p-3">
                    <i class="fas fa-gamepad text-white text-xl"></i>
                </div>
                <span class="text-white/80 text-sm font-semibold">Match</span>
            </div>
            <h3 class="text-white text-lg font-semibold mb-2">Total Matches</h3>
            @php
                $totalMatches = 0;
                foreach($rank as $stats) {
                    $totalMatches += ($stats['win'] ?? 0) + ($stats['lose'] ?? 0);
                }
            @endphp
            <div class="text-3xl font-bold text-white">{{ $totalMatches }}</div>
            <div class="mt-4 pt-4 border-t border-white/20">
                <p class="text-white/90 text-sm">Total pertandingan dimainkan</p>
            </div>
        </div>

        <!-- Play Time Card -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-xl p-6 transform hover:-translate-y-1 transition-transform duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-white/20 backdrop-blur-sm rounded-full p-3">
                    <i class="fas fa-clock text-white text-xl"></i>
                </div>
                <span class="text-white/80 text-sm font-semibold">Time</span>
            </div>
            <h3 class="text-white text-lg font-semibold mb-2">Total Play Time</h3>
            @php
                $totalSeconds = 0;
                foreach($rank as $stats) {
                    $totalSeconds += $stats['total_play_time'] ?? 0;
                }
                $totalHours = floor($totalSeconds / 3600);
                $totalMinutes = floor(($totalSeconds % 3600) / 60);
            @endphp
            <div class="text-3xl font-bold text-white">{{ $totalHours }}h {{ $totalMinutes }}m</div>
            <div class="mt-4 pt-4 border-t border-white/20">
                <p class="text-white/90 text-sm">Total waktu bermain</p>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="mb-8">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl p-4 shadow-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-xl mr-3"></i>
                <div>
                    <p class="font-semibold">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Leaderboard Table -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200 mb-8">
        <!-- Table Header -->
        <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-white">
                        <i class="fas fa-ranking-star mr-3"></i> Player Rankings
                    </h2>
                    <p class="text-gray-300 mt-1">
                        Peringkat berdasarkan kemenangan dan performa
                    </p>
                </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2">
                    <span class="text-sm text-white/80">Total Ranking</span>
                    <div class="text-2xl font-bold text-white text-center">{{ count($rank) }}</div>
                </div>
            </div>
        </div>

        <!-- Table Body -->
        <div class="p-6">
            @if(count($rank) > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                                <th class="py-4 px-4 text-left">
                                    <span class="text-gray-700 font-semibold">Rank</span>
                                </th>
                                <th class="py-4 px-4 text-left">
                                    <span class="text-gray-700 font-semibold">Player</span>
                                </th>
                                <th class="py-4 px-4 text-center">
                                    <span class="text-gray-700 font-semibold">W/L</span>
                                </th>
                                <th class="py-4 px-4 text-center">
                                    <span class="text-gray-700 font-semibold">Total</span>
                                </th>
                                <th class="py-4 px-4 text-center">
                                    <span class="text-gray-700 font-semibold">Win Rate</span>
                                </th>
                                <th class="py-4 px-4 text-center">
                                    <span class="text-gray-700 font-semibold">Play Time</span>
                                </th>
                                <th class="py-4 px-4 text-center">
                                    <span class="text-gray-700 font-semibold">Status</span>
                                </th>
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
                                    
                                    // Rank badge styling
                                    $rankClass = '';
                                    if ($position === 1) {
                                        $rankClass = 'bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray-900';
                                    } elseif ($position === 2) {
                                        $rankClass = 'bg-gradient-to-r from-gray-400 to-gray-500 text-white';
                                    } elseif ($position === 3) {
                                        $rankClass = 'bg-gradient-to-r from-orange-400 to-orange-500 text-white';
                                    } else {
                                        $rankClass = 'bg-gradient-to-r from-gray-200 to-gray-300 text-gray-700';
                                    }
                                    
                                    // Status styling
                                    if ($total === 0) {
                                        $status = '<span class="bg-gradient-to-r from-gray-400 to-gray-500 text-white px-3 py-1 rounded-full text-xs font-semibold">New</span>';
                                    } elseif ($percentage >= 70) {
                                        $status = '<span class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-3 py-1 rounded-full text-xs font-semibold">Pro</span>';
                                    } elseif ($percentage >= 50) {
                                        $status = '<span class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-3 py-1 rounded-full text-xs font-semibold">Intermediate</span>';
                                    } else {
                                        $status = '<span class="bg-gradient-to-r from-orange-400 to-orange-500 text-white px-3 py-1 rounded-full text-xs font-semibold">Beginner</span>';
                                    }
                                @endphp
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors duration-200">
                                    <!-- Rank -->
                                    <td class="py-4 px-4">
                                        <div class="flex items-center">
                                            <span class="{{ $rankClass }} w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm">
                                                @if($position <= 3)
                                                    <i class="fas fa-medal mr-1"></i>
                                                @endif
                                                {{ $position }}
                                            </span>
                                        </div>
                                    </td>
                                    
                                    <!-- Player Name -->
                                    <td class="py-4 px-4">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-orange-100 to-red-100 flex items-center justify-center mr-3">
                                                <i class="fas fa-user text-orange-500"></i>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-gray-900">{{ $name }}</h4>
                                                <p class="text-sm text-gray-500">Player #{{ $position }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <!-- Wins/Losses -->
                                    <td class="py-4 px-4">
                                        <div class="flex justify-center items-center space-x-2">
                                            <span class="bg-gradient-to-r from-green-500 to-green-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                                {{ $win }}W
                                            </span>
                                            <span class="bg-gradient-to-r from-red-500 to-red-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                                {{ $lose }}L
                                            </span>
                                        </div>
                                        @if($diff > 0)
                                            <div class="text-center mt-1">
                                                <span class="text-green-600 text-sm font-semibold">+{{ $diff }}</span>
                                            </div>
                                        @elseif($diff < 0)
                                            <div class="text-center mt-1">
                                                <span class="text-red-600 text-sm font-semibold">{{ $diff }}</span>
                                            </div>
                                        @endif
                                    </td>
                                    
                                    <!-- Total Games -->
                                    <td class="py-4 px-4">
                                        <div class="text-center">
                                            <span class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-2 rounded-full text-sm font-semibold">
                                                {{ $total }} Games
                                            </span>
                                        </div>
                                    </td>
                                    
                                    <!-- Win Rate -->
                                    <td class="py-4 px-4">
                                        <div class="space-y-2">
                                            <div class="flex justify-between items-center">
                                                <span class="text-sm font-medium text-gray-700">
                                                    @if($percentage >= 70) Excellent
                                                    @elseif($percentage >= 50) Good
                                                    @elseif($percentage > 0) Fair
                                                    @else -
                                                    @endif
                                                </span>
                                                <span class="text-sm font-bold text-gray-900">{{ $percentage }}%</span>
                                            </div>
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="h-2.5 rounded-full 
                                                    @if($percentage >= 70) bg-gradient-to-r from-green-500 to-green-600
                                                    @elseif($percentage >= 50) bg-gradient-to-r from-blue-500 to-blue-600
                                                    @elseif($percentage > 0) bg-gradient-to-r from-orange-400 to-orange-500
                                                    @else bg-gray-400
                                                    @endif" 
                                                    style="width: {{ $percentage }}%">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <!-- Play Time -->
                                    <td class="py-4 px-4">
                                        <div class="text-center">
                                            <span class="bg-gradient-to-r from-gray-700 to-gray-800 text-white px-4 py-2 rounded-full text-sm font-semibold">
                                                {{ $playTime }}
                                            </span>
                                        </div>
                                    </td>
                                    
                                    <!-- Status -->
                                    <td class="py-4 px-4">
                                        <div class="text-center">
                                            {!! $status !!}
                                        </div>
                                    </td>
                                </tr>
                                @php $position++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="w-24 h-24 mx-auto rounded-full bg-gradient-to-br from-orange-100 to-red-100 flex items-center justify-center mb-6">
                        <i class="fas fa-trophy text-4xl text-orange-400"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-800 mb-3">Belum ada data leaderboard</h4>
                    <p class="text-gray-600 max-w-md mx-auto mb-8">
                        Mulai pertandingan pertama Anda untuk melihat peringkat pemain di sini.
                    </p>
                    <a href="/scoreboard/match" class="inline-flex items-center bg-gradient-to-r from-orange-500 to-red-500 text-white px-8 py-3 rounded-lg font-semibold hover:from-orange-600 hover:to-red-600 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <i class="fas fa-play mr-2"></i>
                        Start Match
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-12">
        <div class="flex items-center space-x-4">
            <a href="/scoreboard/match" 
               class="group bg-gradient-to-r from-orange-500 to-red-500 text-white px-8 py-3 rounded-lg font-semibold hover:from-orange-600 hover:to-red-600 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center">
                <i class="fas fa-plus-circle mr-2"></i>
                New Match
            </a>
            <a href="/scoreboard/setup" 
               class="group bg-gradient-to-r from-gray-700 to-gray-800 text-white px-6 py-3 rounded-lg font-semibold hover:from-gray-800 hover:to-gray-900 transition-all duration-300 shadow hover:shadow-md flex items-center">
                <i class="fas fa-cog mr-2"></i>
                Re-setup
            </a>
        </div>
        
        <div class="flex items-center space-x-4">
            <a href="/scoreboard" 
               class="group bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:from-gray-200 hover:to-gray-300 transition-all duration-300 shadow-sm hover:shadow flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Players
            </a>
            <form action="/scoreboard/reset" method="POST" class="inline" onsubmit="return confirm('Reset semua data? Aksi ini tidak dapat dibatalkan!')">
                @csrf
                <button type="submit" 
                        class="group bg-gradient-to-r from-red-500 to-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow hover:shadow-md flex items-center">
                    <i class="fas fa-trash-alt mr-2"></i>
                    Reset All
                </button>
            </form>
        </div>
    </div>

    <!-- Additional Info Section -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-yellow-100 to-yellow-50 flex items-center justify-center mb-4">
                <i class="fas fa-crown text-yellow-500 text-xl"></i>
            </div>
            <h4 class="font-bold text-gray-900 mb-2">Ranking System</h4>
            <p class="text-gray-600 text-sm">Sistem peringkat berdasarkan kemenangan, win rate, dan performa keseluruhan.</p>
        </div>
        
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-blue-100 to-blue-50 flex items-center justify-center mb-4">
                <i class="fas fa-chart-simple text-blue-500 text-xl"></i>
            </div>
            <h4 class="font-bold text-gray-900 mb-2">Detailed Stats</h4>
            <p class="text-gray-600 text-sm">Analisis statistik mendalam untuk setiap pemain dengan metrik lengkap.</p>
        </div>
        
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-green-100 to-green-50 flex items-center justify-center mb-4">
                <i class="fas fa-trophy text-green-500 text-xl"></i>
            </div>
            <h4 class="font-bold text-gray-900 mb-2">Achievement Badges</h4>
            <p class="text-gray-600 text-sm">Lencana pencapaian berdasarkan performa dan tingkat pengalaman pemain.</p>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
    
    table {
        border-collapse: separate;
        border-spacing: 0;
    }
    
    thead th {
        position: sticky;
        top: 0;
        z-index: 10;
    }
    
    tbody tr:last-child {
        border-bottom: none;
    }
    
    .progress-bar {
        transition: width 1s ease-in-out;
    }
    
    /* Custom scrollbar */
    .overflow-x-auto::-webkit-scrollbar {
        height: 8px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: linear-gradient(to right, #f97316, #ef4444);
        border-radius: 4px;
    }
    
    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to right, #ea580c, #dc2626);
    }
</style>
@endpush