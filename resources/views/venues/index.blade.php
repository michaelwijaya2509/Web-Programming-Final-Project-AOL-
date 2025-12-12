@extends('layouts.app')

@section('title', 'Daftar Lapangan')

@section('content')

<section class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- FILTER BAR --}}
        <div class="mb-10 relative z-40">
            <form action="{{ route('venues.index') }}" method="GET" id="filterForm">

                <div class="bg-white p-3 rounded-2xl shadow-lg border border-gray-100 flex flex-col lg:flex-row items-stretch lg:items-center gap-3 relative z-40">

                    {{-- SEARCH BAR --}}
                    <div class="flex-grow relative group z-40">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400 group-focus-within:text-[#FF6700] transition"></i>
                        </div>

                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               class="w-full pl-11 pr-4 py-3 bg-gray-50 
                                      border-transparent focus:bg-white focus:border-[#FF6700] 
                                      focus:ring-0 rounded-xl text-gray-700 placeholder-gray-400 
                                      transition duration-200 relative z-40"
                               placeholder="Cari nama venue atau lokasi...">
                    </div>

                    <div class="hidden lg:block w-px h-10 bg-gray-200 mx-1"></div>

                    {{-- TYPE DROPDOWN --}}
                    <div class="w-full lg:w-64 relative group z-40">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-50">
                            <i class="fas fa-running text-gray-400 group-focus-within:text-[#FF6700] transition"></i>
                        </div>

                        <select name="type"
                                class="w-full pl-11 pr-10 py-3 bg-gray-50 border-transparent 
                                       focus:bg-white focus:border-[#FF6700] focus:ring-0 rounded-xl 
                                       text-gray-700 appearance-none cursor-pointer transition duration-200 
                                       relative z-40">
                            <option value="">Semua Tipe</option>
                            <option value="badminton" {{ request('type') == 'badminton' ? 'selected' : '' }}>Badminton</option>
                            <option value="padel" {{ request('type') == 'padel' ? 'selected' : '' }}>Padel</option>
                            <option value="pickleball" {{ request('type') == 'pickleball' ? 'selected' : '' }}>Pickleball</option>
                            <option value="tenis" {{ request('type') == 'tenis' ? 'selected' : '' }}>Tennis</option>
                        </select>

                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none z-50">
                            <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                        </div>
                    </div>

                    {{-- PRICE MODAL BUTTON --}}
                    <button type="button" 
                            onclick="toggleModal('priceModal')"
                            class="relative flex items-center justify-center gap-2 px-4 py-3 z-40 cursor-pointer
                                   {{ request('min_price') || request('max_price') ? 'bg-[#FF6700] text-white' : 'bg-red-50 text-[#FF6700] hover:bg-red-100' }} 
                                   rounded-xl transition duration-200 border border-transparent">
                        <i class="fas fa-sliders-h"></i>
                        <span class="font-medium text-sm whitespace-nowrap">
                            {{ request('min_price') || request('max_price') ? 'Harga Terfilter' : 'Filter Harga' }}
                        </span>
                    </button>

                    {{-- SUBMIT BUTTON --}}
                    <button type="submit"
                            class="w-full lg:w-auto px-8 py-3 bg-[#FF6700] hover:bg-[#e55d00] text-white font-bold rounded-xl shadow-lg shadow-orange-500/30 transition duration-300 flex items-center justify-center gap-2 z-40 cursor-pointer">
                        <i class="fas fa-search text-sm"></i>
                        <span>Cari</span>
                    </button>
                </div>

                {{-- PRICE MODAL --}}
                <div id="priceModal" class="fixed inset-0 z-[9999] hidden pointer-events-none" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity pointer-events-auto" onclick="toggleModal('priceModal')"></div>

                    <div class="fixed inset-0 z-[10000] overflow-y-auto pointer-events-none">
                        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0 pointer-events-none">

                            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-gray-100 pointer-events-auto">

                                {{-- MODAL HEADER --}}
                                <div class="bg-gray-50 px-4 py-3 sm:px-6 flex justify-between items-center border-b border-gray-100">
                                    <h3 class="text-base font-bold leading-6 text-gray-900" id="modal-title">Filter Range Harga</h3>
                                    <button type="button" onclick="toggleModal('priceModal')" class="text-gray-400 hover:text-gray-500">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>

                                {{-- MODAL BODY --}}
                                <div class="px-4 py-5 sm:p-6 space-y-4">

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Harga Minimum</label>
                                        <div class="relative rounded-md shadow-sm">
                                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                                <span class="text-gray-500 sm:text-sm">Rp</span>
                                            </div>
                                            <input type="number" name="min_price" value="{{ request('min_price') }}"
                                                   class="block w-full rounded-lg border-gray-300 pl-10 focus:border-[#FF6700] focus:ring-[#FF6700] sm:text-sm py-2.5 bg-gray-50"
                                                   placeholder="0">
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Harga Maksimum</label>
                                        <div class="relative rounded-md shadow-sm">
                                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                                <span class="text-gray-500 sm:text-sm">Rp</span>
                                            </div>
                                            <input type="number" name="max_price" value="{{ request('max_price') }}"
                                                   class="block w-full rounded-lg border-gray-300 pl-10 focus:border-[#FF6700] focus:ring-[#FF6700] sm:text-sm py-2.5 bg-gray-50"
                                                   placeholder="Tak Terbatas">
                                        </div>
                                    </div>

                                </div>

                                {{-- MODAL FOOTER --}}
                                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-2">
                                    <button type="button" onclick="toggleModal('priceModal')"
                                            class="inline-flex w-full justify-center rounded-lg bg-[#FF6700] px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-[#e55d00] sm:w-auto">
                                        Simpan Filter
                                    </button>

                                    <button type="button" onclick="clearPrices()"
                                            class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                        Reset Harga
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>

            {{-- CLEAR FILTERS --}}
            @if (request('search') || request('type') || request('min_price') || request('max_price'))
                <div class="mt-4 flex flex-wrap gap-2 animate-fade-in">
                    <a href="{{ route('venues.index') }}"
                       class="text-sm text-red-500 hover:text-red-700 hover:underline flex items-center gap-1">
                        <i class="fas fa-times-circle"></i> Hapus Semua Filter
                    </a>
                </div>
            @endif
        </div>


        {{-- SORT BAR --}}
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <p class="text-gray-500 font-medium text-sm md:text-base">
                Menampilkan <span class="font-bold text-gray-900">{{ count($venues) }} venue</span> tersedia
            </p>

            <div class="flex items-center gap-2">
                <span class="text-gray-500 text-sm">Urutan berdasarkan:</span>
                <div class="relative group">
                    <button class="flex items-center gap-2 font-bold text-gray-800 bg-white border border-gray-200 px-4 py-2 rounded-lg hover:border-[#FF6700] transition">
                        Popularitas <i class="fas fa-chevron-down text-xs text-[#FF6700]"></i>
                    </button>

                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-100 hidden group-hover:block z-10">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-[#FF6700]">Harga Termurah</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-[#FF6700]">Rating Tertinggi</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- VENUE GRID --}}
        @if ($venues->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($venues as $venue)
                    <a href="#"
                       class="group block bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl hover:border-[#FF6700] transition duration-300 transform hover:-translate-y-1">

                        <div class="relative h-56 bg-gray-200 overflow-hidden">
                            <img src="{{ $venue->venue_image }}"
                                 alt="{{ $venue->name }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-[#FF6700] shadow-sm">
                                {{ $venue->type }}
                            </div>
                        </div>

                        <div class="p-5">
                            <div class="flex justify-between items-start mb-2">
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Venue</p>
                                <div class="flex items-center gap-1 text-xs font-bold text-gray-900 bg-gray-100 px-2 py-1 rounded">
                                    <i class="fas fa-star text-yellow-400"></i> {{ number_format($venue->rating, 1) }}
                                </div>
                            </div>

                            <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-[#FF6700] transition line-clamp-1">
                                {{ $venue->name }}
                            </h3>

                            <p class="text-sm text-gray-500 mb-4 flex items-center gap-1">
                                <i class="fas fa-map-marker-alt text-gray-300"></i> {{ $venue->location }}
                            </p>

                            <div class="border-t border-gray-100 pt-4 flex items-center justify-between">
                                <div class="flex flex-col">
                                    <span class="text-xs text-gray-400">Harga Mulai</span>
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-lg font-extrabold text-[#FF6700]">
                                            Rp{{ number_format($venue->price_per_hour, 0, ',', '.') }}
                                        </span>
                                        <span class="text-xs text-gray-500">/jam</span>
                                    </div>
                                </div>
                                <span class="text-sm font-semibold text-[#FF6700] bg-orange-50 px-3 py-2 rounded-lg group-hover:bg-[#FF6700] group-hover:text-white transition">
                                    Booking
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-12 text-center">
                <a href="#"
                   class="inline-flex items-center justify-center px-8 py-3 border border-[#FF6700] text-base font-bold rounded-md text-[#FF6700] bg-white hover:bg-[#FF6700] hover:text-white transition md:py-3 md:text-lg md:px-10">
                    Lihat Semua Venue
                </a>
            </div>
        @else
            <div class="text-center py-20">
                <div class="bg-gray-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-search text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Lapangan tidak ditemukan</h3>
                <p class="text-gray-500">Coba ubah kata kunci atau reset filter Anda.</p>
                <a href="{{ route('venues.index') }}"
                   class="inline-block mt-4 text-[#FF6700] font-bold hover:underline">Reset Filter</a>
            </div>
        @endif

    </div>
</section>

{{-- JS --}}
<script>
    function toggleModal(id) {
        const modal = document.getElementById(id);
        modal.classList.toggle("hidden");
        
        // Manage body scroll when modal is open
        if (!modal.classList.contains("hidden")) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = 'auto';
        }
    }
    
    function clearPrices() {
        document.querySelector('input[name="min_price"]').value = '';
        document.querySelector('input[name="max_price"]').value = '';
    }
</script>

@endsection
