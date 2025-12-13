<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Nampilin semua bookingan kita (history)
    public function myBookings(){
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
}