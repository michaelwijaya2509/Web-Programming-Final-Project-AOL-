@extends('layouts.app')

@section('title', 'Leaderboard - Scoreboard')

@section('content')

<!-- Hero Section -->
<div class="relative w-full h-[300px] sm:h-[350px] md:h-[400px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-tr from-gray-900 via-transparent to-orange-900/40 z-0"></div>
    
    <img src="https://plus.unsplash.com/premium_photo-1666913667082-c1fecc45275d?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
        alt="Scoreboard Background" 
        class="absolute inset-0 w-full h-full object-cover filter brightness-[0.4]">
    
    <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-12 text-center">
        <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-black text-white mb-4 sm:mb-6 tracking-tight leading-tight drop-shadow-2xl px-2">
            Tournament <br class="hidden sm:block">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FF6700] to-yellow-400">Leaderboard</span>
        </h1>
        
        <p class="text-sm sm:text-base md:text-lg lg:text-xl xl:text-2xl text-gray-200 mb-6 sm:mb-8 md:mb-10 max-w-2xl lg:max-w-3xl mx-auto font-light leading-relaxed px-4">
            Pantau peringkat dan statistik pemain. Lihat siapa yang memimpin pertandingan!
        </p>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-6 xl:px-8 -mt-12 sm:-mt-16 relative z-30 mb-8 sm:mb-12">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 xs:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5 md:gap-6 mb-6 sm:mb-8">
        <!-- Top Player Card -->
        <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-5 md:p-6 transform hover:-translate-y-1 transition-transform duration-300">
            <div class="flex items-center justify-between mb-3 sm:mb-4">
                <div class="bg-white/20 backdrop-blur-sm rounded-full p-2 sm:p-3">
                    <i class="fas fa-crown text-white text-base sm:text-lg md:text-xl"></i>
                </div>
                <span class="text-white/80 text-xs sm:text-sm font-semibold">#1</span>
            </div>
            <h3 class="text-white text-sm sm:text-base md:text-lg font-semibold mb-1 sm:mb-2">Top Player</h3>
            <div class="text-xl sm:text-2xl md:text-3xl font-bold text-white truncate">
                @if(count($rank) > 0)
                    {{ array_key_first($rank) }}
                @else
                    -
                @endif
            </div>
            <div class="mt-3 sm:mt-4 pt-3 sm:pt-4 border-t border-white/20">
                <p class="text-white/90 text-xs sm:text-sm">Pemain dengan kemenangan tertinggi</p>
            </div>
        </div>

        <!-- Total Players Card -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-5 md:p-6 transform hover:-translate-y-1 transition-transform duration-300">
            <div class="flex items-center justify-between mb-3 sm:mb-4">
                <div class="bg-white/20 backdrop-blur-sm rounded-full p-2 sm:p-3">
                    <i class="fas fa-users text-white text-base sm:text-lg md:text-xl"></i>
                </div>
                <span class="text-white/80 text-xs sm:text-sm font-semibold">Aktif</span>
            </div>
            <h3 class="text-white text-sm sm:text-base md:text-lg font-semibold mb-1 sm:mb-2">Total Players</h3>
            <div class="text-xl sm:text-2xl md:text-3xl font-bold text-white">{{ count($players) }}</div>
            <div class="mt-3 sm:mt-4 pt-3 sm:pt-4 border-t border-white/20">
                <p class="text-white/90 text-xs sm:text-sm">Jumlah pemain terdaftar</p>
            </div>
        </div>

        <!-- Total Matches Card -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-5 md:p-6 transform hover:-translate-y-1 transition-transform duration-300">
            <div class="flex items-center justify-between mb-3 sm:mb-4">
                <div class="bg-white/20 backdrop-blur-sm rounded-full p-2 sm:p-3">
                    <i class="fas fa-gamepad text-white text-base sm:text-lg md:text-xl"></i>
                </div>
                <span class="text-white/80 text-xs sm:text-sm font-semibold">Match</span>
            </div>
            <h3 class="text-white text-sm sm:text-base md:text-lg font-semibold mb-1 sm:mb-2">Total Matches</h3>
            @php
                $totalMatches = 0;
                foreach($rank as $stats) {
                    $totalMatches += ($stats['win'] ?? 0) + ($stats['lose'] ?? 0);
                }
            @endphp
            <div class="text-xl sm:text-2xl md:text-3xl font-bold text-white">{{ $totalMatches }}</div>
            <div class="mt-3 sm:mt-4 pt-3 sm:pt-4 border-t border-white/20">
                <p class="text-white/90 text-xs sm:text-sm">Total pertandingan dimainkan</p>
            </div>
        </div>

        <!-- Play Time Card -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl sm:rounded-2xl shadow-lg p-4 sm:p-5 md:p-6 transform hover:-translate-y-1 transition-transform duration-300">
            <div class="flex items-center justify-between mb-3 sm:mb-4">
                <div class="bg-white/20 backdrop-blur-sm rounded-full p-2 sm:p-3">
                    <i class="fas fa-clock text-white text-base sm:text-lg md:text-xl"></i>
                </div>
                <span class="text-white/80 text-xs sm:text-sm font-semibold">Time</span>
            </div>
            <h3 class="text-white text-sm sm:text-base md:text-lg font-semibold mb-1 sm:mb-2">Total Play Time</h3>
            @php
                $totalSeconds = 0;
                foreach($rank as $stats) {
                    $totalSeconds += $stats['total_play_time'] ?? 0;
                }
                $totalHours = floor($totalSeconds / 3600);
                $totalMinutes = floor(($totalSeconds % 3600) / 60);
            @endphp
            <div class="text-xl sm:text-2xl md:text-3xl font-bold text-white">{{ $totalHours }}h {{ $totalMinutes }}m</div>
            <div class="mt-3 sm:mt-4 pt-3 sm:pt-4 border-t border-white/20">
                <p class="text-white/90 text-xs sm:text-sm">Total waktu bermain</p>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="mb-6 sm:mb-8">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-lg sm:rounded-xl p-3 sm:p-4 shadow-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-lg sm:text-xl mr-2 sm:mr-3"></i>
                <div>
                    <p class="font-semibold text-sm sm:text-base">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Leaderboard Table -->
    <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg sm:shadow-xl overflow-hidden border border-gray-200 mb-6 sm:mb-8">
        <!-- Table Header -->
        <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-4 sm:px-6 md:px-8 py-4 sm:py-5 md:py-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0">
                <div>
                    <h2 class="text-lg sm:text-xl md:text-2xl font-bold text-white flex items-center">
                        <i class="fas fa-ranking-star mr-2 sm:mr-3 text-base sm:text-lg md:text-xl"></i> Player Rankings
                    </h2>
                    <p class="text-gray-300 mt-1 text-xs sm:text-sm md:text-base">
                        Peringkat berdasarkan kemenangan dan performa
                    </p>
                </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-lg px-3 sm:px-4 py-1.5 sm:py-2">
                    <span class="text-xs sm:text-sm text-white/80 block text-center">Total Ranking</span>
                    <div class="text-xl sm:text-2xl font-bold text-white text-center">{{ count($rank) }}</div>
                </div>
            </div>
        </div>

        <!-- Table Body -->
        <div class="p-3 sm:p-4 md:p-6">
            @if(count($rank) > 0)
                <div class="overflow-x-auto -mx-3 sm:-mx-4 md:-mx-6">
                    <div class="min-w-full inline-block align-middle">
                        <!-- Mobile Cards View -->
                        <div class="sm:hidden space-y-3">
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
                                        $status = '<span class="bg-gradient-to-r from-gray-400 to-gray-500 text-white px-2 py-1 rounded-full text-xs font-semibold">New</span>';
                                    } elseif ($percentage >= 70) {
                                        $status = '<span class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-2 py-1 rounded-full text-xs font-semibold">Pro</span>';
                                    } elseif ($percentage >= 50) {
                                        $status = '<span class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-2 py-1 rounded-full text-xs font-semibold">Intermediate</span>';
                                    } else {
                                        $status = '<span class="bg-gradient-to-r from-orange-400 to-orange-500 text-white px-2 py-1 rounded-full text-xs font-semibold">Beginner</span>';
                                    }
                                @endphp
                                <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm">
                                    <!-- Header with Rank and Player -->
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center">
                                            <span class="{{ $rankClass }} w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs mr-3">
                                                @if($position <= 3)
                                                    <i class="fas fa-medal text-xs"></i>
                                                @else
                                                    {{ $position }}
                                                @endif
                                            </span>
                                            <div>
                                                <h4 class="font-bold text-gray-900 text-sm truncate max-w-[120px]">{{ $name }}</h4>
                                                <p class="text-xs text-gray-500">Player #{{ $position }}</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            {!! $status !!}
                                        </div>
                                    </div>
                                    
                                    <!-- Stats Row -->
                                    <div class="grid grid-cols-2 gap-3 mb-3">
                                        <!-- W/L -->
                                        <div>
                                            <p class="text-xs text-gray-500 mb-1">W/L</p>
                                            <div class="flex items-center space-x-1">
                                                <span class="bg-gradient-to-r from-green-500 to-green-600 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                                    {{ $win }}W
                                                </span>
                                                <span class="bg-gradient-to-r from-red-500 to-red-600 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                                    {{ $lose }}L
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <!-- Total Games -->
                                        <div>
                                            <p class="text-xs text-gray-500 mb-1">Total Games</p>
                                            <span class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                                {{ $total }}
                                            </span>
                                        </div>
                                        
                                        <!-- Win Rate -->
                                        <div>
                                            <p class="text-xs text-gray-500 mb-1">Win Rate</p>
                                            <span class="font-bold text-gray-900 text-sm">{{ $percentage }}%</span>
                                        </div>
                                        
                                        <!-- Play Time -->
                                        <div>
                                            <p class="text-xs text-gray-500 mb-1">Play Time</p>
                                            <span class="text-gray-900 text-sm font-medium">{{ $playTime }}</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Win Rate Bar -->
                                    <div class="mb-2">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="text-xs font-medium text-gray-700">
                                                @if($percentage >= 70) Excellent
                                                @elseif($percentage >= 50) Good
                                                @elseif($percentage > 0) Fair
                                                @else -
                                                @endif
                                            </span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="h-2 rounded-full 
                                                @if($percentage >= 70) bg-gradient-to-r from-green-500 to-green-600
                                                @elseif($percentage >= 50) bg-gradient-to-r from-blue-500 to-blue-600
                                                @elseif($percentage > 0) bg-gradient-to-r from-orange-400 to-orange-500
                                                @else bg-gray-400
                                                @endif" 
                                                style="width: {{ $percentage }}%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php $position++; @endphp
                            @endforeach
                        </div>

                        <!-- Desktop Table View -->
                        <table class="min-w-full divide-y divide-gray-200 hidden sm:table">
                            <thead>
                                <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                                    <th class="py-3 px-3 md:px-4 text-left">
                                        <span class="text-gray-700 font-semibold text-sm md:text-base">Rank</span>
                                    </th>
                                    <th class="py-3 px-3 md:px-4 text-left">
                                        <span class="text-gray-700 font-semibold text-sm md:text-base">Player</span>
                                    </th>
                                    <th class="py-3 px-3 md:px-4 text-center">
                                        <span class="text-gray-700 font-semibold text-sm md:text-base">W/L</span>
                                    </th>
                                    <th class="py-3 px-3 md:px-4 text-center">
                                        <span class="text-gray-700 font-semibold text-sm md:text-base">Total</span>
                                    </th>
                                    <th class="py-3 px-3 md:px-4 text-center">
                                        <span class="text-gray-700 font-semibold text-sm md:text-base">Win Rate</span>
                                    </th>
                                    <th class="py-3 px-3 md:px-4 text-center">
                                        <span class="text-gray-700 font-semibold text-sm md:text-base">Play Time</span>
                                    </th>
                                    <th class="py-3 px-3 md:px-4 text-center">
                                        <span class="text-gray-700 font-semibold text-sm md:text-base">Status</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
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
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <!-- Rank -->
                                        <td class="py-3 md:py-4 px-3 md:px-4">
                                            <div class="flex items-center">
                                                <span class="{{ $rankClass }} w-8 h-8 md:w-10 md:h-10 rounded-full flex items-center justify-center font-bold text-xs md:text-sm">
                                                    @if($position <= 3)
                                                        <i class="fas fa-medal mr-1 text-xs md:text-sm"></i>
                                                    @endif
                                                    {{ $position }}
                                                </span>
                                            </div>
                                        </td>
                                        
                                        <!-- Player Name -->
                                        <td class="py-3 md:py-4 px-3 md:px-4">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-gradient-to-r from-orange-100 to-red-100 flex items-center justify-center mr-2 md:mr-3">
                                                    <i class="fas fa-user text-orange-500 text-sm md:text-base"></i>
                                                </div>
                                                <div>
                                                    <h4 class="font-bold text-gray-900 text-sm md:text-base truncate max-w-[150px] lg:max-w-[200px]">{{ $name }}</h4>
                                                    <p class="text-xs text-gray-500">Player #{{ $position }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <!-- Wins/Losses -->
                                        <td class="py-3 md:py-4 px-3 md:px-4">
                                            <div class="flex flex-col items-center space-y-1">
                                                <div class="flex space-x-1">
                                                    <span class="bg-gradient-to-r from-green-500 to-green-600 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                                        {{ $win }}W
                                                    </span>
                                                    <span class="bg-gradient-to-r from-red-500 to-red-600 text-white px-2 py-1 rounded-full text-xs font-semibold">
                                                        {{ $lose }}L
                                                    </span>
                                                </div>
                                                @if($diff != 0)
                                                    <div class="text-center">
                                                        <span class="text-xs font-semibold {{ $diff > 0 ? 'text-green-600' : 'text-red-600' }}">
                                                            {{ $diff > 0 ? '+' : '' }}{{ $diff }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        
                                        <!-- Total Games -->
                                        <td class="py-3 md:py-4 px-3 md:px-4">
                                            <div class="text-center">
                                                <span class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-3 py-1.5 md:px-4 md:py-2 rounded-full text-xs md:text-sm font-semibold">
                                                    {{ $total }}
                                                </span>
                                            </div>
                                        </td>
                                        
                                        <!-- Win Rate -->
                                        <td class="py-3 md:py-4 px-3 md:px-4">
                                            <div class="space-y-1 md:space-y-2">
                                                <div class="flex justify-between items-center">
                                                    <span class="text-xs md:text-sm font-medium text-gray-700">
                                                        @if($percentage >= 70) Excellent
                                                        @elseif($percentage >= 50) Good
                                                        @elseif($percentage > 0) Fair
                                                        @else -
                                                        @endif
                                                    </span>
                                                    <span class="text-xs md:text-sm font-bold text-gray-900">{{ $percentage }}%</span>
                                                </div>
                                                <div class="w-full bg-gray-200 rounded-full h-1.5 md:h-2.5">
                                                    <div class="h-1.5 md:h-2.5 rounded-full 
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
                                        <td class="py-3 md:py-4 px-3 md:px-4">
                                            <div class="text-center">
                                                <span class="bg-gradient-to-r from-gray-700 to-gray-800 text-white px-3 py-1.5 md:px-4 md:py-2 rounded-full text-xs md:text-sm font-semibold">
                                                    {{ $playTime }}
                                                </span>
                                            </div>
                                        </td>
                                        
                                        <!-- Status -->
                                        <td class="py-3 md:py-4 px-3 md:px-4">
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
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-8 sm:py-12">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 mx-auto rounded-full bg-gradient-to-br from-orange-100 to-red-100 flex items-center justify-center mb-4 sm:mb-6">
                        <i class="fas fa-trophy text-2xl sm:text-3xl md:text-4xl text-orange-400"></i>
                    </div>
                    <h4 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-800 mb-2 sm:mb-3">Belum ada data leaderboard</h4>
                    <p class="text-gray-600 max-w-xs sm:max-w-md mx-auto mb-6 sm:mb-8 text-sm sm:text-base px-2">
                        Mulai pertandingan pertama Anda untuk melihat peringkat pemain di sini.
                    </p>
                    <a href="/scoreboard/match" class="inline-flex items-center bg-gradient-to-r from-orange-500 to-red-500 text-white px-6 py-2.5 sm:px-8 sm:py-3 rounded-lg font-semibold hover:from-orange-600 hover:to-red-600 transition-all duration-300 shadow-lg hover:shadow-xl text-sm sm:text-base">
                        <i class="fas fa-play mr-2"></i>
                        Start Match
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row justify-between items-center gap-3 sm:gap-4 mb-8 sm:mb-12">
        <div class="flex flex-wrap justify-center sm:justify-start gap-2 sm:gap-3 md:gap-4 w-full sm:w-auto mb-3 sm:mb-0">
            <a href="/scoreboard/match" 
               class="group bg-gradient-to-r from-orange-500 to-red-500 text-white px-5 sm:px-6 md:px-8 py-2.5 sm:py-3 rounded-lg font-semibold hover:from-orange-600 hover:to-red-600 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center text-sm sm:text-base flex-1 sm:flex-none min-w-[140px]">
                <i class="fas fa-plus-circle mr-2"></i>
                New Match
            </a>
            <a href="/scoreboard/setup" 
               class="group bg-gradient-to-r from-gray-700 to-gray-800 text-white px-4 sm:px-5 md:px-6 py-2.5 sm:py-3 rounded-lg font-semibold hover:from-gray-800 hover:to-gray-900 transition-all duration-300 shadow hover:shadow-md flex items-center justify-center text-sm sm:text-base flex-1 sm:flex-none min-w-[120px]">
                <i class="fas fa-cog mr-2"></i>
                Re-setup
            </a>
        </div>
        
        <div class="flex flex-wrap justify-center sm:justify-end gap-2 sm:gap-3 md:gap-4 w-full sm:w-auto">
            <a href="/scoreboard" 
               class="group bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 px-4 sm:px-5 md:px-6 py-2.5 sm:py-3 rounded-lg font-semibold hover:from-gray-200 hover:to-gray-300 transition-all duration-300 shadow-sm hover:shadow flex items-center justify-center text-sm sm:text-base flex-1 sm:flex-none min-w-[140px]">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Players
            </a>
            <form action="/scoreboard/reset" method="POST" class="inline w-full sm:w-auto flex-1 sm:flex-none" onsubmit="return confirm('Reset semua data? Aksi ini tidak dapat dibatalkan!')">
                @csrf
                <button type="submit" 
                        class="group bg-gradient-to-r from-red-500 to-red-600 text-white px-4 sm:px-5 md:px-6 py-2.5 sm:py-3 rounded-lg font-semibold hover:from-red-600 hover:to-red-700 transition-all duration-300 shadow hover:shadow-md flex items-center justify-center text-sm sm:text-base w-full min-w-[120px]">
                    <i class="fas fa-trash-alt mr-2"></i>
                    Reset All
                </button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
    
    @media (max-width: 640px) {
        .xs\:grid-cols-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }
    
    /* Custom scrollbar */
    .overflow-x-auto::-webkit-scrollbar {
        height: 6px;
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
    
    /* Responsive font sizes */
    @media (max-width: 480px) {
        .text-3xl { font-size: 1.75rem; }
        .text-2xl { font-size: 1.5rem; }
        .text-xl { font-size: 1.25rem; }
        .text-lg { font-size: 1.125rem; }
        .text-base { font-size: 1rem; }
        .text-sm { font-size: 0.875rem; }
        .text-xs { font-size: 0.75rem; }
    }
    
    /* Better touch targets for mobile */
    @media (max-width: 640px) {
        button, a, [role="button"] {
            min-height: 44px;
            min-width: 44px;
        }
    }
</style>
@endpush