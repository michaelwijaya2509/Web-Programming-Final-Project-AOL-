@extends('layouts.app')

@section('title', 'Live Scoreboard')

@section('content')

<!-- Hero Section -->
<!-- <div class="relative w-full h-[400px] flex items-center">
    <div class="absolute inset-0 bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 z-0"></div>
    <div class="absolute inset-0 bg-black/30 z-10"></div>
    
    <div class="relative z-20 container mx-auto px-6 md:px-12 text-white">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight drop-shadow-lg">
            Live <br>
            Scoreboard Manager
        </h1>
        <p class="text-lg md:text-xl mb-8 max-w-2xl drop-shadow-md text-gray-100">
            Pantau skor secara real-time! Kelola pertandingan dengan sistem scoring otomatis untuk berbagai jenis olahraga.
        </p>
    </div>
</div> -->
<div class="relative w-full h-[400px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-tr from-gray-900 via-transparent to-orange-900/40 z-0"></div>
    
    <img src="https://plus.unsplash.com/premium_photo-1666913667082-c1fecc45275d?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
        alt="Scoreboard Background" class="absolute inset-0 w-full h-full object-cover filter brightness-[0.4]">
    
    <div class="relative z-10 container mx-auto px-6 md:px-12 text-center">
        <h1 class="text-5xl md:text-7xl font-black text-white mb-6 tracking-tight leading-tight drop-shadow-2xl">
            Live <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FF6700] to-yellow-400">Scoreboard Manager</span>
        </h1>
        
        <p class="text-lg md:text-2xl text-gray-200 mb-10 max-w-3xl mx-auto font-light leading-relaxed">
        Pantau skor secara real-time! Kelola pertandingan dengan sistem scoring otomatis untuk berbagai jenis olahraga.
    </p>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-30">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
        
        <!-- Card Body -->
        <div class="p-4 max-w-6xl mx-auto">
    <div class="mb-4">
        <div class="bg-gradient-to-br from-gray-50 to-white rounded-lg border border-gray-200 px-4 py-3 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-md bg-gradient-to-r from-orange-100 to-red-100 flex items-center justify-center shrink-0">
                        <i class="fas fa-info-circle text-orange-600 text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-gray-900 leading-tight">Match Status</h3>
                        <p class="text-gray-500 text-xs">
                            {{ strtoupper($current['game_type']) }} • {{ ucfirst($current['mode']) }}
                        </p>
                    </div>
                </div>
                
                @if(isset($current['winner']))
                <span class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-3 py-1 rounded-md text-xs font-bold shadow-sm">
                    <i class="fas fa-check mr-1"></i> DONE
                </span>
                @else
                <span class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-3 py-1 rounded-md text-xs font-bold animate-pulse shadow-sm">
                    <i class="fas fa-circle mr-1 text-[10px]"></i> LIVE
                </span>
                @endif
            </div>
            
            @if(isset($current['winner']))
            <div class="bg-green-50 rounded-md p-2 mt-2 border border-green-100 flex items-center justify-center gap-2">
                <i class="fas fa-trophy text-yellow-500"></i>
                <span class="text-xs font-bold text-gray-700">MATCH COMPLETED! Redirecting in <span id="countdown" class="text-emerald-600">5</span>s</span>
            </div>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-3 mb-4">
        <div class="lg:col-span-5">
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm group hover:shadow-md transition-all duration-300 h-full">
                <div class="bg-gradient-to-r from-orange-500 to-red-500 px-3 py-2">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded bg-white/20 flex items-center justify-center shrink-0">
                                <i class="fas fa-flag text-white text-xs"></i>
                            </div>
                            <div class="min-w-0">
                                <h3 class="text-white font-bold text-sm leading-none">TEAM A</h3>
                                <p class="text-orange-100 text-xs truncate max-w-[150px] opacity-90">
                                    {{ implode(', ', $teamA) }}
                                </p>
                            </div>
                        </div>
                        @if(isset($current['winner']) && $current['winner'] === 'A')
                        <i class="fas fa-trophy text-yellow-300 text-sm"></i>
                        @endif
                    </div>
                </div>
                
                <div class="p-3">
                    @if($current['game_type'] === 'badminton')
                        <div class="flex items-center justify-between mb-2">
                            <div class="text-4xl font-bold text-gray-900 tracking-tight" id="scoreA">{{ $current['pointsA'] }}</div>
                            <div class="text-right">
                                <div class="text-[10px] text-gray-500 uppercase font-bold">POINTS</div>
                                <div class="text-xs font-medium text-orange-600">{{ $current['pointsA'] }}/21</div>
                            </div>
                        </div>
                        
                        <div class="w-full bg-gray-100 rounded-full h-1.5 mb-3">
                            <div class="h-1.5 rounded-full bg-gradient-to-r from-orange-500 to-red-500 transition-all duration-700 ease-out" 
                                 style="width: {{ min(100, ($current['pointsA'] / 21) * 100) }}%">
                            </div>
                        </div>
                        
                    @elseif($current['game_type'] === 'tennis')
                        <div class="flex justify-between items-center mb-2">
                            <div class="text-center px-2">
                                <div class="text-[10px] text-gray-500">SETS</div>
                                <div class="text-xl font-bold text-gray-900">{{ $current['tennis']['setsA'] }}</div>
                            </div>
                            <div class="text-center px-2 border-l border-r border-gray-100">
                                <div class="text-[10px] text-gray-500">GAMES</div>
                                <div class="text-xl font-bold text-gray-900">{{ $current['tennis']['gamesA'] }}</div>
                            </div>
                            <div class="text-center px-2">
                                <div class="text-[10px] text-gray-500">POINTS</div>
                                @php
                                    $scoreMap = [0 => '0', 1 => '15', 2 => '30', 3 => '40'];
                                    $displayScore = $scoreMap[$current['tennis']['scoreA']] ?? $current['tennis']['scoreA'];
                                @endphp
                                <div class="text-3xl font-bold text-orange-600">{{ $displayScore }}</div>
                            </div>
                        </div>
                        @if($current['tennis']['adv'] === 'A')
                        <div class="text-center bg-yellow-50 text-yellow-700 text-[10px] font-bold py-1 rounded">ADVANTAGE</div>
                        @endif

                    @elseif($current['game_type'] === 'padel')
                        <div class="flex justify-between items-end mb-2">
                            <div>
                                <span class="text-[10px] bg-blue-50 text-blue-600 px-1.5 py-0.5 rounded font-bold">Set {{ $current['current_set_index'] + 1 }}</span>
                                <div class="text-4xl font-bold text-gray-900 leading-none mt-1">{{ $current['sets']['A'][$current['current_set_index']] }}</div>
                            </div>
                            <div class="flex gap-1">
                                @for($i = 0; $i < 3; $i++)
                                <div class="bg-gray-50 rounded p-1 text-center border border-gray-100 w-8">
                                    <div class="text-[9px] text-gray-400">S{{ $i + 1 }}</div>
                                    <div class="text-sm font-bold text-gray-800">{{ $current['sets']['A'][$i] }}</div>
                                </div>
                                @endfor
                            </div>
                        </div>
                        @if($current['in_tiebreak'])
                        <div class="text-center bg-yellow-50 text-yellow-700 text-[10px] font-bold py-1 rounded">Tiebreak: {{ $current['tiebreak_points']['A'] }}</div>
                        @endif

                    @elseif($current['game_type'] === 'pickleball')
                        <!-- Pickleball Display -->
                        <div class="mb-3">
                            <div class="flex justify-between items-center mb-1">
                                <div>
                                    <div class="text-[10px] text-gray-500">GAMES</div>
                                    <div class="text-xl font-bold text-gray-900">{{ $current['pickleball']['gamesA'] }}</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-[10px] text-gray-500">POINTS</div>
                                    <div class="text-4xl font-bold text-orange-600">{{ $current['pickleball']['scoreA'] }}</div>
                                </div>
                                <div>
                                    <div class="text-[10px] text-gray-500">SETS</div>
                                    <div class="text-xl font-bold text-gray-900">{{ $current['pickleball']['setsA'] }}</div>
                                </div>
                            </div>
                            
                            <!-- Progress bar for points -->
                            <div class="w-full bg-gray-100 rounded-full h-1.5 mb-2">
                                <div class="h-1.5 rounded-full bg-gradient-to-r from-orange-500 to-red-500 transition-all duration-700 ease-out" 
                                     style="width: {{ min(100, ($current['pickleball']['scoreA'] / 11) * 100) }}%">
                                </div>
                            </div>
                        </div>

                        <!-- Server Indicator -->
                        @php
                            $isServingA = !isset($current['winner']) && $current['pickleball']['server'] === 'A';
                            $serverText = '';
                            if ($isServingA) {
                                if ($current['mode'] === 'single') {
                                    $serverText = 'Serving';
                                } else {
                                    if ($current['pickleball']['first_server']) {
                                        $serverText = 'Server 1';
                                    } else {
                                        $serverText = 'Server 2';
                                    }
                                }
                            }
                        @endphp
                        
                        @if($isServingA)
                        <div class="bg-gradient-to-r from-orange-100 to-red-100 border border-orange-200 rounded-md p-1.5 mb-2">
                            <div class="flex items-center justify-center gap-1.5">
                                <div class="w-5 h-5 rounded-full bg-gradient-to-r from-orange-500 to-red-500 flex items-center justify-center">
                                    <i class="fas fa-circle text-white text-[8px]"></i>
                                </div>
                                <div class="text-center">
                                    <div class="text-xs font-bold text-orange-700">{{ $serverText }}</div>
                                    @if($current['mode'] === 'single')
                                    <div class="text-[10px] text-orange-600">({{ ucfirst($current['pickleball']['side']) }} side)</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                    @endif

                    <div class="mt-2 pt-2 border-t border-gray-100 flex flex-wrap gap-1.5">
                        @foreach($teamA as $player)
                        <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded bg-gray-50 border border-gray-200 text-xs text-gray-600">
                            <i class="fas fa-user text-[10px] text-orange-400"></i> {{ $player }}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        <div class="lg:col-span-2 flex items-center justify-center py-2 lg:py-0">
            <div class="flex lg:flex-col items-center gap-4 lg:gap-2 w-full justify-center">
                <div class="relative shrink-0">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-r from-orange-500 to-red-500 flex items-center justify-center shadow-md">
                        <span class="text-white font-bold text-sm">VS</span>
                    </div>
                </div>
                
                @if(!isset($current['winner']))
                <div class="bg-gray-800 rounded px-3 py-1 border border-gray-700 shadow-sm">
                    <div class="text-sm font-bold text-white font-mono" id="live-timer">00:00</div>
                </div>
                @else
                <div class="bg-green-100 text-green-700 px-2 py-1 rounded text-[10px] font-bold uppercase">Finished</div>
                @endif
            </div>
        </div>
        
        <div class="lg:col-span-5">
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm group hover:shadow-md transition-all duration-300 h-full">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-3 py-2">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded bg-white/20 flex items-center justify-center shrink-0">
                                <i class="fas fa-flag text-white text-xs"></i>
                            </div>
                            <div class="min-w-0">
                                <h3 class="text-white font-bold text-sm leading-none">TEAM B</h3>
                                <p class="text-blue-100 text-xs truncate max-w-[150px] opacity-90">
                                    {{ implode(', ', $teamB) }}
                                </p>
                            </div>
                        </div>
                        @if(isset($current['winner']) && $current['winner'] === 'B')
                        <i class="fas fa-trophy text-yellow-300 text-sm"></i>
                        @endif
                    </div>
                </div>
                
                <div class="p-3">
                    @if($current['game_type'] === 'badminton')
                        <div class="flex items-center justify-between mb-2">
                            <div class="text-4xl font-bold text-gray-900 tracking-tight" id="scoreB">{{ $current['pointsB'] }}</div>
                            <div class="text-right">
                                <div class="text-[10px] text-gray-500 uppercase font-bold">POINTS</div>
                                <div class="text-xs font-medium text-blue-600">{{ $current['pointsB'] }}/21</div>
                            </div>
                        </div>
                        
                        <div class="w-full bg-gray-100 rounded-full h-1.5 mb-3">
                            <div class="h-1.5 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 transition-all duration-700 ease-out" 
                                 style="width: {{ min(100, ($current['pointsB'] / 21) * 100) }}%">
                            </div>
                        </div>
                        
                    @elseif($current['game_type'] === 'tennis')
                        <div class="flex justify-between items-center mb-2">
                            <div class="text-center px-2">
                                <div class="text-[10px] text-gray-500">SETS</div>
                                <div class="text-xl font-bold text-gray-900">{{ $current['tennis']['setsB'] }}</div>
                            </div>
                            <div class="text-center px-2 border-l border-r border-gray-100">
                                <div class="text-[10px] text-gray-500">GAMES</div>
                                <div class="text-xl font-bold text-gray-900">{{ $current['tennis']['gamesB'] }}</div>
                            </div>
                            <div class="text-center px-2">
                                <div class="text-[10px] text-gray-500">POINTS</div>
                                @php
                                    $scoreMap = [0 => '0', 1 => '15', 2 => '30', 3 => '40'];
                                    $displayScore = $scoreMap[$current['tennis']['scoreB']] ?? $current['tennis']['scoreB'];
                                @endphp
                                <div class="text-3xl font-bold text-blue-600">{{ $displayScore }}</div>
                            </div>
                        </div>
                        @if($current['tennis']['adv'] === 'B')
                        <div class="text-center bg-yellow-50 text-yellow-700 text-[10px] font-bold py-1 rounded">ADVANTAGE</div>
                        @endif

                    @elseif($current['game_type'] === 'padel')
                        <div class="flex justify-between items-end mb-2">
                            <div>
                                <span class="text-[10px] bg-blue-50 text-blue-600 px-1.5 py-0.5 rounded font-bold">Set {{ $current['current_set_index'] + 1 }}</span>
                                <div class="text-4xl font-bold text-gray-900 leading-none mt-1">{{ $current['sets']['B'][$current['current_set_index']] }}</div>
                            </div>
                            <div class="flex gap-1">
                                @for($i = 0; $i < 3; $i++)
                                <div class="bg-gray-50 rounded p-1 text-center border border-gray-100 w-8">
                                    <div class="text-[9px] text-gray-400">S{{ $i + 1 }}</div>
                                    <div class="text-sm font-bold text-gray-800">{{ $current['sets']['B'][$i] }}</div>
                                </div>
                                @endfor
                            </div>
                        </div>
                        @if($current['in_tiebreak'])
                        <div class="text-center bg-yellow-50 text-yellow-700 text-[10px] font-bold py-1 rounded">Tiebreak: {{ $current['tiebreak_points']['B'] }}</div>
                        @endif

                    @elseif($current['game_type'] === 'pickleball')
                        <!-- Pickleball Display -->
                        <div class="mb-3">
                            <div class="flex justify-between items-center mb-1">
                                <div>
                                    <div class="text-[10px] text-gray-500">GAMES</div>
                                    <div class="text-xl font-bold text-gray-900">{{ $current['pickleball']['gamesB'] }}</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-[10px] text-gray-500">POINTS</div>
                                    <div class="text-4xl font-bold text-blue-600">{{ $current['pickleball']['scoreB'] }}</div>
                                </div>
                                <div>
                                    <div class="text-[10px] text-gray-500">SETS</div>
                                    <div class="text-xl font-bold text-gray-900">{{ $current['pickleball']['setsB'] }}</div>
                                </div>
                            </div>
                            
                            <!-- Progress bar for points -->
                            <div class="w-full bg-gray-100 rounded-full h-1.5 mb-2">
                                <div class="h-1.5 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 transition-all duration-700 ease-out" 
                                     style="width: {{ min(100, ($current['pickleball']['scoreB'] / 11) * 100) }}%">
                                </div>
                            </div>
                        </div>

                        <!-- Server Indicator -->
                        @php
                            $isServingB = !isset($current['winner']) && $current['pickleball']['server'] === 'B';
                            $serverText = '';
                            if ($isServingB) {
                                if ($current['mode'] === 'single') {
                                    $serverText = 'Serving';
                                } else {
                                    if ($current['pickleball']['first_server']) {
                                        $serverText = 'Server 1';
                                    } else {
                                        $serverText = 'Server 2';
                                    }
                                }
                            }
                        @endphp
                        
                        @if($isServingB)
                        <div class="bg-gradient-to-r from-blue-100 to-blue-100 border border-blue-200 rounded-md p-1.5 mb-2">
                            <div class="flex items-center justify-center gap-1.5">
                                <div class="w-5 h-5 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center">
                                    <i class="fas fa-circle text-white text-[8px]"></i>
                                </div>
                                <div class="text-center">
                                    <div class="text-xs font-bold text-blue-700">{{ $serverText }}</div>
                                    @if($current['mode'] === 'single')
                                    <div class="text-[10px] text-blue-600">({{ ucfirst($current['pickleball']['side']) }} side)</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                    @endif

                    <div class="mt-2 pt-2 border-t border-gray-100 flex flex-wrap gap-1.5">
                        @foreach($teamB as $player)
                        <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded bg-gray-50 border border-gray-200 text-xs text-gray-600">
                            <i class="fas fa-user text-[10px] text-blue-400"></i> {{ $player }}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(!isset($current['winner']))
    <div class="grid grid-cols-2 gap-3 mb-4">
        <form action="/scoreboard/point" method="POST" class="w-full" id="pointFormA">
            @csrf
            <input type="hidden" name="team" value="A">
            <button type="submit" 
                    class="group w-full bg-gradient-to-r from-orange-500 to-red-500 text-white py-3 rounded-lg hover:from-orange-600 hover:to-red-600 transition-all shadow-sm active:scale-95 flex items-center justify-center gap-2"
                    onclick="addPoint('A')">
                <i class="fas fa-plus-circle text-base"></i>
                <div class="text-left leading-none">
                    <div class="text-sm font-bold">ADD POINT</div>
                    <div class="text-[10px] opacity-80">TEAM A</div>
                </div>
            </button>
        </form>
        
        <form action="/scoreboard/point" method="POST" class="w-full" id="pointFormB">
            @csrf
            <input type="hidden" name="team" value="B">
            <button type="submit" 
                    class="group w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all shadow-sm active:scale-95 flex items-center justify-center gap-2"
                    onclick="addPoint('B')">
                <i class="fas fa-plus-circle text-base"></i>
                <div class="text-left leading-none">
                    <div class="text-sm font-bold">ADD POINT</div>
                    <div class="text-[10px] opacity-80">TEAM B</div>
                </div>
            </button>
        </form>
    </div>
    @endif

    <div class="border-t border-gray-200 pt-3">
        <div class="flex flex-wrap items-center justify-between gap-2">
            <div class="flex gap-2">
                @if(!isset($current['winner']))
                <form action="/scoreboard/finish-match" method="POST">
                    @csrf
                    <button type="submit" 
                            class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg text-xs font-bold transition-colors shadow-sm flex items-center gap-1"
                            onclick="return confirm('Finish match now?')">
                        <i class="fas fa-stop-circle"></i> FINISH
                    </button>
                </form>
                @endif
                
                <a href="/scoreboard/setup" 
                   class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 rounded-lg text-xs font-bold transition-colors flex items-center gap-1">
                    <i class="fas fa-cog"></i> SETUP
                </a>
            </div>
            
            <div class="flex items-center gap-2">
                <a href="/scoreboard/leaderboard" 
                   class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-xs font-bold transition-colors shadow-sm flex items-center gap-1">
                    LEADERBOARD <i class="fas fa-arrow-right"></i>
                </a>
                
                <a href="/scoreboard" 
                   class="text-gray-400 hover:text-gray-600 px-2 py-2 text-xs transition-colors">
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</div>
    </div>

    <!-- Game Rules Section -->
    <div class="p-4 max-w-6xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-4 py-2.5 flex items-center justify-between">
            <h2 class="text-sm font-bold text-white flex items-center gap-2">
                <i class="fas fa-book-open text-orange-500"></i> Rules
            </h2>
            <span class="text-[10px] text-gray-400 font-mono uppercase tracking-wider bg-white/10 px-2 py-0.5 rounded">
                {{ $current['game_type'] }}
            </span>
        </div>
        
        <div class="p-3">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                @if($current['game_type'] === 'badminton')
                <div class="flex gap-3 items-start p-2 rounded-lg border border-gray-100 bg-gray-50 hover:bg-orange-50/50 hover:border-orange-100 transition-colors">
                    <div class="w-7 h-7 rounded bg-white border border-gray-200 flex items-center justify-center shrink-0 mt-0.5 text-orange-500 text-xs">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-900">Winning Condition</h4>
                        <p class="text-[10px] text-gray-500 leading-tight mt-0.5">Best of 3 sets. First to 21 points (win by 2, max 30).</p>
                    </div>
                </div>
                
                <div class="flex gap-3 items-start p-2 rounded-lg border border-gray-100 bg-gray-50 hover:bg-orange-50/50 hover:border-orange-100 transition-colors">
                    <div class="w-7 h-7 rounded bg-white border border-gray-200 flex items-center justify-center shrink-0 mt-0.5 text-orange-500 text-xs">
                        <i class="fas fa-flag-checkered"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-900">Auto Finish</h4>
                        <p class="text-[10px] text-gray-500 leading-tight mt-0.5">System auto-ends match when a team secures 2 sets.</p>
                    </div>
                </div>
                
                <div class="flex gap-3 items-start p-2 rounded-lg border border-gray-100 bg-gray-50 hover:bg-orange-50/50 hover:border-orange-100 transition-colors">
                    <div class="w-7 h-7 rounded bg-white border border-gray-200 flex items-center justify-center shrink-0 mt-0.5 text-orange-500 text-xs">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-900">Rally Point</h4>
                        <p class="text-[10px] text-gray-500 leading-tight mt-0.5">Point every rally. Service alternates automatically.</p>
                    </div>
                </div>

                @elseif($current['game_type'] === 'tennis')
                <div class="flex gap-3 items-start p-2 rounded-lg border border-gray-100 bg-gray-50 hover:bg-blue-50/50 hover:border-blue-100 transition-colors">
                    <div class="w-7 h-7 rounded bg-white border border-gray-200 flex items-center justify-center shrink-0 mt-0.5 text-blue-500 text-xs">
                        <i class="fas fa-list-ol"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-900">Scoring</h4>
                        <p class="text-[10px] text-gray-500 leading-tight mt-0.5">0, 15, 30, 40. Deuce at 40-40 (Advantage rule applies).</p>
                    </div>
                </div>

                <div class="flex gap-3 items-start p-2 rounded-lg border border-gray-100 bg-gray-50 hover:bg-blue-50/50 hover:border-blue-100 transition-colors">
                    <div class="w-7 h-7 rounded bg-white border border-gray-200 flex items-center justify-center shrink-0 mt-0.5 text-blue-500 text-xs">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-900">Sets & Games</h4>
                        <p class="text-[10px] text-gray-500 leading-tight mt-0.5">Best of 3 Sets. First to 6 games wins set (must win by 2).</p>
                    </div>
                </div>

                <div class="flex gap-3 items-start p-2 rounded-lg border border-gray-100 bg-gray-50 hover:bg-blue-50/50 hover:border-blue-100 transition-colors">
                    <div class="w-7 h-7 rounded bg-white border border-gray-200 flex items-center justify-center shrink-0 mt-0.5 text-blue-500 text-xs">
                        <i class="fas fa-gavel"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-900">Tiebreak</h4>
                        <p class="text-[10px] text-gray-500 leading-tight mt-0.5">Played at 6-6 games. First to 7 points (win by 2).</p>
                    </div>
                </div>

                @elseif($current['game_type'] === 'padel')
                <div class="flex gap-3 items-start p-2 rounded-lg border border-gray-100 bg-gray-50 hover:bg-purple-50/50 hover:border-purple-100 transition-colors">
                    <div class="w-7 h-7 rounded bg-white border border-gray-200 flex items-center justify-center shrink-0 mt-0.5 text-purple-500 text-xs">
                        <i class="fas fa-table-tennis"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-900">Format</h4>
                        <p class="text-[10px] text-gray-500 leading-tight mt-0.5">Best of 3 sets. Scoring same as Tennis (15/30/40).</p>
                    </div>
                </div>

                <div class="flex gap-3 items-start p-2 rounded-lg border border-gray-100 bg-gray-50 hover:bg-purple-50/50 hover:border-purple-100 transition-colors">
                    <div class="w-7 h-7 rounded bg-white border border-gray-200 flex items-center justify-center shrink-0 mt-0.5 text-purple-500 text-xs">
                        <i class="fas fa-star"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-900">Golden Point</h4>
                        <p class="text-[10px] text-gray-500 leading-tight mt-0.5">At Deuce (40-40), next point wins the game (No Adv).</p>
                    </div>
                </div>

                <div class="flex gap-3 items-start p-2 rounded-lg border border-gray-100 bg-gray-50 hover:bg-purple-50/50 hover:border-purple-100 transition-colors">
                    <div class="w-7 h-7 rounded bg-white border border-gray-200 flex items-center justify-center shrink-0 mt-0.5 text-purple-500 text-xs">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-900">Set Tiebreak</h4>
                        <p class="text-[10px] text-gray-500 leading-tight mt-0.5">At 6-6 games, tiebreak to 7 points determines winner.</p>
                    </div>
                </div>

                @elseif($current['game_type'] === 'pickleball')
                <!-- Pickleball Rules -->
                <div class="flex gap-3 items-start p-2 rounded-lg border border-gray-100 bg-gray-50 hover:bg-green-50/50 hover:border-green-100 transition-colors">
                    <div class="w-7 h-7 rounded bg-white border border-gray-200 flex items-center justify-center shrink-0 mt-0.5 text-green-500 text-xs">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-900">Winning Condition</h4>
                        <p class="text-[10px] text-gray-500 leading-tight mt-0.5">Best of 3 games. First to 11 points (win by 2).</p>
                    </div>
                </div>

                <div class="flex gap-3 items-start p-2 rounded-lg border border-gray-100 bg-gray-50 hover:bg-green-50/50 hover:border-green-100 transition-colors">
                    <div class="w-7 h-7 rounded bg-white border border-gray-200 flex items-center justify-center shrink-0 mt-0.5 text-green-500 text-xs">
                        <i class="fas fa-tennis-ball"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-900">Scoring System</h4>
                        <p class="text-[10px] text-gray-500 leading-tight mt-0.5">Only serving team scores points. Side-out occurs when receiving team wins rally.</p>
                    </div>
                </div>

                <div class="flex gap-3 items-start p-2 rounded-lg border border-gray-100 bg-gray-50 hover:bg-green-50/50 hover:border-green-100 transition-colors">
                    <div class="w-7 h-7 rounded bg-white border border-gray-200 flex items-center justify-center shrink-0 mt-0.5 text-green-500 text-xs">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-gray-900">Serve Rotation</h4>
                        <p class="text-[10px] text-gray-500 leading-tight mt-0.5">
                            @if($current['mode'] === 'single')
                            Serve alternates sides (right/left) on each point.
                            @else
                            Both players serve before side-out. Server 1 → Server 2 → Side-out.
                            @endif
                        </p>
                    </div>
                </div>
                @endif
            </div>
            
            <div class="mt-2 pt-2 border-t border-gray-100 flex justify-end">
                <span class="text-[9px] text-gray-400 flex items-center gap-1">
                    <i class="fas fa-robot"></i> Auto-Scoring Enabled
                </span>
            </div>
        </div>
    </div>
</div>
</div>

<script>
// Timer
const TIMER_KEY = 'match_start_time';
let timerInterval;

function formatTime(seconds) {
    const min = Math.floor(seconds / 60);
    const sec = seconds % 60;
    return `${min.toString().padStart(2, '0')}:${sec.toString().padStart(2, '0')}`;
}

function updateTimer() {
    const stored = localStorage.getItem(TIMER_KEY);
    let startTime;
    
    if (stored) {
        startTime = parseInt(stored);
    } else {
        startTime = new Date("{{ $current['started_at'] }}").getTime();
        localStorage.setItem(TIMER_KEY, startTime);
    }
    
    const now = Date.now();
    const duration = Math.max(0, Math.floor((now - startTime) / 1000));
    
    ['match-timer', 'live-timer'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.textContent = formatTime(duration);
    });
}

// Point animation
function addPoint(team) {
    const scoreEl = document.getElementById(`score${team}`);
    if (scoreEl) {
        scoreEl.classList.add('scale-110');
        setTimeout(() => scoreEl.classList.remove('scale-110'), 300);
    }
    
    setTimeout(() => {
        const form = document.getElementById(`pointForm${team}`);
        if (form) form.submit();
    }, 200);
}

// Auto-redirect
@if(isset($current['winner']))
let countdown = 5;
const countdownEl = document.getElementById('countdown');
const countdownInterval = setInterval(() => {
    countdown--;
    if (countdownEl) countdownEl.textContent = countdown;
    if (countdown <= 0) {
        clearInterval(countdownInterval);
        window.location.href = '/scoreboard/leaderboard';
    }
}, 1000);
@endif

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    const isNew = {{ $current['pointsA'] }} === 0 && {{ $current['pointsB'] }} === 0;
    const isFinished = {{ isset($current['winner']) ? 'true' : 'false' }};
    
    if (isNew && !isFinished) {
        localStorage.setItem(TIMER_KEY, Date.now().toString());
    }
    
    updateTimer();
    timerInterval = setInterval(updateTimer, 1000);
});

// Cleanup
window.addEventListener('beforeunload', function() {
    clearInterval(timerInterval);
    @if(isset($current['winner']))
    localStorage.removeItem(TIMER_KEY);
    @endif
});
</script>

<style>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

.scale-110 {
    transform: scale(1.1);
    transition: transform 0.3s ease;
}

.active\:scale-95:active {
    transform: scale(0.95);
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.transition-all {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 300ms;
}

.group:hover .group-hover\:translate-x-1 {
    transform: translateX(0.25rem);
}

.font-mono {
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
}

.hover\:shadow-md:hover {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

.hover\:shadow-lg:hover {
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

.backdrop-blur-sm {
    backdrop-filter: blur(4px);
}

/* Smooth transitions for progress bars */
.transition-all {
    transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(to bottom, #f97316, #ef4444);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #ea580c, #dc2626);
}
</style>
@endsection