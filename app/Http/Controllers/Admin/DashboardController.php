<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Court;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBookings = Booking::count();
        $activeCourts  = Court::where('is_active', true)->count();

        return view('admin.dashboard', compact('totalBookings', 'activeCourts'));
    }
}
