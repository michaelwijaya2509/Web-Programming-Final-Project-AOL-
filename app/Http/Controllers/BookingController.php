<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Court;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // // Nanti akan nampilin form booking ke user
    // public function create($court_id){
    //     $court = Court::findOrFail($court_id);
    //     return view('bookings.create', compact('court'));
    // }

    // // store ke database
    // public function store(Request $request){
    //     $request->validate([
    //         'court_id' => 'required',
    //         'booking_date' => 'required|date',
    //         'start_time' => 'required',
    //         'duration' => 'required|integer|min:1',
    //     ]);

    //     $court = Court::findOrFail($request->court_id);

    //     $endTime = date('H:i:s', strtotime($request->start_time . " +{$request->duration} hours"));

    //     $totalPrice = $court->price_per_hour * $request->duration;

    //     $booking = Booking::create([
    //         'user_id'      => Auth::id(),
    //         'court_id'     => $court->id,
    //         'booking_date' => $request->booking_date,
    //         'start_time'   => $request->start_time,
    //         'end_time'     => $endTime,
    //         'total_price'  => $totalPrice,
    //         'status'       => 'pending'
    //     ]);

    //     return redirect("/payment/{$booking->id}");
    // }

    // Nampilin semua bookingan kita (history)
    public function myBookings(){
        $bookings = Booking::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('bookings.index', compact('bookings'));
    }
}
