<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    // Menampilkan halaman rating dari bookingan yang sudah dibuat
    public function create($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // Biar user nggak bisa ngehack URL booking orang lain
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }
        
        // memastikan bahwa rating hanya bisa dilakukan setelah jam sewa lapangan selesai (end_time < now)
        if ($booking->end_time > now()) {
            return redirect('/my-bookings')
                ->with('error', 'Anda hanya bisa memberikan rating setelah waktu bermain selesai.');
        }
        
        return view('ratings.create', compact('booking'));
    }

    // menyimpan hasil rating ke database
    public function store(Request $request, $bookingId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $booking = Booking::findOrFail($bookingId);

        Rating::create([
            'booking_id' => $booking->id,
            'user_id'    => Auth::id(),
            'court_id'   => $booking->court_id,
            'rating'     => $request->rating,
            'comment'    => $request->comment
        ]);
        
        return redirect('/my-bookings');
    }
}