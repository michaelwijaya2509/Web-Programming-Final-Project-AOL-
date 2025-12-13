@extends('layouts.app')

@section('title', 'My Bookings')

@section('content')

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
                    class="mt-6 inline-block bg-#FF6700 text-white px-6 py-2 rounded-full font-bold hover:bg-red-800 transition shadow-md">
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
                                    <button
                                        class="w-full bg-green-600 text-white text-sm font-bold py-2 rounded-lg cursor-not-allowed opacity-75">
                                        Pembayaran Berhasil
                                    </button>
                                @else
                                    <a href="#"
                                        class="w-full block text-center border border-gray-300 text-gray-600 text-sm font-bold py-2 rounded-lg hover:bg-gray-100 transition">
                                        Lihat Detail
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Skrip sederhana untuk konfirmasi pembatalan --}}
    <script>
        function confirmCancel(bookingId) {
            if (confirm("Apakah Anda yakin ingin membatalkan pemesanan ini?")) {
                // Logika untuk mengirim form pembatalan (misal menggunakan fetch/axios atau hidden form)
                alert("Pembatalan untuk ID " + bookingId + " sedang diproses (Logic backend belum diimplementasikan).");
                // Anda bisa implementasikan form POST/DELETE di sini
            }
        }
    </script>

@endsection
