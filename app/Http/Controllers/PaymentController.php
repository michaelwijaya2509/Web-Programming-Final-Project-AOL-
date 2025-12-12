<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Nampilin halaman payment
    public function show($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        return view('payments.show', compact('booking'));
    }

    // membuat pembayaran dan masukin data pembayaran ke database
    public function pay(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        $payment = Payment::create([
            'booking_id' => $booking->id,
            'amount'     => $booking->total_price,
            'method'     => $request->method,
            'status'     => 'paid',
            'paid_at'    => now()
        ]);

        $booking->update([
            'status' => 'paid'
        ]);

        return redirect('/my-bookings')->with('success', 'Payment successful!');
    }
}

