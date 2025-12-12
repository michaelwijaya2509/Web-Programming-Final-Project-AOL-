<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        Booking::create([
            'user_id'        => 2, // user biasa
            'venue_id'       => 1,
            'court_id'       => 1,
            'booking_date'   => now()->addDay()->toDateString(),
            'start_time'     => '12:00',
            'end_time'       => '13:00',
            'total_price'    => 50000,
            'status'         => 'pending',
        ]);
    }
}
