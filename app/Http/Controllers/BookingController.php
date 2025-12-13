<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Nampilin semua bookingan kita (history)
    public function myBookings()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with(['venue', 'court'])
            ->latest()
            ->get();

        $durations = [];
        foreach ($bookings as $i => $booking) {
            $start = \Carbon\Carbon::parse($booking->start_time);
            $end = \Carbon\Carbon::parse($booking->end_time);
            $durations[$i] = $start->diffInHours($end);
        }

        return view('bookings.index', compact('bookings', 'durations'));
    }

    public function store(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // 1. Cek apakah user sudah pernah rating booking ini
        // Asumsi: Ada relasi 'rating' di model Booking atau cek manual
        $existingRating = Rating::where('booking_id', $bookingId)->exists();

        if ($existingRating) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk pesanan ini.');
        }

        // 2. Validasi Waktu
        if ($booking->end_time > now()) {
            return back()->with('error', 'Permainan belum selesai.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        // 3. Simpan
        Rating::create([
            'booking_id' => $booking->id,
            'user_id' => Auth::id(),
            'venue_id' => $booking->venue_id, // Pastikan ini ada
            'court_id' => $booking->court_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // 4. Redirect dengan pesan Sukses
        return redirect()->route('my.bookings')->with('success', 'Ulasan berhasil dikirim! Terima kasih.');
    }
}
