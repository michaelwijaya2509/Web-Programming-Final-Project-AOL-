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
        $query = Venue::query();

        // Handle Search nama lapangan / lokasi / tipe lapangan
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
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
                $request->min_price,
                $request->max_price
            ]);
        }

        $venues = $query->get();

        return view('venues.index', compact('venues'));
    }

    // detail venue
    public function show(Request $request, $id)
    {
        $venue = Venue::with(['courts', 'ratings.user', 'ratings.booking'])->findOrFail($id);

        $date = $request->input('date', now()->toDateString());

        // Prevent booking in the past
        if (Carbon::parse($date)->lt(now()->startOfDay())) {
            $date = now()->toDateString();
        }

        // Generate time slots (08:00 - 21:00, 1 hour each)
        $slots = [];
        for ($h = 8; $h < 21; $h++) {
            $startTime = sprintf('%02d:00', $h);
            $endTime = sprintf('%02d:00', $h + 1);
            $slots[] = [
                'start' => $startTime,
                'end' => $endTime,
                'display' => "$startTime - $endTime"
            ];
        }

        // Get all bookings for this date at this venue
        $bookings = Booking::whereDate('booking_date', $date)
            ->whereHas('court', function($q) use ($venue) {
                $q->where('venue_id', $venue->id);
            })
            ->get()
            ->groupBy(function($booking) {
                return Carbon::parse($booking->start_time)->format('H:i');
            });

        // Check availability for each slot
        $availableSlots = [];
        foreach ($slots as $slot) {
            $bookedCount = $bookings->get($slot['start'], collect())->count();
            $totalCourts = $venue->courts()->where('is_active', true)->count();
            
            $availableSlots[] = [
                'start' => $slot['start'],
                'end' => $slot['end'],
                'display' => $slot['display'],
                'available_courts' => $totalCourts - $bookedCount,
                'is_available' => ($totalCourts - $bookedCount) > 0
            ];
        }

        return view('venues.show', compact('venue', 'date', 'availableSlots'));
    }

    // Add to cart
    public function addToCart(Request $request)
    {
        $request->validate([
            'venue_id' => 'required|exists:venues,id',
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $venue = Venue::findOrFail($request->venue_id);
        
        // Calculate duration in hours
        $start = Carbon::parse($request->date . ' ' . $request->start_time);
        $end = Carbon::parse($request->date . ' ' . $request->end_time);
        $duration = $start->diffInHours($end);
        
        // Calculate price
        $pricePerHour = $venue->price_per_hour;
        $subtotal = $pricePerHour * $duration;
        $tax = $subtotal * 0.1;
        $total = $subtotal + $tax;

        // Add to cart session
        $cart = session()->get('booking_cart', []);
        
        $cartItem = [
            'venue_id' => $venue->id,
            'venue_name' => $venue->name,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'duration' => $duration,
            'price_per_hour' => $pricePerHour,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
        ];
        
        $cart[] = $cartItem;
        session(['booking_cart' => $cart]);

        return back()->with('success', 'Slot berhasil ditambahkan ke keranjang!');
    }

    // View cart & confirm booking
    public function viewCart()
    {
        $cart = session('booking_cart', []);
        
        if (empty($cart)) {
            return redirect()->route('venues.index')->with('error', 'Keranjang kosong!');
        }

        $grandTotal = array_sum(array_column($cart, 'total'));
        
        return view('bookings.cart', compact('cart', 'grandTotal'));
    }


    // Confirm & create bookings
    public function confirmBooking(Request $request)
    {
        $cart = session('booking_cart', []);
        
        if (empty($cart)) {
            return redirect()->route('venues.index')->with('error', 'Keranjang kosong!');
        }

        $bookingIds = [];
        
        foreach ($cart as $item) {
            // Find available court for this slot
            $venue = Venue::findOrFail($item['venue_id']);
            
            $availableCourt = Court::where('venue_id', $venue->id)
                ->where('is_active', true)
                ->whereDoesntHave('bookings', function($q) use ($item) {
                    $q->where('booking_date', $item['date'])
                      ->where('start_time', $item['date'] . ' ' . $item['start_time']);
                })
                ->first();

            if (!$availableCourt) {
                session()->forget('booking_cart');
                return back()->with('error', 'Maaf, slot tidak tersedia lagi untuk ' . $item['date'] . ' ' . $item['start_time']);
            }

            // Create booking
            $booking = Booking::create([
                'user_id' => Auth::id(),
                'venue_id' => $venue->id,
                'court_id' => $availableCourt->id,
                'booking_date' => $item['date'],
                'start_time' => $item['date'] . ' ' . $item['start_time'] . ':00',
                'end_time' => $item['date'] . ' ' . $item['end_time'] . ':00',
                'total_price' => $item['total'],
                'status' => 'pending',
            ]);

            $bookingIds[] = $booking->id;
        }

        // Clear cart
        session()->forget('booking_cart');

        // Redirect to payment with all booking IDs
        return redirect()->route('payment.show', ['bookings' => implode(',', $bookingIds)])
            ->with('success', 'Booking berhasil dibuat! Silakan lakukan pembayaran.');
    }

    // Remove item from cart
    public function removeFromCart($index)
    {
        $cart = session('booking_cart', []);
        
        if (isset($cart[$index])) {
            unset($cart[$index]);
            $cart = array_values($cart); // Re-index array
            session(['booking_cart' => $cart]);
            
            // Return JSON if request is AJAX
            if (request()->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Item removed from cart!']);
            }
            
            return back()->with('success', 'Item removed from cart!');
        }
        
        // Return JSON if request is AJAX
        if (request()->expectsJson()) {
            return response()->json(['success' => false, 'message' => 'Item not found in cart.'], 404);
        }
        
        return back()->with('error', 'Item not found in cart.');
    }
}


