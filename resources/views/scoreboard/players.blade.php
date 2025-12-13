@extends('layouts.app')

@section('title', 'Input Pemain - Scoreboard')

@section('content')

<!-- Hero Section -->
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
            Input Pemain, <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FF6700] to-yellow-400">Mulai Pertandingan.</span>
        </h1>
        
        <p class="text-lg md:text-2xl text-gray-200 mb-10 max-w-3xl mx-auto font-light leading-relaxed">
            Tambahkan pemain untuk pertandingan Padel, Tennis, Badminton, dan Pickleball. Atur turnamen dan pantau skor secara real-time.
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
                        <i class="fas fa-user-plus mr-3"></i> Input Pemain
                    </h2>
                    <p class="text-orange-100 mt-1">
                        Tambahkan pemain yang akan bertanding. Minimal 2 pemain untuk memulai.
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
            <!-- Add Player Form -->
            <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl border border-gray-200 p-6 mb-8 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-plus-circle text-orange-500 mr-2"></i>
                    Tambah Pemain Baru
                </h3>
                
                <form action="/scoreboard/add-player" method="POST" class="space-y-4">
                    @csrf
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <input type="text" 
                                       name="name" 
                                       class="pl-10 w-full px- py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition"
                                       placeholder="Masukkan nama pemain"
                                       required
                                       maxlength="50">
                            </div>
                            <p class="text-sm text-gray-500 mt-2">
                                <i class="fas fa-info-circle mr-1"></i> Maksimal 50 karakter. Nama tidak boleh duplikat.
                            </p>
                        </div>
                        <div>
                            <button type="submit" 
                                    class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-8 py-3 rounded-lg font-semibold hover:from-orange-600 hover:to-red-600 transition-all duration-300 shadow-md hover:shadow-lg flex items-center whitespace-nowrap">
                                <i class="fas fa-plus mr-2"></i> Tambah Pemain
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Players List -->
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm mb-8">
                <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-6 py-4">
                    <h3 class="text-lg font-semibold text-white flex items-center">
                        <i class="fas fa-list mr-2"></i>
                        Daftar Pemain
                        <span class="ml-auto bg-white/20 backdrop-blur-sm rounded-full px-3 py-1 text-sm">
                            {{ count($players) }} pemain
                        </span>
                    </h3>
                </div>
                
                <div class="p-6">
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
                    @else
                        <div class="text-center py-12">
                            <div class="w-24 h-24 mx-auto rounded-full bg-gradient-to-br from-orange-100 to-red-100 flex items-center justify-center mb-6">
                                <i class="fas fa-users text-3xl text-orange-400"></i>
                            </div>
                            <h4 class="text-xl font-semibold text-gray-700 mb-2">Belum ada pemain</h4>
                            <p class="text-gray-500 max-w-md mx-auto">
                                Tambahkan pemain terlebih dahulu untuk memulai pertandingan. Minimal 2 pemain diperlukan.
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons & Info -->
            <div class="space-y-6">
                @if(count($players) < 2)
                    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border border-yellow-200 rounded-xl p-6">
                        <div class="flex items-start space-x-4">
                            <div class="bg-yellow-100 p-3 rounded-full">
                                <i class="fas fa-exclamation-triangle text-yellow-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 mb-1">Perhatian!</h4>
                                <p class="text-gray-700">
                                    Minimal 2 pemain diperlukan untuk memulai pertandingan.
                                    @if(count($players) == 1)
                                        <span class="font-semibold text-orange-600">Tambahkan 1 pemain lagi.</span>
                                    @else
                                        <span class="font-semibold text-orange-600">Tambahkan 2 pemain.</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-6 border-t border-gray-200">
                    <div>
                        @if(count($players) > 0)
                            <form action="/scoreboard/reset" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mereset semua data?')">
                                @csrf
                                <button type="submit" 
                                        class="group bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:from-gray-200 hover:to-gray-300 transition-all duration-300 shadow-sm hover:shadow flex items-center">
                                    <i class="fas fa-trash-alt mr-2 text-gray-600 group-hover:text-red-500 transition-colors"></i>
                                    Reset Semua
                                </button>
                            </form>
                        @endif
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        @if(count($players) >= 2)
                            <a href="/scoreboard/setup" 
                               class="group bg-gradient-to-r from-green-500 to-emerald-600 text-white px-8 py-3 rounded-lg font-semibold hover:from-green-600 hover:to-emerald-700 transition-all duration-300 shadow-md hover:shadow-lg flex items-center">
                                <span>Lanjut ke Setup Game</span>
                                <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Info Section -->
    <!-- <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-blue-100 to-blue-50 flex items-center justify-center mb-4">
                <i class="fas fa-users text-blue-500 text-xl"></i>
            </div>
            <h4 class="font-bold text-gray-900 mb-2">Multiplayer Ready</h4>
            <p class="text-gray-600 text-sm">Dukung hingga 10+ pemain dalam satu pertandingan dengan sistem turnamen yang fleksibel.</p>
        </div>
        
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-green-100 to-green-50 flex items-center justify-center mb-4">
                <i class="fas fa-chart-line text-green-500 text-xl"></i>
            </div>
            <h4 class="font-bold text-gray-900 mb-2">Real-time Stats</h4>
            <p class="text-gray-600 text-sm">Pantau statistik pemain secara real-time dengan dashboard yang interaktif.</p>
        </div>
        
        <div class="bg-gradient-to-br from-white to-gray-50 rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-orange-100 to-orange-50 flex items-center justify-center mb-4">
                <i class="fas fa-trophy text-orange-500 text-xl"></i>
            </div>
            <h4 class="font-bold text-gray-900 mb-2">Tournament Mode</h4>
            <p class="text-gray-600 text-sm">Sistem bracket otomatis untuk berbagai jenis turnamen dengan pembagian grup yang adil.</p>
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
    
    .group:hover .group-hover\:translate-x-1 {
        transform: translateX(0.25rem);
    }
</style>
@endpush