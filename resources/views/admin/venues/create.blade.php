@extends('layouts.admin')

@section('title', 'Tambah Venue Baru')

@section('content')

    {{-- HEADER & TOMBOL KEMBALI --}}
    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('venue.index') }}"
            class="p-2 rounded-lg bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition">
            <i class="bi bi-arrow-left text-lg"></i>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Tambah Venue Baru</h2>
            <p class="text-sm text-gray-500">Isi detail gedung/lokasi lapangan di bawah ini.</p>
        </div>
    </div>

    <div class="max-w-4xl bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('venue.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Venue</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="bi bi-building"></i>
                        </span>
                        <input type="text" name="name" required
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-[#FF6700] focus:border-[#FF6700] transition"
                            placeholder="Contoh: GOR Sudirman">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tipe Olahraga</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="bi bi-trophy"></i>
                        </span>
                        <select name="type"
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-[#FF6700] focus:border-[#FF6700] bg-white">
                            <option value="Badminton">Badminton</option>
                            <option value="Futsal">Futsal</option>
                            <option value="Tennis">Tennis</option>
                            <option value="Basketball">Basketball</option>
                            <option value="Mini Soccer">Mini Soccer</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Harga Dasar (Per Jam)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 font-bold">Rp</span>
                        <input type="number" name="price_per_hour" required
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-[#FF6700] focus:border-[#FF6700]"
                            placeholder="50000">
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="bi bi-geo-alt"></i>
                        </span>
                        <input type="text" name="location" required
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-[#FF6700] focus:border-[#FF6700]"
                            placeholder="Jl. Raya...">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Jam Buka</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="bi bi-clock"></i>
                        </span>
                        <input type="time" name="open_time" required
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-[#FF6700] focus:border-[#FF6700]">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Jam Tutup</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <i class="bi bi-clock-fill"></i>
                        </span>
                        <input type="time" name="close_time" required
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-[#FF6700] focus:border-[#FF6700]">
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi (Fasilitas, dll)</label>
                    <textarea name="description" rows="3"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-[#FF6700] focus:border-[#FF6700]"
                        placeholder="Jelaskan fasilitas yang tersedia..."></textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Foto Venue</label>
                    <input type="file" name="venue_image" required
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-orange-50 file:text-[#FF6700] hover:file:bg-orange-100 transition cursor-pointer border border-gray-200 rounded-lg">
                    <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG. Maksimal 2MB.</p>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
                <a href="{{ route('venue.index') }}"
                    class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-bold transition no-underline">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-[#FF6700] hover:bg-[#e55d00] text-white rounded-lg font-bold shadow-lg shadow-orange-500/30 transition flex items-center gap-2">
                    <i class="bi bi-save"></i> Simpan Venue
                </button>
            </div>
        </form>
    </div>
@endsection
