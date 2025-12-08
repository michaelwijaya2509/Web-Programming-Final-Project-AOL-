<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function approve($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'approved']);

        return back();
    }

    public function reject($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'rejected']);

        return back();
    }
}