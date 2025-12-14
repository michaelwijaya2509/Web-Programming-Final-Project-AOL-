@extends('layouts.admin')

@section('title', 'Daftar Venue')

@section('content')

    {{-- HEADER HALAMAN --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Manajemen Venue</h2>
            <p class="text-sm text-gray-500">Kelola daftar lapangan, harga, dan jadwal operasional.</p>
        </div>
        <a href="{{ route('venue.create') }}"
            class="bg-[#FF6700] hover:bg-[#e55d00] text-white px-5 py-2.5 rounded-lg font-medium shadow-lg shadow-orange-500/20 transition flex items-center gap-2 no-underline">
            {{-- Ganti fas fa-plus jadi bi bi-plus-lg --}}
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Venue</span>
        </a>
    </div>

    {{-- ALERT SUCCESS --}}
    @if (session('success'))
        <div
            class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-lg flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <div class="bg-green-100 p-2 rounded-full text-green-600 flex items-center justify-center">
                    {{-- Ganti fas fa-check jadi bi bi-check-lg --}}
                    <i class="bi bi-check-lg"></i>
                </div>
                <p class="text-green-700 font-medium mb-0">{{ session('success') }}</p>
            </div>
            <button onclick="this.parentElement.remove()"
                class="text-green-400 hover:text-green-600 transition bg-transparent border-0">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    @endif

    {{-- TABEL DATA --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Venue Info</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Tipe</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Harga/Jam</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Court
                        </th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($venues as $venue)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            {{-- KOLOM 1: GAMBAR & NAMA --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="relative w-16 h-16 rounded-lg overflow-hidden bg-gray-200 shadow-sm flex-shrink-0">
                                        <img src="{{ asset($venue->venue_image) }}" alt="{{ $venue->name }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-900 text-sm md:text-base mb-1">{{ $venue->name }}
                                        </h3>
                                        <p class="text-xs text-gray-500 flex items-center gap-1 mt-1 mb-1">
                                            {{-- Ganti fa-map-marker jadi bi-geo-alt-fill --}}
                                            <i class="bi bi-geo-alt-fill text-gray-400"></i>
                                            {{ Str::limit($venue->location, 30) }}
                                        </p>
                                        <div class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                                            {{-- Ganti fa-clock jadi bi-clock --}}
                                            <i class="bi bi-clock"></i>
                                            {{ \Carbon\Carbon::parse($venue->open_time)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($venue->close_time)->format('H:i') }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- KOLOM 2: TIPE --}}
                            <td class="px-6 py-4">
                                @php
                                    $badgeColor = match ($venue->type) {
                                        'Badminton' => 'bg-blue-50 text-blue-700 border-blue-200',
                                        'Futsal' => 'bg-green-50 text-green-700 border-green-200',
                                        'Tennis' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                        default => 'bg-gray-50 text-gray-700 border-gray-200',
                                    };
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $badgeColor }}">
                                    {{ $venue->type }}
                                </span>
                            </td>

                            {{-- KOLOM 3: HARGA --}}
                            <td class="px-6 py-4">
                                <span class="font-bold text-[#FF6700]">Rp
                                    {{ number_format($venue->price_per_hour, 0, ',', '.') }}</span>
                            </td>

                            {{-- KOLOM 4: JUMLAH COURT --}}
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                    {{ $venue->courts_count }} Lapangan
                                </span>
                            </td>

                            {{-- KOLOM 5: AKSI --}}
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('venue.edit', $venue->id) }}"
                                        class="group flex items-center gap-2 px-3 py-2 bg-white border border-blue-200 text-blue-600 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition shadow-sm no-underline"
                                        title="Edit Venue">
                                        {{-- Ganti fa-edit jadi bi-pencil-square --}}
                                        <i class="bi bi-pencil-square group-hover:scale-110 transition-transform"></i>
                                        <span class="text-xs font-bold">Edit</span>
                                    </a>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('venue.destroy', $venue->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus venue ini?');" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="group flex items-center gap-2 px-3 py-2 bg-white border border-red-200 text-red-600 rounded-lg hover:bg-red-50 hover:border-red-300 transition shadow-sm"
                                            title="Hapus Venue">
                                            {{-- Ganti fa-trash jadi bi-trash --}}
                                            <i class="bi bi-trash group-hover:scale-110 transition-transform"></i>
                                            <span class="text-xs font-bold">Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-3">
                                        {{-- Icon Toko Tutup / Kosong --}}
                                        <i class="bi bi-shop text-2xl text-gray-400"></i>
                                    </div>
                                    <p class="font-medium text-lg text-gray-800">Belum ada venue</p>
                                    <p class="text-sm text-gray-500 mb-4">Tambahkan venue pertama Anda untuk mulai
                                        mengelola.</p>
                                    <a href="{{ route('venue.create') }}"
                                        class="text-[#FF6700] hover:text-[#e55d00] font-bold text-sm flex items-center gap-1 no-underline">
                                        <i class="bi bi-plus-circle"></i> Tambah Venue Baru
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if ($venues->hasPages())
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                {{ $venues->links() }}
            </div>
        @endif
    </div>

@endsection
