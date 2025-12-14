@extends('layouts.admin')

@section('title', 'Daftar Booking')

@section('content')

    <div class="space-y-6">
        {{-- Header Section --}}
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Manajemen Transaksi</h2>
                <p class="text-gray-500 mt-1">Pantau seluruh riwayat pembayaran masuk.</p>
            </div>
            {{-- Tombol Export (Opsional, hanya visual pelengkap) --}}
        </div>

        {{-- Table Section --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-gray-50 border-b border-gray-100 text-xs uppercase text-gray-500 font-semibold tracking-wider">
                            <th class="px-6 py-4">ID Booking</th>
                            <th class="px-6 py-4">Nama Customer</th>
                            <th class="px-6 py-4">Tanggal Main</th>
                            <th class="px-6 py-4">Jumlah</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($bookings as $booking)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 text-sm text-gray-700 font-medium">
                                    #{{ $booking->id }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <span class="bg-blue-50 text-blue-600 px-2 py-1 rounded text-xs font-semibold">
                                        {{ $booking->user->name ?? 'Guest' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600 capitalize">
                                    {{ $booking->booking_date->format('d F Y') }}
                                </td>
                                {{-- Amount --}}
                                <td class="px-6 py-4 text-sm font-bold text-orange-500">
                                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                </td>

                                {{-- Status Badge --}}
                                <td class="px-6 py-4">
                                    @if ($booking->status == 'paid' || $booking->status == 'success')
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Lunas
                                        </span>
                                    @elseif($booking->status == 'pending')
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    @endif
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-4 pl-1">
                                    <a href="{{ route('bookings.show', $booking->id) }}"
                                        class="text-gray-500 hover:text-orange-500 font-medium text-sm border border-gray-200 hover:border-orange-500 px-3 py-1 rounded transition">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                                    Belum ada data transaksi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination Footer --}}
            @if ($bookings->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $bookings->links() }}
                </div>
            @endif
        </div>
    </div>

@endsection
