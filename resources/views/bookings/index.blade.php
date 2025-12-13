@extends('layouts.app')

@section('title', 'My Bookings')

{{-- HAPUS DUPLIKASI @section('content') DI SINI --}}
@section('content')
    <div class="container mx-auto px-4 py-12 max-w-6xl">

        <h1 class="text-3xl font-extrabold text-gray-900 mb-8 border-l-4 border-[#FF6700] pl-4">
            My Bookings
        </h1>

        @if ($bookings->isEmpty())
            <div class="bg-white p-12 rounded-xl shadow-lg border-t-4 border-red-700 text-center">
                <i class="fas fa-calendar-times text-6xl text-gray-300 mb-4"></i>
                <p class="text-xl font-semibold text-gray-600">Anda belum memiliki riwayat pemesanan.</p>
                <p class="text-gray-500 mt-2">Ayo, temukan venue favorit Anda dan mulai booking sekarang!</p>
                <a href="{{ route('venues.index') }}"
                    class="mt-6 inline-block bg-#FF6700 text-[#FF6700] px-6 py-2 rounded-full font-bold hover:bg-red-800 transition shadow-md">
                    Cari Venue
                </a>
            </div>
        @else
            <div class="space-y-6">
                @foreach ($bookings as $i => $booking)
                    <div
                        class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col md:flex-row border border-gray-100 hover:shadow-xl transition duration-300">

                        <div class="md:w-64 w-full h-48 md:h-auto flex-shrink-0 relative">
                            {{-- Menggunakan gambar venue dari relasi --}}
                            <img src="{{ $booking->venue->venue_image ?? asset('images/default-venue.jpg') }}"
                                alt="{{ $booking->venue->name ?? 'Venue Dihapus' }}" class="w-full h-full object-cover">

                            <span
                                class="absolute top-3 left-3 bg-white/90 text-xs font-bold px-3 py-1 rounded-full shadow-md text-[#FF6700]">
                                {{ $booking->venue->type ?? 'N/A' }}
                            </span>
                        </div>

                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div class="mb-4">
                                <h2 class="text-xl font-bold text-gray-900 line-clamp-1">
                                    {{ $booking->venue->name ?? 'Venue Tidak Ditemukan' }}
                                </h2>
                                <p class="text-md text-gray-600 font-semibold mt-1">
                                    Court: {{ $booking->court->court_name ?? 'Court Dihapus' }}
                                </p>
                            </div>

                            <div class="grid grid-cols-2 gap-4 text-sm text-gray-700 mb-4 pb-4 border-b border-gray-100">
                                <div>
                                    <i class="far fa-calendar-alt text-red-700 mr-2"></i>
                                    <span class="font-semibold">Tanggal:</span>
                                    {{ $booking->booking_date->format('d M Y') }}
                                </div>
                                <div>
                                    <i class="far fa-clock text-red-700 mr-2"></i>
                                    <span class="font-semibold">Waktu:</span>
                                    {{ date('H:i', strtotime($booking->start_time)) }} -
                                    {{ date('H:i', strtotime($booking->end_time)) }} WIB
                                </div>
                                <div>
                                    <i class="fas fa-map-marker-alt text-red-700 mr-2"></i>
                                    <span class="font-semibold">Lokasi:</span>
                                    {{ $booking->venue->location ?? 'N/A' }}
                                </div>
                                <div>
                                    <i class="fas fa-hourglass-half text-red-700 mr-2"></i>
                                    <span class="font-semibold">Durasi:</span>
                                    {{ $durations[$i] }} Jam
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <span class="text-sm font-semibold text-gray-500">Total Pembayaran:</span>
                                <span class="text-2xl font-extrabold text-green-600">
                                    Rp{{ number_format($booking->total_price, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <div
                            class="md:w-48 w-full p-5 bg-gray-50 flex flex-col justify-between border-t md:border-t-0 md:border-l border-gray-100">
                            <div class="text-center">
                                <p class="text-xs font-semibold text-gray-500 mb-2 uppercase">Status Booking</p>

                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'paid' => 'bg-green-100 text-green-800',
                                        'completed' => 'bg-blue-100 text-blue-800',
                                        'cancelled' => 'bg-red-100 text-red-800',
                                    ];
                                    $statusText = ucfirst($booking->status);
                                @endphp

                                <span
                                    class="inline-block px-3 py-1 rounded-full text-sm font-bold {{ $statusClasses[$booking->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $statusText }}
                                </span>
                            </div>

                            <div class="mt-4">
                                {{-- LOGIKA STATUS BUTTON --}}
                                @if ($booking->status == 'pending')
                                    <a href="{{ route('payment.show', $booking->id) }}"
                                        class="w-full block text-center bg-[#FF6700] text-white text-sm font-bold py-2 rounded-lg hover:bg-red-800 transition">
                                        Lanjutkan Bayar
                                    </a>
                                    <button onclick="confirmCancel({{ $booking->id }})"
                                        class="w-full block text-center mt-2 text-red-500 text-xs hover:text-red-700 transition">
                                        Batalkan Pemesanan
                                    </button>
                                @elseif($booking->status == 'paid')
                                    {{-- JIKA STATUS PAID --}}
                                    
                                    @if ($booking->rating)
                                        {{-- JIKA SUDAH RATING: Tombol Mati --}}
                                        <button disabled
                                            class="mb-4 w-full bg-gray-400 text-white text-sm font-bold py-2 rounded-lg cursor-not-allowed">
                                            ★ Ulasan Terkirim
                                        </button>
                                    @else
                                        {{-- JIKA BELUM RATING: Tombol Trigger Modal --}}
                                        <div x-data="{ showModal: false, rating: 0 }">

                                            <button @click="showModal = true"
                                                class="mb-4 w-full bg-yellow-400 hover:bg-yellow-500 text-white text-sm font-bold py-2 rounded-lg transition">
                                                Berikan Rating
                                            </button>

                                            {{-- MODAL --}}
                                            <div x-show="showModal" style="display: none;"
                                                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm"
                                                x-transition.opacity>

                                                <div class="bg-white rounded-xl shadow-2xl p-6 w-full max-w-md mx-4 relative">
                                                    
                                                    <div class="flex justify-between items-center mb-4">
                                                        <h3 class="text-xl font-bold text-gray-800">Beri Penilaian</h3>
                                                        <button @click="showModal = false" class="text-gray-400 hover:text-gray-600">
                                                            &times;
                                                        </button>
                                                    </div>

                                                    {{-- LOGIKA WAKTU RATING --}}
                                                    @if ($booking->end_time > now())
                                                        {{-- WARNING: WAKTU BELUM HABIS --}}
                                                        <div class="text-center py-4">
                                                            <div class="text-red-500 text-5xl mb-2">Wait! ✋</div>
                                                            <p class="text-gray-700 font-medium">Anda hanya bisa memberikan rating setelah waktu bermain selesai.</p>
                                                            <p class="text-gray-500 text-sm mt-1">Selesai pada: {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</p>
                                                            <button @click="showModal = false" class="mt-6 w-full bg-gray-200 text-gray-800 font-bold py-2 rounded-lg hover:bg-gray-300">
                                                                Tutup
                                                            </button>
                                                        </div>
                                                    @else
                                                        {{-- FORM RATING --}}
                                                        <form action="{{ route('rating.store', $booking->id) }}" method="POST">
                                                            @csrf
                                                            <div class="flex justify-center mb-4 space-x-2">
                                                                @foreach (range(1, 5) as $i)
                                                                    <label class="cursor-pointer">
                                                                        <input type="radio" name="rating" value="{{ $i }}" class="hidden" @click="rating = {{ $i }}">
                                                                        <svg class="w-10 h-10 transition-colors duration-200"
                                                                            :class="rating >= {{ $i }} ? 'text-yellow-400 fill-current' : 'text-gray-300 fill-current'"
                                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z" />
                                                                        </svg>
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                            <div class="mb-4">
                                                                <label class="block text-gray-700 text-sm font-bold mb-2">Komentar (Opsional)</label>
                                                                <textarea name="comment" rows="3" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Bagaimana pengalaman bermainmu?"></textarea>
                                                            </div>
                                                            <button type="submit" :disabled="rating === 0"
                                                                class="w-full bg-blue-600 text-white font-bold py-2 rounded-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed">
                                                                Kirim Ulasan
                                                            </button>
                                                        </form>
                                                    @endif 
                                                </div>
                                            </div>
                                        </div>
                                    @endif 
                                    {{-- Penutup IF Rating --}}

                                    <button class="mt-4 w-full bg-green-600 text-white text-sm font-bold py-2 rounded-lg cursor-not-allowed opacity-75">
                                        Pembayaran Berhasil
                                    </button>
                                @else
                                    {{-- ELSE UNTUK STATUS LAIN --}}
                                    <a href="#"
                                        class="w-full block text-center border border-gray-300 text-gray-600 text-sm font-bold py-2 rounded-lg hover:bg-gray-100 transition">
                                        Lihat Detail
                                    </a>
                                @endif
                                {{-- Penutup IF Status Booking --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Script JavaScript --}}
    <script>
        function confirmCancel(bookingId) {
            if (confirm("Apakah Anda yakin ingin membatalkan pemesanan ini?")) {
                alert("Pembatalan untuk ID " + bookingId + " sedang diproses.");
            }
        }

        @if (session('success'))
            alert("Penilaian sudah berhasil ditambahkan");
        @endif

        @if (session('error'))
            alert("{{ session('error') }}");
        @endif
    </script>
@endsection