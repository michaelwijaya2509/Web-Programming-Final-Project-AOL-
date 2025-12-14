@extends('layouts.admin')

@section('title', 'Detail Transaksi #' . $payment->id)

@section('content')
    <div class="space-y-6">
        {{-- Header --}}
        <div class="mb-6 flex items-center gap-3">
            <a href="{{ route('transactions.index') }}"
                class="p-2 rounded-lg bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition">
                <i class="bi bi-arrow-left text-lg"></i>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Transaksi {{ $payment->id }}</h2>
                <p class="text-sm text-gray-500">Detail Transaksi {{ $payment->id }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Kolom Kiri: Detail Pembayaran --}}
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="border-b border-gray-100 pb-4 mb-4 flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Rincian Pembayaran</h3>
                        <p class="text-sm text-gray-500">ID Booking: {{ $payment->booking_id }}</p>
                    </div>
                    {{-- Status Badge --}}
                    @if ($payment->status == 'paid' || $payment->status == 'success')
                        <span
                            class="px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-bold uppercase tracking-wide">Lunas</span>
                    @elseif($payment->status == 'pending')
                        <span
                            class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-bold uppercase tracking-wide">Pending</span>
                    @else
                        <span
                            class="px-3 py-1 rounded-full bg-red-100 text-red-800 text-xs font-bold uppercase tracking-wide">{{ $payment->status }}</span>
                    @endif
                </div>

                <div class="grid grid-cols-2 gap-y-6 gap-x-4">
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-semibold">Total Bayar</p>
                        <p class="text-2xl font-bold text-orange-500 mt-1">
                            Rp {{ number_format($payment->amount, 0, ',', '.') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-semibold">Metode Pembayaran</p>
                        <p class="text-gray-800 font-medium mt-1 capitalize">{{ $payment->method ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-semibold">Tanggal Transaksi</p>
                        <p class="text-gray-800 mt-1">
                            {{ $payment->paid_at ? $payment->paid_at->format('d M Y, H:i') : '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-semibold">Terakhir Diupdate</p>
                        <p class="text-gray-800 mt-1">
                            {{ $payment->updated_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Informasi Terkait (Booking & User) --}}
            <div class="space-y-6">

                {{-- Info Customer --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h4 class="text-sm font-bold text-gray-800 mb-4 border-b border-gray-100 pb-2">Informasi Pemesan</h4>
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold">
                            {{ substr($payment->booking->user->name ?? 'G', 0, 1) }}
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">{{ $payment->booking->user->name ?? 'Guest' }}
                            </p>
                            <p class="text-xs text-gray-500">{{ $payment->booking->user->email ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Info Venue --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h4 class="text-sm font-bold text-gray-800 mb-4 border-b border-gray-100 pb-2">Detail Venue</h4>
                    @if ($payment->booking)
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs text-gray-500">Venue</p>
                                <p class="text-sm font-medium text-gray-800">
                                    {{ $payment->booking->venue->name ?? 'Venue Dihapus' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Jadwal Main</p>
                                <p class="text-sm font-medium text-gray-800">
                                    {{ \Carbon\Carbon::parse($payment->booking->date)->format('d M Y') }}
                                </p>
                                <p class="text-xs text-gray-600">
                                    {{ \Carbon\Carbon::parse($payment->booking->start_time)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($payment->booking->end_time)->format('H:i') }}
                                </p>
                            </div>
                        </div>
                    @else
                        <p class="text-sm text-red-500">Data booking tidak ditemukan.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection
