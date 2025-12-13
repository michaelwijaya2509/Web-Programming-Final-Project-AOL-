@extends('layouts.app')

@section('title', 'Input Pemain - Scoreboard')

@section('content')

<!-- Hero Section -->
<div class="relative w-full h-[400px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-tr from-gray-900 via-transparent to-orange-900/40 z-0"></div>
    
    <img src="https://images.unsplash.com/photo-1575361204480-aadea25e6e68?q=80&w=2071&auto=format&fit=crop"
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
    <!-- Main Card -->
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100 mb-16">
        <!-- Card Header -->
        <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-8 py-8">
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between">
                <div class="mb-6 md:mb-0">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-3">
                        <i class="fas fa-user-plus mr-3 text-[#FF6700]"></i>Input Pemain
                    </h2>
                    <p class="text-gray-300 text-lg">
                        Tambahkan pemain yang akan bertanding. Minimal 2 pemain untuk memulai pertandingan.
                    </p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl px-6 py-4 border border-white/20">
                    <span class="text-sm text-gray-300 font-medium">Total Pemain</span>
                    <div class="text-4xl font-bold text-white text-center">{{ count($players) }}</div>
                </div>
            </div>
        </div>

        <!-- Card Body -->
        <div class="p-8 md:p-10">
            <!-- Add Player Form -->
            <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl border border-gray-200 p-8 mb-10 shadow-lg hover:shadow-xl transition-all duration-300">
                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-r from-orange-100 to-red-100 rounded-xl flex items-center justify-center mr-4">
                        <i class="fas fa-plus text-[#FF6700] text-xl"></i>
                    </div>
                    Tambah Pemain Baru
                </h3>
                
                <form action="/scoreboard/add-player" method="POST" class="space-y-6">
                    @csrf
                    <div class="flex flex-col lg:flex-row gap-6 items-end">
                        <div class="flex-1">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400 text-lg"></i>
                                </div>
                                <input type="text" 
                                       name="name" 
                                       class="pl-12 w-full px-5 py-4 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-[#FF6700]/30 focus:border-[#FF6700] transition-all duration-300 text-gray-900 placeholder-gray-400"
                                       placeholder="Masukkan nama pemain"
                                       required
                                       maxlength="50">
                            </div>
                            <p class="text-sm text-gray-500 mt-3 flex items-center">
                                <i class="fas fa-info-circle mr-2 text-[#FF6700]"></i> Maksimal 50 karakter. Nama tidak boleh duplikat.
                            </p>
                        </div>
                        <div>
                            <button type="submit" 
                                    class="group relative overflow-hidden bg-gradient-to-r from-[#FF6700] to-orange-600 text-white px-10 py-4 rounded-xl font-bold hover:shadow-[0_0_30px_rgba(255,103,0,0.4)] transition-all duration-300 shadow-lg hover:-translate-y-1 flex items-center whitespace-nowrap">
                                <span class="relative z-10 flex items-center">
                                    <i class="fas fa-plus mr-3"></i> Tambah Pemain
                                </span>
                                <div class="absolute inset-0 bg-white/20 transform -skew-x-12 -translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Players List -->
            <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-lg mb-10">
                <div class="bg-gradient-to-r from-gray-900 to-gray-800 px-8 py-6">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-users text-[#FF6700]"></i>
                        </div>
                        Daftar Pemain
                        <span class="ml-auto bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 text-sm font-bold">
                            {{ count($players) }} pemain
                        </span>
                    </h3>
                </div>
                
                <div class="p-8">
                    @if(count($players) > 0)
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            @foreach($players as $index => $player)
                                <div class="group relative overflow-hidden bg-gradient-to-br from-white to-gray-50 border border-gray-200 rounded-xl p-6 hover:border-[#FF6700] hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                                    <div class="absolute top-0 right-0 w-24 h-24 bg-orange-100 rounded-full -mr-12 -mt-12 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                    
                                    <div class="flex items-center justify-between relative z-10">
                                        <div class="flex items-center space-x-5">
                                            <div class="relative">
                                                <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-orange-100 to-red-100 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-md">
                                                    <i class="fas fa-user text-[#FF6700] text-2xl"></i>
                                                </div>
                                                <span class="absolute -top-3 -right-3 bg-[#FF6700] text-white text-sm font-bold w-7 h-7 rounded-full flex items-center justify-center shadow-lg">
                                                    {{ $index + 1 }}
                                                </span>
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-gray-900 text-lg">{{ $player }}</h4>
                                                <p class="text-sm text-gray-500 flex items-center">
                                                    <i class="fas fa-hashtag mr-2 text-[#FF6700]"></i>
                                                    Player #{{ $index + 1 }}
                                                </p>
                                            </div>
                                        </div>
                                        <span class="bg-gradient-to-r from-[#FF6700] to-orange-600 text-white px-4 py-2 rounded-full text-sm font-bold shadow-md">
                                            <i class="fas fa-check mr-2"></i>Ready
                                        </span>
                                    </div>
                                    
                                    <div class="mt-4 pt-4 border-t border-gray-100 border-dashed">
                                        <div class="flex items-center text-sm text-gray-500">
                                            <i class="fas fa-clock mr-2 text-[#FF6700]"></i>
                                            <span>Ditambahkan pada {{ now()->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-16">
                            <div class="w-32 h-32 mx-auto rounded-full bg-gradient-to-br from-orange-100 to-red-100 flex items-center justify-center mb-8 shadow-lg">
                                <i class="fas fa-users text-4xl text-[#FF6700]"></i>
                            </div>
                            <h4 class="text-2xl font-bold text-gray-900 mb-4">Belum ada pemain</h4>
                            <p class="text-gray-500 max-w-md mx-auto text-lg mb-8">
                                Tambahkan pemain terlebih dahulu untuk memulai pertandingan. Minimal 2 pemain diperlukan.
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Info & Actions -->
            <div class="space-y-8">
                @if(count($players) < 2)
                    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border border-yellow-200 rounded-2xl p-8">
                        <div class="flex items-start space-x-6">
                            <div class="bg-yellow-100 p-4 rounded-xl shadow-md">
                                <i class="fas fa-exclamation-triangle text-yellow-600 text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-gray-900 mb-3">Perhatian!</h4>
                                <p class="text-gray-800 text-lg">
                                    Minimal 2 pemain diperlukan untuk memulai pertandingan.
                                    @if(count($players) == 1)
                                        <span class="font-bold text-[#FF6700]">Tambahkan 1 pemain lagi.</span>
                                    @else
                                        <span class="font-bold text-[#FF6700]">Tambahkan 2 pemain.</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="flex flex-col lg:flex-row justify-between items-center gap-8 pt-8 border-t border-gray-200 border-dashed">
                    <div>
                        @if(count($players) > 0)
                            <form action="/scoreboard/reset" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mereset semua data pemain?')">
                                @csrf
                                <button type="submit" 
                                        class="group bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 px-8 py-4 rounded-xl font-bold hover:from-gray-200 hover:to-gray-300 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center">
                                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-red-200 transition-colors">
                                        <i class="fas fa-trash-alt text-red-500"></i>
                                    </div>
                                    <span>Reset Semua Pemain</span>
                                </button>
                            </form>
                        @endif
                    </div>
                    
                    <div class="flex items-center gap-6">
                        @if(count($players) >= 2)
                            <a href="/scoreboard/setup" 
                               class="group relative overflow-hidden bg-gradient-to-r from-green-500 to-emerald-600 text-white px-12 py-4 rounded-xl font-bold hover:shadow-[0_0_30px_rgba(5,150,105,0.4)] transition-all duration-300 shadow-lg hover:-translate-y-1 flex items-center">
                                <span>Lanjut ke Setup Game</span>
                                <i class="fas fa-arrow-right ml-4 group-hover:translate-x-2 transition-transform duration-300"></i>
                                <div class="absolute inset-0 bg-white/20 transform -skew-x-12 -translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>
                            </a>
                        @else
                            <button disabled
                                    class="bg-gradient-to-r from-gray-300 to-gray-400 text-gray-500 px-12 py-4 rounded-xl font-bold cursor-not-allowed shadow-lg flex items-center">
                                <span>Lanjut ke Setup Game</span>
                                <i class="fas fa-lock ml-4"></i>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Feature Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <div class="group relative p-8 bg-white rounded-3xl border border-gray-100 hover:border-[#FF6700] transition-all duration-500 hover:shadow-2xl hover:shadow-orange-100 hover:-translate-y-2 cursor-default overflow-hidden">
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-orange-100 rounded-full transition-transform duration-500 group-hover:scale-[10]"></div>
            
            <div class="relative z-10">
                <div class="w-16 h-16 bg-white rounded-2xl shadow-md flex items-center justify-center mb-8 text-3xl text-[#FF6700] group-hover:text-white group-hover:bg-[#FF6700] transition-colors duration-300">
                    <i class="fas fa-trophy"></i>
                </div>
                
                <h4 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-gray-800">Tournament Ready</h4>
                <p class="text-gray-600 leading-relaxed mb-6 group-hover:text-gray-700">
                    Dukung sistem bracket otomatis untuk berbagai jenis turnamen dengan pembagian grup yang adil.
                </p>
            </div>
        </div>
        
        <div class="group relative p-8 bg-white rounded-3xl border border-gray-100 hover:border-[#FF6700] transition-all duration-500 hover:shadow-2xl hover:shadow-orange-100 hover:-translate-y-2 cursor-default overflow-hidden">
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-orange-100 rounded-full transition-transform duration-500 group-hover:scale-[10]"></div>
            
            <div class="relative z-10">
                <div class="w-16 h-16 bg-white rounded-2xl shadow-md flex items-center justify-center mb-8 text-3xl text-[#FF6700] group-hover:text-white group-hover:bg-[#FF6700] transition-colors duration-300">
                    <i class="fas fa-chart-line"></i>
                </div>
                
                <h4 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-gray-800">Real-time Stats</h4>
                <p class="text-gray-600 leading-relaxed mb-6 group-hover:text-gray-700">
                    Pantau statistik pemain secara real-time dengan dashboard yang interaktif dan mudah dipahami.
                </p>
            </div>
        </div>
        
        <div class="group relative p-8 bg-white rounded-3xl border border-gray-100 hover:border-[#FF6700] transition-all duration-500 hover:shadow-2xl hover:shadow-orange-100 hover:-translate-y-2 cursor-default overflow-hidden">
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-orange-100 rounded-full transition-transform duration-500 group-hover:scale-[10]"></div>
            
            <div class="relative z-10">
                <div class="w-16 h-16 bg-white rounded-2xl shadow-md flex items-center justify-center mb-8 text-3xl text-[#FF6700] group-hover:text-white group-hover:bg-[#FF6700] transition-colors duration-300">
                    <i class="fas fa-desktop"></i>
                </div>
                
                <h4 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-gray-800">Full Screen Mode</h4>
                <p class="text-gray-600 leading-relaxed mb-6 group-hover:text-gray-700">
                    Tampilan layar penuh untuk pengalaman pertandingan yang imersif di berbagai perangkat.
                </p>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-gray-900 to-gray-800 rounded-3xl shadow-2xl overflow-hidden p-12 relative">
        <div class="absolute top-0 right-0 w-96 h-96 bg-orange-500/10 rounded-full -mr-48 -mt-48"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-orange-500/10 rounded-full -ml-32 -mb-32"></div>
        
        <div class="relative z-10 text-center">
            <h3 class="text-3xl md:text-4xl font-bold text-white mb-6">
                Siap memulai pertandingan?
            </h3>
            <p class="text-gray-300 text-lg mb-10 max-w-2xl mx-auto">
                Tambahkan pemain dan langsung alami pengalaman scoreboard digital yang modern dan profesional.
            </p>
            
            @if(count($players) >= 2)
                <a href="/scoreboard/setup" 
                   class="inline-flex items-center justify-center px-10 py-5 border border-transparent text-lg font-bold rounded-xl text-white bg-[#FF6700] hover:bg-orange-700 transition shadow-[0_0_30px_rgba(255,103,0,0.4)] hover:shadow-[0_0_40px_rgba(255,103,0,0.6)] transform hover:-translate-y-1">
                    <i class="fas fa-play mr-3"></i> Mulai Pertandingan Sekarang
                </a>
            @else
                <button disabled
                        class="inline-flex items-center justify-center px-10 py-5 border border-transparent text-lg font-bold rounded-xl text-gray-400 bg-gray-700 cursor-not-allowed">
                    <i class="fas fa-lock mr-3"></i> Tambahkan {!! count($players) == 1 ? '1 Pemain Lagi' : '2 Pemain' !!}
                </button>
            @endif
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
    
    @keyframes fade-in-down {
        0% {
            opacity: 0;
            transform: translateY(-20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in-down {
        animation: fade-in-down 0.8s ease-out;
    }
    
    .group:hover .group-hover\:scale-110 {
        transform: scale(1.1);
    }
    
    .group:hover .group-hover\:translate-x-2 {
        transform: translateX(0.5rem);
    }
    
    .group:hover .group-hover\:-translate-y-1 {
        transform: translateY(-0.25rem);
    }
    
    .border-dashed {
        border-style: dashed;
    }
</style>
@endpush