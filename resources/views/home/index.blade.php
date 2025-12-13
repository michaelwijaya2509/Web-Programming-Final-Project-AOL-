@extends('layouts.app')

@section('title', 'Daftar Lapangan')

@section('content')

    <div class="relative w-full h-[650px] flex items-center justify-center overflow-hidden">

        <img src="https://images.unsplash.com/photo-1622279457486-62dcc4a431d6?q=80&w=2070&auto=format&fit=crop"
            alt="Court Background" class="absolute inset-0 w-full h-full object-cover z-0 filter brightness-[0.4]">

        <div class="absolute inset-0 bg-gradient-to-tr from-gray-900 via-transparent to-orange-900/40 z-10"></div>

        <div class="relative z-20 container mx-auto px-6 md:px-12 text-center">

            <div class="inline-block mb-6 animate-fade-in-down">
                <span
                    class="py-1 px-3 rounded-full bg-orange-500/20 border border-[#FF6700] text-[#FF6700] text-sm font-bold tracking-widest uppercase backdrop-blur-sm">
                    Platform Sewa Lapangan
                </span>
            </div>

            <h1 class="text-5xl md:text-7xl font-black text-white mb-6 tracking-tight leading-tight drop-shadow-2xl">
                Main Lebih Seru, <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FF6700] to-yellow-400">Booking Lebih
                    Cepat.</span>
            </h1>

            <p class="text-lg md:text-2xl text-gray-200 mb-10 max-w-3xl mx-auto font-light leading-relaxed">
                Akses lapangan Padel, Tennis, Badminton, dan Pickleball terbaik langsung dari browser Anda.
                Cek jadwal real-time, bayar aman, langsung main.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-5">
                <a href="{{ url('/venue') }}"
                    class="group relative px-8 py-4 bg-[#FF6700] rounded-full text-white font-bold text-lg shadow-[0_0_20px_rgba(255,103,0,0.5)] hover:shadow-[0_0_40px_rgba(255,103,0,0.8)] transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                    <span class="relative z-10 flex items-center gap-2">
                        Cari Lapangan <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </span>
                    <div
                        class="absolute inset-0 bg-white/20 transform -skew-x-12 -translate-x-full group-hover:translate-x-0 transition-transform duration-500">
                    </div>
                </a>

                <a href="{{ url('/scoreboard') }}"
                    class="px-8 py-4 rounded-full border-2 border-white text-white font-bold text-lg hover:bg-white hover:text-gray-900 transition-all duration-300 backdrop-blur-sm flex items-center gap-2">
                    <i class="fas fa-desktop"></i> Coba Scoreboard
                </a>
            </div>

        </div>
    </div>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-[#FF6700] font-bold tracking-widest uppercase text-sm mb-3">Kenapa Harus Meraket?</h2>
                <h3 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6">
                    Tinggalkan Cara Lama, <br>
                    <span class="underline decoration-[#FF6700] underline-offset-4">Mulai Era Digital.</span>
                </h3>
                <p class="text-gray-500 text-lg">
                    Tidak perlu lagi telepon venue satu per satu. Nikmati kemudahan teknologi untuk pengalaman olahraga yang
                    lebih seamless.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div
                    class="group relative p-8 bg-gray-50 rounded-3xl border border-gray-100 hover:border-[#FF6700] transition-all duration-500 hover:shadow-2xl hover:shadow-orange-100 hover:-translate-y-2 cursor-default overflow-hidden">
                    <div
                        class="absolute -right-10 -top-10 w-40 h-40 bg-orange-100 rounded-full transition-transform duration-500 group-hover:scale-[10]">
                    </div>

                    <div class="relative z-10">
                        <div
                            class="w-16 h-16 bg-white rounded-2xl shadow-md flex items-center justify-center mb-8 text-3xl text-[#FF6700] group-hover:text-white group-hover:bg-[#FF6700] transition-colors duration-300">
                            <i class="far fa-calendar-check"></i>
                        </div>

                        <h4 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-gray-800">Booking Real-time</h4>
                        <p class="text-gray-600 leading-relaxed mb-6 group-hover:text-gray-700">
                            Cek ketersediaan lapangan Padel atau Badminton detik ini juga. Slot waktu selalu update tanpa
                            perlu konfirmasi manual.
                        </p>

                        <div
                            class="flex items-center text-[#FF6700] font-bold opacity-0 -translate-x-4 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-500">
                            Cari Lapangan <i class="fas fa-long-arrow-alt-right ml-2"></i>
                        </div>
                    </div>
                </div>

                <div
                    class="group relative p-8 bg-gray-50 rounded-3xl border border-gray-100 hover:border-[#FF6700] transition-all duration-500 hover:shadow-2xl hover:shadow-orange-100 hover:-translate-y-2 cursor-default overflow-hidden">
                    <div
                        class="absolute -right-10 -top-10 w-40 h-40 bg-orange-100 rounded-full transition-transform duration-500 group-hover:scale-[10]">
                    </div>

                    <div class="relative z-10">
                        <div
                            class="w-16 h-16 bg-white rounded-2xl shadow-md flex items-center justify-center mb-8 text-3xl text-[#FF6700] group-hover:text-white group-hover:bg-[#FF6700] transition-colors duration-300">
                            <i class="fas fa-shield-alt"></i>
                        </div>

                        <h4 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-gray-800">Pembayaran Aman</h4>
                        <p class="text-gray-600 leading-relaxed mb-6 group-hover:text-gray-700">
                            Sistem pembayaran terintegrasi dengan QRIS dan Virtual Account. Transaksi aman, status booking
                            langsung aktif.
                        </p>

                        <div
                            class="flex items-center text-[#FF6700] font-bold opacity-0 -translate-x-4 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-500">
                            Pelajari Metode <i class="fas fa-long-arrow-alt-right ml-2"></i>
                        </div>
                    </div>
                </div>

                <div
                    class="group relative p-8 bg-gray-50 rounded-3xl border border-gray-100 hover:border-[#FF6700] transition-all duration-500 hover:shadow-2xl hover:shadow-orange-100 hover:-translate-y-2 cursor-default overflow-hidden">
                    <div
                        class="absolute -right-10 -top-10 w-40 h-40 bg-orange-100 rounded-full transition-transform duration-500 group-hover:scale-[10]">
                    </div>

                    <div class="relative z-10">
                        <div
                            class="w-16 h-16 bg-white rounded-2xl shadow-md flex items-center justify-center mb-8 text-3xl text-[#FF6700] group-hover:text-white group-hover:bg-[#FF6700] transition-colors duration-300">
                            <i class="fas fa-tablet-alt"></i>
                        </div>

                        <h4 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-gray-800">Scoreboard Digital</h4>
                        <p class="text-gray-600 leading-relaxed mb-6 group-hover:text-gray-700">
                            Lupakan papan skor manual. Catat poin pertandinganmu dengan mudah menggunakan fitur Scoreboard
                            web kami.
                        </p>

                        <div
                            class="flex items-center text-[#FF6700] font-bold opacity-0 -translate-x-4 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-500">
                            Mulai Hitung Skor <i class="fas fa-long-arrow-alt-right ml-2"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

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

        <!-- <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

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
                    <img src="https://plus.unsplash.com/premium_photo-1663045882560-3bdd5f71687c?q=80&w=1976&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
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
                    <img src="https://images.unsplash.com/photo-1521537634581-0dced2fee2ef?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
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
        </div> -->
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
                    <a href="/venue?search=&type=padel&min_price=&max_price=" 
                        class="inline-block bg-[#FF6700] hover:bg-orange-700 text-white text-xs font-bold py-3 px-6 rounded transition shadow-md">
                        Booking Now
                    </a>
                </div>
            </div>
        </div>

        <div class="court-card group">
            <img src="https://plus.unsplash.com/premium_photo-1663045882560-3bdd5f71687c?q=80&w=1976&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
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
                    <a href="/venue?search=&type=tenis&min_price=&max_price=" 
                        class="inline-block bg-[#FF6700] hover:bg-orange-700 text-white text-xs font-bold py-3 px-6 rounded transition shadow-md">
                        Booking Now
                    </a>
                </div>
            </div>
        </div>

        <div class="court-card group">
            <img src="https://images.unsplash.com/photo-1521537634581-0dced2fee2ef?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
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
                    <a href="/venue?search=&type=badminton&min_price=&max_price=" 
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
                    <a href="/venue?search=&type=pickleball&min_price=&max_price=" 
                        class="inline-block bg-[#FF6700] hover:bg-orange-700 text-white text-xs font-bold py-3 px-6 rounded transition shadow-md">
                        Booking Now
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
    </section>

    <section class="bg-gray-50 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                <div>
                    <span
                        class="text-[#FF6700] font-bold tracking-widest uppercase text-xs md:text-sm bg-orange-100 px-3 py-1 rounded-full">
                        Pilihan Editor
                    </span>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mt-4 leading-tight">
                        Rekomendasi <span class="text-[#FF6700]">Venue</span>
                    </h2>
                    <p class="text-gray-500 mt-2 max-w-lg">Temukan lapangan dengan rating tertinggi dan fasilitas
                        terlengkap di dekatmu.</p>
                </div>

                <a href="{{ url('/venue') }}"
                    class="group flex items-center gap-2 text-gray-600 font-semibold hover:text-[#FF6700] transition bg-white px-5 py-3 rounded-full border border-gray-200 shadow-sm hover:shadow-md">
                    Lihat Semua Venue
                    <i
                        class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform text-[#FF6700]"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($venues as $venue)
                    <div
                        class="group bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl hover:shadow-orange-500/10 hover:border-orange-200 hover:-translate-y-1 transition-all duration-300 flex flex-col h-full">

                        <div class="h-60 bg-gray-200 relative overflow-hidden">
                            <img src="{{ $venue->venue_image }}" alt="{{ $venue->name }}"
                                class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110">

                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60">
                            </div>

                            <div class="absolute top-4 left-4 flex gap-2">
                                <span
                                    class="bg-white/95 backdrop-blur text-gray-900 text-[10px] font-bold px-3 py-1 rounded-full shadow-sm uppercase tracking-wide border border-gray-100">
                                    {{ $venue->type }}
                                </span>
                            </div>

                            <div
                                class="absolute top-4 right-4 bg-gray-900/80 backdrop-blur text-white text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1 shadow-md">
                                <i class="fas fa-star text-yellow-400 text-[10px]"></i>
                                <span>4.8</span>
                            </div>

                            <div class="absolute bottom-4 left-4 text-white">
                                <div class="flex items-center gap-2">
                                    <span class="relative flex h-2.5 w-2.5">
                                        <span
                                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
                                    </span>
                                    <span class="text-xs font-medium text-gray-200">Booking Now</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 flex flex-col flex-grow">

                            <div class="mb-4">
                                <h3
                                    class="text-xl font-bold text-gray-900 mb-2 group-hover:text-[#FF6700] transition-colors line-clamp-1">
                                    {{ $venue->name }}
                                </h3>
                                <div class="flex items-start text-sm text-gray-500">
                                    <i class="fas fa-map-marker-alt text-[#FF6700] mt-1 mr-2 flex-shrink-0"></i>
                                    <span
                                        class="line-clamp-2">{{ $venue->location ?? 'Jakarta Selatan, DKI Jakarta' }}</span>
                                </div>
                            </div>

                            <div class="mb-6">
                                <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider mb-2">Fasilitas</p>
                                <div class="flex gap-3 text-gray-400">
                                    <div class="flex flex-col items-center gap-1" title="WiFi">
                                        <i class="fas fa-wifi bg-gray-50 p-2 rounded-lg text-gray-500 text-xs"></i>
                                    </div>
                                    <div class="flex flex-col items-center gap-1" title="Parkir">
                                        <i class="fas fa-parking bg-gray-50 p-2 rounded-lg text-gray-500 text-xs"></i>
                                    </div>
                                    <div class="flex flex-col items-center gap-1" title="Kantin">
                                        <i class="fas fa-utensils bg-gray-50 p-2 rounded-lg text-gray-500 text-xs"></i>
                                    </div>
                                    <div class="flex flex-col items-center gap-1" title="Locker">
                                        <i class="fas fa-lock bg-gray-50 p-2 rounded-lg text-gray-500 text-xs"></i>
                                    </div>
                                    <span class="text-xs self-center ml-auto text-gray-400">+3 Lainnya</span>
                                </div>
                            </div>

                            <div class="border-t border-dashed border-gray-200 my-auto"></div>

                            <div class="flex justify-between items-center mt-5 pt-2">
                                <div>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wide">Mulai Dari</p>
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-[#FF6700] font-black text-xl">
                                            Rp {{ number_format($venue->price_per_hour / 1000, 0) }}rb
                                        </span>
                                        <span class="text-xs text-gray-400 font-medium">/jam</span>
                                    </div>
                                </div>

                                <a href="{{ url('/venues/' . $venue->id) }}"
                                    class="relative overflow-hidden bg-gray-900 text-white px-6 py-3 rounded-xl text-sm font-bold shadow-lg group-hover:bg-[#FF6700] group-hover:shadow-orange-500/40 transition-all duration-300 w-32 text-center">
                                    <span
                                        class="absolute inset-0 flex items-center justify-center transform transition-transform duration-300 group-hover:-translate-y-full">
                                        Detail
                                    </span>
                                    <span
                                        class="absolute inset-0 flex items-center justify-center transform translate-y-full transition-transform duration-300 group-hover:translate-y-0">
                                        Booking
                                    </span>
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
