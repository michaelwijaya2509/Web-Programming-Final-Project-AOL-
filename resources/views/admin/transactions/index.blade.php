@extends('layouts.admin')

@section('title', 'Daftar Transaksi')

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
                            <th class="px-6 py-4">ID Transaksi</th>
                            <th class="px-6 py-4">Booking Ref</th>
                            <th class="px-6 py-4">Metode</th>
                            <th class="px-6 py-4">Tanggal Bayar</th>
                            <th class="px-6 py-4">Jumlah</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($payments as $payment)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                {{-- ID --}}
                                <td class="px-6 py-4 text-sm text-gray-700 font-medium">
                                    #{{ $payment->id }}
                                </td>

                                {{-- Booking Ref --}}
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <span class="bg-blue-50 text-blue-600 px-2 py-1 rounded text-xs font-semibold">
                                        B-{{ $payment->booking_id }}
                                    </span>
                                </td>

                                {{-- Method --}}
                                <td class="px-6 py-4 text-sm text-gray-600 capitalize">
                                    {{ $payment->method ?? '-' }}
                                </td>

                                {{-- Date --}}
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $payment->paid_at ? $payment->paid_at->format('d M Y H:i') : '-' }}
                                </td>

                                {{-- Amount --}}
                                <td class="px-6 py-4 text-sm font-bold text-orange-500">
                                    Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                </td>

                                {{-- Status Badge --}}
                                <td class="px-6 py-4">
                                    @if ($payment->status == 'paid' || $payment->status == 'success')
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Lunas
                                        </span>
                                    @elseif($payment->status == 'pending')
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            {{ ucfirst($payment->status) }}
                                        </span>
                                    @endif
                                </td>

                                {{-- Aksi --}}
                                <td class="px-6 py-4 pl-1">
                                    <a href="{{ route('transactions.show', $payment->id) }}"
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
            @if ($payments->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                    {{ $payments->links() }}
                </div>
            @endif
        </div>
    </div>

@endsection
