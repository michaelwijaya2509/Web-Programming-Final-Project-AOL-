@extends('layouts.admin')

@section('title', 'Detail Booking #' . $booking->id)

@section('content')

    <div class="space-y-6">
        <div class="mb-6 flex items-center gap-3">
            <a href="{{ route('bookings.index') }}"
                class="p-2 rounded-lg bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition">
                <i class="bi bi-arrow-left text-lg"></i>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Booking {{ $booking->id }}</h2>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- KOLOM KIRI: Informasi Utama --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Card 1: Status & Info Dasar --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="flex justify-between items-start mb-6 border-b border-gray-50 pb-4">
                        <div>
                            <h1 class="text-xl font-bold text-gray-800">Detail Booking</h1>
                            <p class="text-sm text-gray-400 mt-1">Dibuat pada
                                {{ $booking->created_at->format('d M Y, H:i') }}</p>
                        </div>

                        {{-- Status Badge Logic --}}
                        @php
                            $statusClass = match ($booking->status) {
                                'paid', 'approved', 'completed' => 'bg-green-100 text-green-800',
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'rejected', 'cancelled' => 'bg-red-100 text-red-800',
                                default => 'bg-gray-100 text-gray-800',
                            };
                            $statusLabel = match ($booking->status) {
                                'paid' => 'Lunas',
                                'approved' => 'Disetujui',
                                'rejected' => 'Ditolak',
                                'pending' => 'Pending',
                                default => ucfirst($booking->status),
                            };
                        @endphp
                        <span class="px-4 py-1.5 rounded-full text-sm font-bold {{ $statusClass }}">
                            {{ $statusLabel }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Info Venue --}}
                        <div>
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Venue & Lapangan</h4>
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-10 h-10 rounded-lg bg-orange-50 text-orange-500 flex items-center justify-center shrink-0">
                                    <i class="bi bi-geo-alt-fill text-lg"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800 text-lg leading-tight">
                                        {{ $booking->venue->name ?? 'Venue Dihapus' }}</p>
                                    <p class="text-gray-500 text-sm mt-1">
                                        {{ $booking->court->name ?? 'Lapangan Tidak Ditemukan' }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Info Jadwal --}}
                        <div>
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Jadwal Main</h4>
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-10 h-10 rounded-lg bg-blue-50 text-blue-500 flex items-center justify-center shrink-0">
                                    <i class="bi bi-calendar-event-fill text-lg"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800 text-lg leading-tight">
                                        {{ $booking->booking_date ? $booking->booking_date->format('d M Y') : '-' }}
                                    </p>
                                    <p class="text-gray-500 text-sm mt-1">
                                        {{ $booking->start_time ? $booking->start_time->format('H:i') : '' }} -
                                        {{ $booking->end_time ? $booking->end_time->format('H:i') : '' }}
                                        <span class="text-gray-300 mx-1">|</span>
                                        {{ number_format(\Carbon\Carbon::parse($booking->start_time)->diffInMinutes(\Carbon\Carbon::parse($booking->end_time)) / 60) }} Jam
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 2: Informasi Customer --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h4 class="text-sm font-bold text-gray-800 mb-4 pb-2 border-b border-gray-50">Informasi Penyewa</h4>
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 font-bold text-xl">
                            {{ substr($booking->user->name ?? 'G', 0, 1) }}
                        </div>
                        <div class="flex-1">
                            <h5 class="font-bold text-gray-900">{{ $booking->user->name ?? 'Guest User' }}</h5>
                            <div class="flex flex-wrap gap-x-6 gap-y-1 mt-1 text-sm text-gray-500">
                                <div class="flex items-center gap-1">
                                    <i class="bi bi-envelope"></i> {{ $booking->user->email ?? '-' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($booking->notes)
                        <div class="mt-4 bg-gray-50 p-3 rounded-lg border border-gray-100">
                            <p class="text-xs text-gray-400 font-bold uppercase mb-1">Catatan Tambahan:</p>
                            <p class="text-sm text-gray-700 italic">"{{ $booking->notes }}"</p>
                        </div>
                    @endif
                </div>

            </div>

            {{-- KOLOM KANAN: Payment & Action --}}
            <div class="space-y-6">

                {{-- Card Payment Summary --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h4 class="text-sm font-bold text-gray-800 mb-4">Rincian Pembayaran</h4>

                    <div class="space-y-3 border-b border-gray-100 pb-4 mb-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Harga Sewa</span>
                            <span class="text-gray-800 font-medium">Rp
                                {{ number_format($booking->court_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Pajak (10%)</span>
                            <span class="text-gray-800 font-medium">Rp
                                {{ number_format($booking->tax, 0, ',', '.') }}</span>
                        </div>
                        @if ($booking->service_fee > 0)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Biaya Layanan</span>
                                <span class="text-gray-800 font-medium">Rp
                                    {{ number_format($booking->service_fee, 0, ',', '.') }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="flex justify-between items-end mb-6">
                        <span class="text-sm font-bold text-gray-800">Total Tagihan</span>
                        <span class="text-2xl font-bold text-orange-600">Rp
                            {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-3 text-center">
                        <p class="text-xs text-gray-500 mb-1 uppercase tracking-wide">Metode Pembayaran</p>
                        <p class="font-bold text-gray-800 uppercase">{{ $booking->method ?? 'Manual Transfer' }}</p>
                    </div>
                </div>

                {{-- Card Actions (Tombol Approve/Reject) --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h4 class="text-sm font-bold text-gray-800 mb-4">Konfirmasi Admin</h4>

                    @if ($booking->status === 'rejected' || $booking->status === 'cancelled')
                        <div class="p-4 bg-red-50 rounded-lg border border-red-100 text-center">
                            <i class="bi bi-x-circle text-red-500 text-2xl mb-2 block"></i>
                            <h5 class="text-red-800 font-bold text-sm">Booking Ditolak</h5>
                            <p class="text-xs text-red-600 mt-1">Status booking ini sudah final dan tidak dapat diubah.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-2 gap-3">
                            {{-- Tombol Reject --}}
                            @if ($booking->status !== 'rejected')
                                <form action="{{ route('bookings.reject', $booking->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menolak booking ini?');">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-lg border border-red-200 text-red-600 bg-white hover:bg-red-50 font-semibold text-sm transition shadow-sm">
                                        <i class="bi bi-x-lg"></i>
                                        Tolak
                                    </button>
                                </form>
                            @endif

                            {{-- Tombol Approve --}}
                            @if ($booking->status !== 'approved')
                                <form action="{{ route('bookings.approve', $booking->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center justify-center gap-2 py-2.5 px-4 rounded-lg bg-green-600 hover:bg-green-700 text-white font-semibold text-sm transition shadow-sm shadow-green-200">
                                        <i class="bi bi-check-lg"></i>
                                        Terima
                                    </button>
                                </form>
                            @endif
                        </div>

                        {{-- Pesan Info jika sudah diapprove --}}
                        @if ($booking->status === 'approved')
                            <p class="text-xs text-center text-green-600 mt-3">
                                <i class="bi bi-check-circle-fill mr-1"></i> Booking ini sedang berjalan / disetujui.
                            </p>
                        @endif
                    @endif
                </div>

            </div>
        </div>
    </div>

@endsection
