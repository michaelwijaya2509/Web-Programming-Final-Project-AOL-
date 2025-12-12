@extends('layouts.app')

@section('title', 'Daftar Lapangan')

@section('content')

    <div class="relative w-full h-[600px] flex items-center">

        <img src="https://images.unsplash.com/photo-1554068865-24cecd4e34b8?q=80&w=2070&auto=format&fit=crop"
            alt="Background Court" class="absolute inset-0 w-full h-full object-cover z-0">

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
                <label class="block text-xs font-semibold uppercase tracking-wide opacity-80 mb-1 text-orange-500">Aktivitas</label>
                <div class="flex items-center justify-between cursor-pointer">
                    <span class="font-bold text-lg text-orange-500">Cari Lapangan</span> <i class="fas fa-chevron-down text-sm"></i>
                </div>
            </div>

            <div class="flex-1 w-full md:border-r border-red-700 px-4">
                <label class="block text-xs font-semibold uppercase tracking-wide opacity-80 mb-1 text-orange-500">Lokasi</label>
                <div class="flex items-center justify-between cursor-pointer">
                    <span class="font-bold text-lg text-orange-500">Jakarta Selatan</span>
                    <i class="fas fa-map-marker-alt text-sm"></i>
                </div>
            </div>

            <div class="flex-1 w-full px-4">
                <label class="block text-xs font-semibold uppercase tracking-wide opacity-80 mb-1 text-orange-500">Cabang Olahraga</label>
                <div class="flex items-center justify-between cursor-pointer">
                    <span class="font-bold text-lg text-orange-500">Futsal / Mini Soccer</span>
                    <i class="fas fa-futbol text-sm"></i>
                </div>
            </div>

            <div class="pl-4">
                <button class="bg-white text-ayo-red px-8 py-3 rounded font-bold hover:bg-gray-100 text-orange-500 transition shadow-md">
                    Temukan <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>
    </div>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div>
                <span
                    class="bg-red-800 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">Pemilik
                    Lapangan</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-4 mb-4">
                    Kelola venue lebih praktis dan menguntungkan.
                </h2>
                <p class="text-gray-600 text-lg mb-6">
                    Waktunya buat venue anda lebih dari sekadar venue. Semuanya dimulai dengan pengelolaan yang simpel,
                    fleksibel, dan profitable lewat AYO Venue Management.
                </p>
                <a href="#" class="text-ayo-red font-bold text-lg hover:underline flex items-center">
                    Lihat Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <img src="https://images.unsplash.com/photo-1546519638-68e109498ee2?w=500&q=80"
                    class="rounded-lg shadow-md w-full h-40 object-cover" alt="Futsal">
                <img src="https://images.unsplash.com/photo-1626224583764-84786c713cd3?w=500&q=80"
                    class="rounded-lg shadow-md w-full h-40 object-cover mt-8" alt="Badminton">
                <img src="https://images.unsplash.com/photo-1519861531473-920026393112?w=500&q=80"
                    class="rounded-lg shadow-md w-full h-40 object-cover" alt="Basket">
                <img src="https://images.unsplash.com/photo-1595435934249-5df7ed86e1c0?w=500&q=80"
                    class="rounded-lg shadow-md w-full h-40 object-cover mt-8" alt="Tennis">
            </div>
        </div>
    </section>

    <section class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Rekomendasi Lapangan</h2>
                <a href="{{ url('/courts') }}" class="text-ayo-red font-semibold hover:underline">Lihat Semua</a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($courts as $court)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition duration-300">
                        <div class="h-48 bg-gray-300 relative">
                            <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?w=800&q=80"
                                alt="{{ $court->name }}" class="w-full h-full object-cover">
                            <span class="absolute top-4 left-4 bg-white text-xs font-bold px-2 py-1 rounded text-gray-800">
                                {{ $court->type }}
                            </span>
                        </div>

                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $court->name }}</h3>
                            <p class="text-gray-500 text-sm mb-4">
                                <i class="fas fa-map-marker-alt mr-1"></i> Jakarta Selatan (Dummy Location)
                            </p>

                            <hr class="border-gray-100 my-4">

                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-xs text-gray-400">Mulai dari</p>
                                    <p class="text-ayo-red font-bold text-lg">Rp
                                        {{ number_format($court->price_per_hour, 0, ',', '.') }}/jam</p>
                                </div>
                                <a href="{{ url('/courts/' . $court->id) }}"
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
                <h5 class="text-ayo-red font-bold uppercase tracking-widest mb-2 text-sm">Temukan Lawan Sparring</h5>
                <h2 class="text-4xl font-bold text-gray-900 mb-6">Cari lawan sparring hanya dalam ketukan jari.</h2>
                <p class="text-gray-600 mb-6">
                    Kini kamu ga perlu pusing-pusing cari lawan sparring. Dapatkan teman dan lawan baru dengan mudah tiap
                    minggunya hanya di Aplikasi AYO!
                </p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-ayo-red mt-1 mr-3"></i>
                        <span class="text-gray-700">Lebih dari 10.000 tim terdaftar.</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-ayo-red mt-1 mr-3"></i>
                        <span class="text-gray-700">Mencakup tim dari seluruh wilayah Indonesia.</span>
                    </li>
                </ul>
            </div>
            <div class="md:w-1/2 bg-gray-50 h-full flex justify-center items-end pt-10">
                <img src="https://cdn.dribbble.com/users/6234/screenshots/16383321/media/ef32d1668e146603a111a43a0753a32f.png?resize=400x300&vertical=center"
                    alt="App Mockup" class="w-2/3 object-bottom drop-shadow-2xl">
            </div>
        </div>
    </section>

@endsection
