@extends('layouts.app')

@section('title', 'Setup Game - Scoreboard')

@section('content')

<!-- Hero Section -->
<!-- <div class="relative w-full h-[400px] flex items-center">
    <div class="absolute inset-0 bg-gradient-to-r from-orange-500 via-red-500 to-orange-600 z-0"></div>
    <div class="absolute inset-0 bg-black/30 z-10"></div>
    
    <div class="relative z-20 container mx-auto px-6 md:px-12 text-white">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 leading-tight drop-shadow-lg">
            Tournament <br>
            Scoreboard Manager
        </h1>
        <p class="text-lg md:text-xl mb-8 max-w-2xl drop-shadow-md text-gray-100">
            Konfigurasi pertandingan dan pilih mode permainan. Mulai kompetisi dengan mudah!
        </p>
    </div>
</div> -->
<div class="relative w-full h-[400px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-tr from-gray-900 via-transparent to-orange-900/40 z-0"></div>
    
    <img src="https://plus.unsplash.com/premium_photo-1666913667082-c1fecc45275d?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
        alt="Scoreboard Background" class="absolute inset-0 w-full h-full object-cover filter brightness-[0.4]">
    
    <div class="relative z-10 container mx-auto px-6 md:px-12 text-center">
        <!-- <div class="inline-block mb-6 animate-fade-in-down">
            <span class="py-1 px-3 rounded-full bg-orange-500/20 border border-[#FF6700] text-[#FF6700] text-sm font-bold tracking-widest uppercase backdrop-blur-sm">
                Tournament Scoreboard
            </span>
        </div> -->
        
        <h1 class="text-5xl md:text-7xl font-black text-white mb-6 tracking-tight leading-tight drop-shadow-2xl">
            Tournament <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FF6700] to-yellow-400">Scoreboard Manager</span>
        </h1>
        
        <p class="text-lg md:text-2xl text-gray-200 mb-10 max-w-3xl mx-auto font-light leading-relaxed">
            Konfigurasi pertandingan dan pilih mode permainan. Mulai kompetisi dengan mudah!
        </p>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-30">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
        
        <!-- Card Header -->
        <div class="bg-gradient-to-r from-orange-500 to-red-500 px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-white">
                        <i class="fas fa-cogs mr-3"></i> Setup Game
                    </h2>
                    <p class="text-orange-100 mt-1">
                        Konfigurasi jenis permainan dan format pertandingan
                    </p>
                </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2">
                    <span class="text-sm text-white/80">Total Pemain</span>
                    <div class="text-2xl font-bold text-white text-center">{{ count($players) }}</div>
                </div>
            </div>
        </div>

        <!-- Card Body -->
        <div class="p-8">
            <!-- Player List -->
            <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl border border-gray-200 p-6 mb-8 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-users text-orange-500 mr-2"></i>
                    Daftar Pemain
                </h3>
                
                @if(count($players) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($players as $index => $player)
                            <div class="group bg-gradient-to-r from-gray-50 to-white border border-gray-200 rounded-lg p-4 hover:border-orange-300 hover:shadow-md transition-all duration-300">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <div class="relative">
                                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-orange-100 to-red-100 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                                <i class="fas fa-user text-orange-500 text-lg"></i>
                                            </div>
                                            <span class="absolute -top-2 -right-2 bg-orange-500 text-white text-xs font-bold w-6 h-6 rounded-full flex items-center justify-center">
                                                {{ $index + 1 }}
                                            </span>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900">{{ $player }}</h4>
                                            <p class="text-sm text-gray-500">Pemain #{{ $index + 1 }}</p>
                                        </div>
                                    </div>
                                    <span class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                        Ready
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Setup Form -->
            @if(count($players) >= 2)
            <form action="/scoreboard/setup" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Game Type Card -->
                    <div class="bg-gradient-to-br from-white to-gray-50 rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                        <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-6 py-4">
                            <h3 class="text-lg font-semibold text-white flex items-center">
                                <i class="fas fa-gamepad mr-2"></i>
                                Jenis Permainan
                            </h3>
                        </div>
                        
                        <div class="p-6 space-y-4">
                            <!-- Badminton Option -->
                            <div class="group cursor-pointer">
                                <input class="hidden" type="radio" name="game_type" id="badminton" value="badminton" required checked>
                                <label for="badminton" 
                                       class="flex items-center border border-gray-200 rounded-lg p-4 hover:border-orange-300 hover:shadow-md transition-all duration-300 group-has-[:checked]:border-orange-500 group-has-[:checked]:bg-gradient-to-r group-has-[:checked]:from-orange-50 group-has-[:checked]:to-red-50">
                                    <div class="flex-shrink-0 mr-4">
                                        <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-orange-500 to-red-600 flex items-center justify-center">
                                            <i class="fas fa-badminton text-white text-xl"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow">
                                        <div class="flex items-center mb-1">
                                            <h4 class="text-lg font-bold text-gray-900 mr-3">🏸 Badminton</h4>
                                            <span class="bg-orange-100 text-orange-800 text-xs font-semibold px-2 py-1 rounded-full">
                                                Default
                                            </span>
                                        </div>
                                        <p class="text-gray-600 text-sm">First to 21 (win by 2), max 30 points</p>
                                    </div>
                                    <div class="ml-4">
                                        <div class="w-6 h-6 rounded-full border-2 border-gray-300 group-has-[:checked]:border-orange-500 group-has-[:checked]:bg-orange-500 flex items-center justify-center">
                                            <i class="fas fa-check text-white text-xs hidden group-has-[:checked]:block"></i>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            
                            <!-- Tennis Option -->
                            <div class="group cursor-pointer">
                                <input class="hidden" type="radio" name="game_type" id="tennis" value="tennis" required>
                                <label for="tennis" 
                                       class="flex items-center border border-gray-200 rounded-lg p-4 hover:border-orange-300 hover:shadow-md transition-all duration-300 group-has-[:checked]:border-orange-500 group-has-[:checked]:bg-gradient-to-r group-has-[:checked]:from-orange-50 group-has-[:checked]:to-red-50">
                                    <div class="flex-shrink-0 mr-4">
                                        <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-orange-500 to-red-600 flex items-center justify-center">
                                            <i class="fas fa-baseball-ball text-white text-xl"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow">
                                        <h4 class="text-lg font-bold text-gray-900 mb-1">🎾 Tennis</h4>
                                        <p class="text-gray-600 text-sm">0-15-30-40-deuce system with advantage</p>
                                    </div>
                                    <div class="ml-4">
                                        <div class="w-6 h-6 rounded-full border-2 border-gray-300 group-has-[:checked]:border-orange-500 group-has-[:checked]:bg-orange-500 flex items-center justify-center">
                                            <i class="fas fa-check text-white text-xs hidden group-has-[:checked]:block"></i>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            
                            <!-- Padel Option -->
                            <div class="group cursor-pointer">
                                <input class="hidden" type="radio" name="game_type" id="padel" value="padel" required>
                                <label for="padel" 
                                       class="flex items-center border border-gray-200 rounded-lg p-4 hover:border-orange-300 hover:shadow-md transition-all duration-300 group-has-[:checked]:border-orange-500 group-has-[:checked]:bg-gradient-to-r group-has-[:checked]:from-orange-50 group-has-[:checked]:to-red-50">
                                    <div class="flex-shrink-0 mr-4">
                                        <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-orange-500 to-red-600 flex items-center justify-center">
                                            <i class="fas fa-table-tennis text-white text-xl"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow">
                                        <h4 class="text-lg font-bold text-gray-900 mb-1">🎾 Padel</h4>
                                        <p class="text-gray-600 text-sm">Set-game system with golden point</p>
                                    </div>
                                    <div class="ml-4">
                                        <div class="w-6 h-6 rounded-full border-2 border-gray-300 group-has-[:checked]:border-orange-500 group-has-[:checked]:bg-orange-500 flex items-center justify-center">
                                            <i class="fas fa-check text-white text-xs hidden group-has-[:checked]:block"></i>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <!-- Pickleball Option -->
                            <div class="group cursor-pointer">
                                <input class="hidden" type="radio" name="game_type" id="pickleball" value="pickleball" required>
                                <label for="pickleball" 
                                       class="flex items-center border border-gray-200 rounded-lg p-4 hover:border-orange-300 hover:shadow-md transition-all duration-300 group-has-[:checked]:border-orange-500 group-has-[:checked]:bg-gradient-to-r group-has-[:checked]:from-orange-50 group-has-[:checked]:to-red-50">
                                    <div class="flex-shrink-0 mr-4">
                                        <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-orange-500 to-red-600 flex items-center justify-center">
                                            <i class="fas fa-table-tennis text-white text-xl"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow">
                                        <div class="flex items-center mb-1">
                                            <h4 class="text-lg font-bold text-gray-900 mr-3"> Pickleball</h4>
                                            <span class="bg-green-100 text-green-800 text-xs font-semibold px-2 py-1 rounded-full">
                                                New
                                            </span>
                                        </div>
                                        <p class="text-gray-600 text-sm">First to 11 (win by 2), serve team scores only</p>
                                    </div>
                                    <div class="ml-4">
                                        <div class="w-6 h-6 rounded-full border-2 border-gray-300 group-has-[:checked]:border-orange-500 group-has-[:checked]:bg-orange-500 flex items-center justify-center">
                                            <i class="fas fa-check text-white text-xs hidden group-has-[:checked]:block"></i>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Game Mode Card -->
                    <div class="bg-gradient-to-br from-white to-gray-50 rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                        <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-6 py-4">
                            <h3 class="text-lg font-semibold text-white flex items-center">
                                <i class="fas fa-users mr-2"></i>
                                Mode Permainan
                            </h3>
                        </div>
                        
                        <div class="p-6 space-y-4">
                            <!-- Single Mode -->
                            <div class="group cursor-pointer">
                                <input class="hidden" type="radio" name="mode" id="single" value="single" required checked>
                                <label for="single" 
                                       class="flex items-center border border-gray-200 rounded-lg p-4 hover:border-orange-300 hover:shadow-md transition-all duration-300 group-has-[:checked]:border-orange-500 group-has-[:checked]:bg-gradient-to-r group-has-[:checked]:from-orange-50 group-has-[:checked]:to-red-50">
                                    <div class="flex-shrink-0 mr-4">
                                        <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-orange-500 to-red-600 flex items-center justify-center">
                                            <i class="fas fa-user text-white text-xl"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow">
                                        <div class="flex items-center justify-between mb-1">
                                            <div>
                                                <h4 class="text-lg font-bold text-gray-900">Single</h4>
                                                <p class="text-gray-600 text-sm">1 vs 1 pertandingan</p>
                                            </div>
                                            <span class="bg-orange-100 text-orange-800 text-xs font-semibold px-2 py-1 rounded-full">
                                                <i class="fas fa-check-circle mr-1"></i> Tersedia
                                            </span>
                                        </div>
                                        <p class="text-xs text-gray-500">Format pertandingan individu melawan individu</p>
                                    </div>
                                    <div class="ml-4">
                                        <div class="w-6 h-6 rounded-full border-2 border-gray-300 group-has-[:checked]:border-orange-500 group-has-[:checked]:bg-orange-500 flex items-center justify-center">
                                            <i class="fas fa-check text-white text-xs hidden group-has-[:checked]:block"></i>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            
                            <!-- Double Mode -->
                            <div class="group cursor-pointer @if(count($players) < 4) opacity-60 @endif">
                                <input class="hidden" type="radio" name="mode" id="double" value="double" required 
                                       @if(count($players) < 4) disabled @endif>
                                <label for="double" 
                                       class="flex items-center border border-gray-200 rounded-lg p-4 transition-all duration-300 
                                              @if(count($players) >= 4) hover:border-orange-300 hover:shadow-md @endif
                                              group-has-[:checked]:border-orange-500 group-has-[:checked]:bg-gradient-to-r group-has-[:checked]:from-orange-50 group-has-[:checked]:to-red-50">
                                    <div class="flex-shrink-0 mr-4">
                                        <div class="w-12 h-12 rounded-lg bg-gradient-to-r @if(count($players) >= 4) from-orange-500 to-red-600 @else from-gray-400 to-gray-500 @endif flex items-center justify-center">
                                            <i class="fas fa-users text-white text-xl"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow">
                                        <div class="flex items-center justify-between mb-1">
                                            <div>
                                                <h4 class="text-lg font-bold @if(count($players) >= 4) text-gray-900 @else text-gray-500 @endif">Double</h4>
                                                <p class="text-gray-600 text-sm">2 vs 2 pertandingan</p>
                                            </div>
                                            @if(count($players) >= 4)
                                                <span class="bg-orange-100 text-orange-800 text-xs font-semibold px-2 py-1 rounded-full">
                                                    <i class="fas fa-check-circle mr-1"></i> Tersedia
                                                </span>
                                            @else
                                                <span class="bg-red-100 text-red-800 text-xs font-semibold px-2 py-1 rounded-full">
                                                    <i class="fas fa-times-circle mr-1"></i> Butuh {{ 4 - count($players) }} pemain
                                                </span>
                                            @endif
                                        </div>
                                        <p class="text-xs @if(count($players) >= 4) text-gray-500 @else text-red-500 @endif">
                                            @if(count($players) >= 4)
                                                Format tim ganda dengan pasangan
                                            @else
                                                Tambahkan {{ 4 - count($players) }} pemain lagi untuk mengaktifkan
                                            @endif
                                        </p>
                                    </div>
                                    <div class="ml-4">
                                        <div class="w-6 h-6 rounded-full border-2 @if(count($players) >= 4) border-gray-300 group-has-[:checked]:border-orange-500 group-has-[:checked]:bg-orange-500 @else border-gray-200 @endif flex items-center justify-center">
                                            <i class="fas fa-check text-white text-xs hidden group-has-[:checked]:block"></i>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-6 border-t border-gray-200">
                    <a href="/scoreboard" 
                       class="group bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 px-8 py-3 rounded-lg font-semibold hover:from-gray-200 hover:to-gray-300 transition-all duration-300 shadow-sm hover:shadow flex items-center w-full sm:w-auto justify-center">
                        <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                        Kembali ke Daftar Pemain
                    </a>
                    
                    <button type="submit" 
                            class="group bg-gradient-to-r from-green-500 to-emerald-600 text-white px-10 py-3 rounded-lg font-semibold hover:from-green-600 hover:to-emerald-700 transition-all duration-300 shadow-md hover:shadow-lg flex items-center w-full sm:w-auto justify-center transform hover:scale-105">
                        <i class="fas fa-play mr-2"></i>
                        Mulai Pertandingan
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </div>
            </form>
            
            @else
            <!-- Not Enough Players -->
            <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border border-yellow-200 rounded-xl p-6 mb-6">
                <div class="flex items-start space-x-4">
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <i class="fas fa-exclamation-triangle text-yellow-600 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-1">Pemain Tidak Cukup!</h4>
                        <p class="text-gray-700">
                            Dibutuhkan minimal 2 pemain untuk memulai pertandingan. Saat ini Anda memiliki {{ count($players) }} pemain.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons for Not Enough Players -->
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-6 border-t border-gray-200">
                <a href="/scoreboard" 
                   class="group bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 px-8 py-3 rounded-lg font-semibold hover:from-gray-200 hover:to-gray-300 transition-all duration-300 shadow-sm hover:shadow flex items-center w-full sm:w-auto justify-center">
                    <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                    Kembali ke Daftar Pemain
                </a>
                
                <a href="/scoreboard" 
                   class="group bg-gradient-to-r from-orange-500 to-red-500 text-white px-10 py-3 rounded-lg font-semibold hover:from-orange-600 hover:to-red-600 transition-all duration-300 shadow-md hover:shadow-lg flex items-center w-full sm:w-auto justify-center">
                    <i class="fas fa-user-plus mr-2"></i>
                    Tambah Pemain
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Additional Info Section -->
    <!-- <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-blue-100 to-blue-50 flex items-center justify-center mb-4">
                <i class="fas fa-gamepad text-blue-500 text-xl"></i>
            </div>
            <h4 class="font-bold text-gray-900 mb-2">Multiple Sports</h4>
            <p class="text-gray-600 text-sm">Dukung berbagai jenis olahraga dengan sistem skor yang berbeda untuk setiap permainan.</p>
        </div>
        
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-green-100 to-green-50 flex items-center justify-center mb-4">
                <i class="fas fa-exchange-alt text-green-500 text-xl"></i>
            </div>
            <h4 class="font-bold text-gray-900 mb-2">Flexible Formats</h4>
            <p class="text-gray-600 text-sm">Single atau double match dengan konfigurasi yang mudah sesuai kebutuhan.</p>
        </div>
        
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-orange-100 to-orange-50 flex items-center justify-center mb-4">
                <i class="fas fa-history text-orange-500 text-xl"></i>
            </div>
            <h4 class="font-bold text-gray-900 mb-2">Auto Tracking</h4>
            <p class="text-gray-600 text-sm">Semua pertandingan dan statistik akan tercatat otomatis untuk analisis mendalam.</p>
        </div>
    </div> -->
</div>

@endsection

@push('styles')
<style>
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
    
    .group:hover .group-hover\:scale-110 {
        transform: scale(1.1);
    }
    
    .group:hover .group-hover\:-translate-x-1 {
        transform: translateX(-0.25rem);
    }
    
    .group:hover .group-hover\:translate-x-1 {
        transform: translateX(0.25rem);
    }
    
    input:checked + label .fa-check {
        display: block !important;
    }
    
    .group-has-[:checked]:border-orange-500 {
        border-color: #f97316;
    }
    
    .group-has-[:checked]:bg-gradient-to-r.from-orange-50.to-red-50 {
        background-image: linear-gradient(to right, #fff7ed, #fef2f2);
    }
    
    /* Animation for scale effect */
    .transform.hover\:scale-105:hover {
        transform: scale(1.05);
    }
</style>
@endpush