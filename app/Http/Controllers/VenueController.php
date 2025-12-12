<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Court;
use App\Models\Venue;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class venueController extends Controller
{
    
    public function index(Request $request)
    {
        //buat listing semua venue dan handling search dan filter
        $query = Venue::query()->where('is_active', true);

        // Handle Search nama lapangan / lokasi / tipe lapangan
        if($request->filled('search')){
            $query->where(function ($q) use ($request){
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%')
                  ->orWhere('type', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->type) {
            $query->where('type', $request->type);
        }

        if ($request->min_price && $request->max_price) {
            $query->whereBetween('price_per_hour', [
                $request->min_price, $request->max_price
            ]);
        }

        $venues = $query->get();

        return view('venues.index', compact('venues'));
    }

    // detail venue
    public function show(Request $request, $id)
    {
        $venue = Venue::findOrFail($id);

        $court = $venue->courts()->where('is_active', true)->get();

        $date = $request->input('date', now()->toDateString());

        // Mencegah booking di tanggal yang sudah lewat
        if (Carbon::parse($date)->lt(now()->startOfDay())) {
            return redirect()->back()->with('error', 'Tanggal tidak boleh kurang dari hari ini.');
        }

        $slots = [];
        for ($h = 8; $h < 21; $h++) {
            $start = sprintf('%02d:00:00', $h);
            $end = sprintf('%02d:00:00', $h + 1);
            $slots[] = [
                'start' => $start,
                'end'   => $end,
            ];
        }

        $bookings = Booking::where('booking_date', $date)
            ->whereNotIn('status', ['cancelled'])
            ->get()
            ->groupBy('court_id');

        $courts = $venue->courts->map(function ($court) use ($bookings, $slots, $date) {

            $courtBookings = $bookings->get($court->id, collect());

            $court->slots = collect($slots)->map(function ($slot) use ($courtBookings, $date) {

                // Cek apakah slot sudah dibook atau belum
                $isBooked = $courtBookings->contains(function ($b) use ($slot) {
                    return $b->start_time <= $slot['end']
                        && $b->end_time >= $slot['start'];
                });

                // memastikan bahwa tidak bisa booking di waktu yang sudah lewat
                $slotDateTime = Carbon::parse($date . ' ' . $slot['start']);

                $isPastTime = $slotDateTime->lt(now());

                // hasil final
                $slot['booked'] = $isBooked || $isPastTime;

                return $slot;
            });

            return $court;
        });

        return view('venues.show', compact('venue', 'courts', 'date', 'slots'));
    }

    // menambahkan slot booking ke keranjang (session)
    public function addToCart(Request $request)
    {
        $request->validate([
            'court_id' => 'required|integer',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $cart = session()->get('booking_cart', []);
        $cart[] = [
            'court_id' => $request->court_id,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ];
        session(['booking_cart' => $cart]);

        return back()->with('success', 'Slot ditambahkan ke keranjang!');
    }

    public function confirmBooking()
    {
        $cart = session('booking_cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }

        $bookingIds = [];
        foreach ($cart as $item) {
            $court = Court::findOrFail($item['court_id']);
            $booking = Booking::create([
                'user_id'      => Auth::id(),
                'venue_id'     => $court->venue_id,
                'court_id'     => $court->id,
                'booking_date' => $item['date'],
                'start_time'   => $item['start_time'],
                'end_time'     => $item['end_time'],
                'duration_hour'=> 1,
                'total_price'  => $court->price_per_hour,
                'status'       => 'pending',
            ]);
            $bookingIds[] = $booking->id;
        }

        // Kosongkan keranjang
        session()->forget('booking_cart');

        // Redirect ke halaman payment (bisa satu atau multi booking)
        return redirect()->route('payments.show', ['bookingId' => $bookingIds[0]]);
    }

}