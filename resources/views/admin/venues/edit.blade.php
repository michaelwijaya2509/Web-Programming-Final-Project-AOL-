@extends('layouts.admin')

@section('title', 'Edit Venue')

@section('content')

    {{-- HEADER --}}
    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('venue.index') }}"
            class="p-2 rounded-lg bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition">
            <i class="bi bi-arrow-left text-lg"></i>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Edit Venue: {{ $venue->name }}</h2>
            <p class="text-sm text-gray-500">Update informasi venue dan kelola lapangan (court).</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- BAGIAN KIRI: FORM EDIT VENUE --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-3 flex items-center gap-2">
                    <i class="bi bi-pencil-square text-[#FF6700]"></i> Edit Informasi
                </h3>

                <form action="{{ route('venue.update', $venue->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="md:col-span-2">
                            <label class="text-sm font-bold text-gray-700 mb-1">Nama Venue</label>
                            <input type="text" name="name" value="{{ $venue->name }}"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-[#FF6700] focus:ring-[#FF6700]">
                        </div>

                        <div>
                            <label class="text-sm font-bold text-gray-700 mb-1">Tipe</label>
                            <select name="type"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-[#FF6700] bg-white">
                                <option value="Badminton" {{ $venue->type == 'Badminton' ? 'selected' : '' }}>Badminton
                                </option>
                                <option value="Futsal" {{ $venue->type == 'Futsal' ? 'selected' : '' }}>Futsal</option>
                                <option value="Tennis" {{ $venue->type == 'Tennis' ? 'selected' : '' }}>Tennis</option>
                                <option value="Basketball" {{ $venue->type == 'Basketball' ? 'selected' : '' }}>Basketball
                                </option>
                                <option value="Mini Soccer" {{ $venue->type == 'Mini Soccer' ? 'selected' : '' }}>Mini
                                    Soccer</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-sm font-bold text-gray-700 mb-1">Harga/Jam</label>
                            <input type="number" name="price_per_hour" value="{{ $venue->price_per_hour }}"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-[#FF6700]">
                        </div>

                        <div>
                            <label class="text-sm font-bold text-gray-700 mb-1">Jam Buka</label>
                            <input type="time" name="open_time" value="{{ $venue->open_time }}"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300">
                        </div>
                        <div>
                            <label class="text-sm font-bold text-gray-700 mb-1">Jam Tutup</label>
                            <input type="time" name="close_time" value="{{ $venue->close_time }}"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300">
                        </div>

                        <div class="md:col-span-2">
                            <label class="text-sm font-bold text-gray-700 mb-1">Lokasi</label>
                            <input type="text" name="location" value="{{ $venue->location }}"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-[#FF6700]">
                        </div>

                        <div class="md:col-span-2">
                            <label class="text-sm font-bold text-gray-700 mb-1">Deskripsi</label>
                            <textarea name="description" rows="3"
                                class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:border-[#FF6700]">{{ $venue->description }}</textarea>
                        </div>

                        <div class="md:col-span-2">
                            <label class="text-sm font-bold text-gray-700 mb-2 block">Foto Saat Ini</label>
                            <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <img src="{{ asset($venue->venue_image) }}"
                                    class="w-24 h-24 rounded-lg object-cover border border-gray-300 shadow-sm">
                                <div class="flex-1">
                                    <label class="block text-xs font-bold text-gray-500 mb-1">Ganti Foto (Opsional)</label>
                                    <input type="file" name="venue_image"
                                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-white file:text-[#FF6700] file:border file:border-[#FF6700] hover:file:bg-orange-50 cursor-pointer">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-right border-t border-gray-100 pt-4">
                        <button type="submit"
                            class="bg-[#FF6700] hover:bg-[#e55d00] text-white px-6 py-2.5 rounded-lg font-bold shadow-lg shadow-orange-500/20 transition flex items-center gap-2 ml-auto">
                            <i class="bi bi-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- BAGIAN KANAN: MANAGE COURTS --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-6">
                <div class="flex justify-between items-center mb-4 border-b pb-3">
                    <h3 class="text-lg font-bold text-gray-800">Daftar Court</h3>
                    <span
                        class="text-xs bg-orange-100 text-[#FF6700] px-2 py-1 rounded-full font-bold">{{ $venue->courts->count() }}
                        Unit</span>
                </div>

                {{-- Form Tambah Court --}}
                <form action="{{ route('venues.courts.store', $venue->id) }}" method="POST"
                    class="mb-6 bg-gray-50 p-4 rounded-lg border border-gray-200">
                    @csrf
                    <label class="text-xs font-bold text-gray-500 uppercase block mb-2">Tambah Court Baru</label>
                    <div class="flex gap-2">
                        <input type="text" name="name" placeholder="Nama (mis: Lapangan 1)"
                            class="w-full text-sm px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-[#FF6700]"
                            required>
                        <button type="submit"
                            class="bg-gray-800 hover:bg-black text-white px-3 py-2 rounded-lg text-lg font-bold transition">
                            <i class="bi bi-plus-lg"></i>
                        </button>
                    </div>
                </form>

                {{-- List Courts --}}
                <div class="space-y-3 max-h-[500px] overflow-y-auto pr-1">
                    @forelse($venue->courts as $court)
                        <div
                            class="flex justify-between items-center p-3 border border-gray-100 rounded-lg hover:border-orange-200 transition bg-white shadow-sm group">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-2.5 h-2.5 rounded-full {{ $court->is_active ? 'bg-green-500' : 'bg-red-500' }}">
                                </div>
                                <span class="font-bold text-gray-700 text-sm">{{ $court->name }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                {{-- Toggle Status --}}
                                <form action="{{ route('venues.courts.toggle', $court->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit"
                                        class="w-8 h-8 flex items-center justify-center rounded-lg transition {{ $court->is_active ? 'text-green-600 hover:bg-green-50' : 'text-gray-400 hover:bg-gray-100' }}"
                                        title="{{ $court->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                        <i
                                            class="bi {{ $court->is_active ? 'bi-toggle-on text-xl' : 'bi-toggle-off text-xl' }}"></i>
                                    </button>
                                </form>

                                {{-- Hapus Court --}}
                                <form action="{{ route('venues.courts.destroy', $court->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus court ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="w-8 h-8 flex items-center justify-center rounded-lg text-red-400 hover:text-red-600 hover:bg-red-50 transition"
                                        title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6 text-gray-400">
                            <i class="bi bi-inbox text-3xl mb-2 block opacity-50"></i>
                            <p class="text-sm">Belum ada court.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
