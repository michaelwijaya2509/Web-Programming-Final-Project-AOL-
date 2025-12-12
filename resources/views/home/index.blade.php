@extends('layouts.app')

@section('title', 'Daftar Lapangan')

@section('content')

    <div class="relative w-full h-[600px] flex items-center">

        <img src="https://images.unsplash.com/photo-1554068865-24cecd4e34b8?q=80&w=2070&auto=format&fit=crop"
            alt="Background venue" class="absolute inset-0 w-full h-full object-cover z-0">

        <div class="absolute inset-0 bg-black/50 z-10"></div>

        <div class="relative z-20 container mx-auto px-6 md:px-12 text-white">

            <h1 class="text-4xl md:text-6xl font-bold mb-4 leading-tight drop-shadow-lg">
                Super Sport <br>
                Community App
            </h1>

            <p class="text-lg md:text-xl mb-8 max-w-2xl drop-shadow-md text-gray-200">
                Platform all-in-one untuk sewa lapangan, cari lawan sparring, atau
                cari kawan main bareng. Olahraga makin mudah dan menyenangkan!
            </p>

            <div class="flex flex-col sm:flex-row gap-4">
                <button
                    class="flex items-center bg-white text-gray-900 px-5 py-3 rounded-lg font-bold hover:bg-gray-100 transition shadow-lg w-fit">
                    <i class="fab fa-google-play text-2xl mr-3"></i>
                    <div class="text-left leading-tight">
                        <span class="block text-[10px] font-semibold uppercase text-gray-500">Get it on</span>
                        <span class="block text-lg">Google Play</span>
                    </div>
                </button>

                <button
                    class="flex items-center bg-white text-gray-900 px-5 py-3 rounded-lg font-bold hover:bg-gray-100 transition shadow-lg w-fit">
                    <i class="fab fa-apple text-2xl mr-3"></i>
                    <div class="text-left leading-tight">
                        <span class="block text-[10px] font-semibold uppercase text-gray-500">Download on the</span>
                        <span class="block text-lg">App Store</span>
                    </div>
                </button>
            </div>

        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-20 z-10">
        <div
            class="ayo-red rounded-lg shadow-lg p-4 md:p-6 flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0 text-white">

            <div class="flex-1 w-full md:border-r border-red-700 px-4">
                <label
                    class="block text-xs font-semibold uppercase tracking-wide opacity-80 mb-1 text-orange-500">Aktivitas</label>
                <div class="flex items-center justify-between cursor-pointer">
                    <span class="font-bold text-lg text-orange-500">Sewa Lapangan</span> <i
                        class="fas fa-chevron-down text-sm"></i>
                </div>
            </div>

            <div class="flex-1 w-full md:border-r border-red-700 px-4">
                <label
                    class="block text-xs font-semibold uppercase tracking-wide opacity-80 mb-1 text-orange-500">Lokasi</label>
                <div class="flex items-center justify-between cursor-pointer">
                    <span class="font-bold text-lg text-orange-500">Jakarta Selatan</span>
                    <i class="fas fa-map-marker-alt text-sm"></i>
                </div>
            </div>

            <div class="flex-1 w-full px-4">
                <label class="block text-xs font-semibold uppercase tracking-wide opacity-80 mb-1 text-orange-500">Cabang
                    Olahraga</label>
                <div class="flex items-center justify-between cursor-pointer">
                    <span class="font-bold text-lg text-orange-500">Padel</span>
                    <i class="fas fa-futbol text-sm"></i>
                </div>
            </div>

            <div class="pl-4">
                <button
                    class="bg-white text-ayo-red px-8 py-3 rounded font-bold hover:bg-gray-100 text-orange-500 transition shadow-md">
                    Temukan <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>
    </div>

    <section class="py-16 bg-gray-900 overflow-hidden relative">

        <style>
            /* Base Card Styling */
            .court-card {
                position: relative;
                overflow: hidden;
                border-radius: 1rem;
                min-height: 400px;
                /* Tinggi kartu */
                cursor: pointer;
                border: 1px solid #374151;
                transition: all 0.5s cubic-bezier(0.25, 0.4, 0.45, 1.4);
            }

            /* Overlay Gradient: Supaya teks putih terbaca jelas */
            .card-gradient {
                background: linear-gradient(to top, rgba(0, 0, 0, 0.9) 0%, rgba(0, 0, 0, 0.6) 40%, rgba(0, 0, 0, 0) 100%);
            }

            /* Desktop View (Lebar Layar > 768px) */
            @media (min-width: 768px) {
                .court-card {
                    flex: 1;
                    /* Awalnya semua sama lebar */
                }

                .court-card:hover {
                    flex: 3 !important;
                    /* Saat di-hover melebar */
                    border-color: #FF6700;
                }

                /* Deskripsi sembunyi dulu, muncul saat hover */
                .card-desc {
                    opacity: 0;
                    transform: translateY(20px);
                    transition: all 0.4s ease-in-out;
                    height: 0;
                    /* Supaya tidak makan tempat saat hidden */
                }

                .court-card:hover .card-desc {
                    opacity: 1;
                    transform: translateY(0);
                    height: auto;
                    margin-top: 10px;
                }

                /* Judul naik ke atas saat hover */
                .card-title-box {
                    transition: transform 0.4s ease;
                }

                .court-card:hover .card-title-box {
                    transform: translateY(-10px);
                }
            }

            /* Mobile View (HP) */
            @media (max-width: 767px) {
                .court-card {
                    flex: none;
                    width: 100%;
                    margin-bottom: 1rem;
                    min-height: 300px;
                }

                /* Di HP, deskripsi SELALU muncul */
                .card-desc {
                    opacity: 1 !important;
                    transform: translateY(0) !important;
                    height: auto !important;
                    margin-top: 8px;
                    display: block !important;
                }
            }
        </style>

        <div class="absolute top-0 left-0 w-full h-full z-0 pointer-events-none">
            <div class="absolute top-20 left-10 w-64 h-64 bg-orange-600 rounded-full blur-[120px] opacity-20"></div>
            <div class="absolute bottom-20 right-10 w-64 h-64 bg-yellow-600 rounded-full blur-[120px] opacity-20"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-10">
                <span class="text-[#FF6700] font-bold tracking-widest uppercase text-sm">Arena Pilihan</span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-white mt-2">
                    Sewa Lapangan <span class="text-[#FF6700]">Favoritmu</span>
                </h2>
                <p class="text-gray-400 mt-4">Pilih kategori olahraga di bawah ini untuk melihat detail.</p>
            </div>

            <div class="flex flex-col md:flex-row gap-4 w-full">

                <div class="court-card group">
                    <img src="https://images.unsplash.com/photo-1658723826297-fe4d1b1e6600?q=80&w=1935&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        alt="Padel Court">

                    <div class="absolute inset-0 card-gradient z-10"></div>

                    <div
                        class="absolute bottom-0 left-0 w-full p-6 z-20 flex flex-col justify-end h-full pointer-events-none">
                        <div class="card-title-box">
                            <h3 class="text-2xl font-bold text-white uppercase italic tracking-wide">Padel</h3>
                        </div>

                        <div class="card-desc pointer-events-auto">
                            <p class="text-gray-200 text-sm mb-4 line-clamp-2">
                                Olahraga hits kekinian! Lapangan kaca standar internasional dengan rumput sintetis terbaik.
                            </p>
                            <a href="{{ url('/venues') }}"
                                class="inline-block bg-[#FF6700] hover:bg-orange-700 text-white text-xs font-bold py-3 px-6 rounded transition shadow-md">
                                Booking Now
                            </a>
                        </div>
                    </div>
                </div>

                <div class="court-card group">
                    <img src="https://images.unsplash.com/photo-1622279457486-62dcc4a431d6?q=80&w=1000&auto=format&fit=crop"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        alt="Tennis Court">

                    <div class="absolute inset-0 card-gradient z-10"></div>

                    <div
                        class="absolute bottom-0 left-0 w-full p-6 z-20 flex flex-col justify-end h-full pointer-events-none">
                        <div class="card-title-box">
                            <h3 class="text-2xl font-bold text-white uppercase italic tracking-wide">Tennis</h3>
                        </div>

                        <div class="card-desc pointer-events-auto">
                            <p class="text-gray-200 text-sm mb-4 line-clamp-2">
                                Hard court indoor & outdoor. Permukaan berkualitas untuk pantulan bola yang sempurna.
                            </p>
                            <a href="{{ url('/venues') }}"
                                class="inline-block bg-[#FF6700] hover:bg-orange-700 text-white text-xs font-bold py-3 px-6 rounded transition shadow-md">
                                Booking Now
                            </a>
                        </div>
                    </div>
                </div>

                <div class="court-card group">
                    <img src="https://images.unsplash.com/photo-1599391398131-cd12dfc6c24e?q=80&w=2022&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        alt="Badminton Court">

                    <div class="absolute inset-0 card-gradient z-10"></div>

                    <div
                        class="absolute bottom-0 left-0 w-full p-6 z-20 flex flex-col justify-end h-full pointer-events-none">
                        <div class="card-title-box">
                            <h3 class="text-2xl font-bold text-white uppercase italic tracking-wide">Badminton</h3>
                        </div>

                        <div class="card-desc pointer-events-auto">
                            <p class="text-gray-200 text-sm mb-4 line-clamp-2">
                                Karpet standar BWF dengan pencahayaan anti-glare dan sirkulasi udara yang nyaman.
                            </p>
                            <a href="{{ url('/venues') }}"
                                class="inline-block bg-[#FF6700] hover:bg-orange-700 text-white text-xs font-bold py-3 px-6 rounded transition shadow-md">
                                Booking Now
                            </a>
                        </div>
                    </div>
                </div>

                <div class="court-card group">
                    <img src="https://images.unsplash.com/photo-1693142517898-2f986215e412?q=80&w=2071&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        alt="Pickleball Court">

                    <div class="absolute inset-0 card-gradient z-10"></div>

                    <div
                        class="absolute bottom-0 left-0 w-full p-6 z-20 flex flex-col justify-end h-full pointer-events-none">
                        <div class="card-title-box">
                            <h3 class="text-2xl font-bold text-white uppercase italic tracking-wide">Pickleball</h3>
                        </div>

                        <div class="card-desc pointer-events-auto">
                            <p class="text-gray-200 text-sm mb-4 line-clamp-2">
                                Olahraga seru gabungan tenis & pingpong. Lapangan khusus dengan net rendah.
                            </p>
                            <a href="{{ url('/venues') }}"
                                class="inline-block bg-[#FF6700] hover:bg-orange-700 text-white text-xs font-bold py-3 px-6 rounded transition shadow-md">
                                Booking Now
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Rekomendasi Lapangan</h2>
                <a href="{{ url('/venues') }}" class="text-ayo-red font-semibold hover:underline">Lihat Semua</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($venues as $venue)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition duration-300">
                        <div class="h-48 bg-gray-300 relative">
                            <img src="{{ $venue->venue_image }}" alt="{{ $venue->name }}"
                                class="w-full h-full object-cover">
                            <span class="absolute top-4 left-4 bg-white text-xs font-bold px-2 py-1 rounded text-gray-800">
                                {{ $venue->type }}
                            </span>
                        </div>

                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $venue->name }}</h3>
                            <p class="text-gray-500 text-sm mb-4">
                                <i class="fas fa-map-marker-alt mr-1"></i> Jakarta Selatan (Dummy Location)
                            </p>

                            <hr class="border-gray-100 my-4">

                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-xs text-gray-400">Mulai dari</p>
                                    <p class="text-ayo-red font-bold text-lg">Rp
                                        {{ number_format($venue->price_per_hour, 0, ',', '.') }}/jam</p>
                                </div>
                                <a href="{{ url('/venues/' . $venue->id) }}"
                                    class="bg-gray-900 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-700 transition">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div
            class="bg-white rounded-3xl shadow-xl overflow-hidden flex flex-col md:flex-row items-center border border-gray-100">

            <div class="md:w-1/2 p-10 md:p-16">
                <h5 class="text-[#FF6700] font-bold uppercase tracking-widest mb-2 text-sm">
                    Digital Scoreboard
                </h5>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                    Catat skor pertandingan dengan lebih mudah.
                </h2>
                <p class="text-gray-600 mb-8 leading-relaxed text-lg">
                    Pantau jalannya pertandingan secara real-time dengan papan skor digital kami.
                    Cocok untuk Padel, Badminton, Tennis, dan PickleBall. Tampilan layar penuh, mudah digunakan, dan gratis!
                </p>

                <ul class="space-y-4 mb-10">
                    <li class="flex items-start">
                        <div
                            class="flex-shrink-0 w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center mt-0.5">
                            <i class="fas fa-check text-[#FF6700] text-sm"></i>
                        </div>
                        <span class="ml-4 text-gray-700 font-medium">Tampilan Full Screen & Responsif.</span>
                    </li>
                    <li class="flex items-start">
                        <div
                            class="flex-shrink-0 w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center mt-0.5">
                            <i class="fas fa-check text-[#FF6700] text-sm"></i>
                        </div>
                        <span class="ml-4 text-gray-700 font-medium">Pengaturan Babak, Set, & Waktu (Timer).</span>
                    </li>
                    <li class="flex items-start">
                        <div
                            class="flex-shrink-0 w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center mt-0.5">
                            <i class="fas fa-check text-[#FF6700] text-sm"></i>
                        </div>
                        <span class="ml-4 text-gray-700 font-medium">Tanpa perlu instalasi aplikasi tambahan.</span>
                    </li>
                </ul>

                <a href="{{ url('/scoreboard') }}"
                    class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-base font-bold rounded-xl text-white bg-[#FF6700] hover:bg-orange-700 transition shadow-lg hover:shadow-orange-500/30 transform hover:-translate-y-1">
                    <i class="fas fa-play-circle mr-2"></i> Pakai Scoreboard Sekarang
                </a>
            </div>

            <div
                class="md:w-1/2 bg-gray-50 h-full w-full flex justify-center items-center p-8 md:p-0 min-h-[400px] relative overflow-hidden">

                <div
                    class="absolute top-0 right-0 w-64 h-64 bg-orange-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-64 h-64 bg-yellow-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000">
                </div>

                <div class="relative z-10 w-full max-w-lg transform md:rotate-1 hover:rotate-0 transition duration-500">
                    <div class="rounded-xl overflow-hidden shadow-2xl border-4 border-white">
                        <img src="https://images.unsplash.com/photo-1628779238951-be2c9f25654b?q=80&w=2070&auto=format&fit=crop"
                            alt="Digital Scoreboard" class="w-full h-auto object-cover">
                    </div>

                    <div
                        class="absolute top-4 right-4 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full animate-pulse shadow-md">
                        LIVE MATCH
                    </div>

                    <div
                        class="absolute -bottom-6 -left-6 bg-white p-4 rounded-lg shadow-xl border border-gray-100 flex items-center gap-4 hidden md:flex">
                        <div class="text-center">
                            <span class="block text-xs font-bold text-gray-400">Ambatukam</span>
                            <span class="block text-2xl font-black text-gray-800">21</span>
                        </div>
                        <div class="text-xl font-bold text-gray-300">:</div>
                        <div class="text-center">
                            <span class="block text-xs font-bold text-gray-400">Tukamamba</span>
                            <span class="block text-2xl font-black text-[#FF6700]">11</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

@endsection
