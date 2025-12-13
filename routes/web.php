<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\venueController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScoreboardController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VenueController as AdminVenueController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;

// Public
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/venue', [venueController::class, 'index'])->name('venues.index');
Route::get('/venue/{id}', [venueController::class, 'show'])->name('venues.show');
Route::get('/scoreboard', [ScoreboardController::class, 'index']);
Route::post('/scoreboard/add-player', [ScoreboardController::class, 'addPlayer']);

Route::get('/scoreboard/setup', [ScoreboardController::class, 'setupGame']);
Route::post('/scoreboard/setup', [ScoreboardController::class, 'saveSetup']);

Route::get('/scoreboard/match', [ScoreboardController::class, 'match']);
Route::post('/scoreboard/point', [ScoreboardController::class, 'addPoint']);
Route::post('/scoreboard/finish-match', [ScoreboardController::class, 'finishMatch']);

Route::get('/scoreboard/leaderboard', [ScoreboardController::class, 'leaderboard']);
Route::post('/scoreboard/reset', [ScoreboardController::class, 'reset']);

// Di routes/web.php, tambahkan route ini
Route::post('/cart/sync', function(Request $request) {
    $clientCart = $request->input('cart', []);
    $serverCart = session('cart', []);
    
    // Merge client cart with server cart
    $mergedCart = array_merge($serverCart, $clientCart);
    
    // Remove duplicates by checking unique identifier (venue_id + date + time)
    $uniqueCart = [];
    foreach ($mergedCart as $item) {
        $key = $item['venue_id'] . '_' . $item['date'] . '_' . $item['start_time'];
        if (!isset($uniqueCart[$key])) {
            $uniqueCart[$key] = $item;
        }
    }
    
    // Save to session
    session(['cart' => array_values($uniqueCart)]);
    
    return response()->json([
        'success' => true,
        'updatedCart' => array_values($uniqueCart)
    ]);
})->name('cart.sync');

Route::post('/cart/save-to-session', function(Request $request) {
    $cart = $request->input('cart', []);
    session(['cart' => $cart]);
    
    return response()->json(['success' => true]);
})->name('cart.saveToSession');

// API endpoint untuk get cart data
Route::get('/api/cart/data', function(Request $request) {
    $cart = session('booking_cart', []);
    return response()->json([
        'success' => true,
        'cart' => $cart,
        'count' => count($cart)
    ]);
})->middleware('auth')->name('api.cart.data');

// User (auth)
Route::middleware(['auth', 'is_user'])->group(function () {
    Route::post('/booking/add-to-cart', [venueController::class, 'addToCart'])->name('booking.addToCart');
    Route::get('/booking/cart', [venueController::class, 'viewCart'])->name('booking.cart');
    Route::delete('/booking/cart/{index}', [venueController::class, 'removeFromCart'])->name('booking.removeFromCart');
    Route::post('/booking/confirm', [venueController::class, 'confirmBooking'])->name('booking.confirm');
    
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('my.bookings');
    Route::get('/payment/{bookings}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/{bookings}', [PaymentController::class, 'pay'])->name('payment.pay');

    Route::get('/rating/{booking}', [RatingController::class, 'create'])->name('rating.create');
    Route::post('/rating/{booking}', [RatingController::class, 'store'])->name('rating.store');
    Route::post('/venue/{venue}/rating', [RatingController::class, 'storeFromVenue'])->name('rating.storeFromVenue');
});

// Admin
Route::prefix('admin')->middleware(['auth','is_admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Venue & Court Management
    Route::resource('/admin-venue', AdminVenueController::class);
    
    // Route Khusus untuk Manage Court di dalam halaman Edit Venue
    Route::post('/venues/{venue}/courts', [AdminVenueController::class, 'storeCourt'])->name('venues.courts.store');
    Route::delete('/courts/{court}', [AdminVenueController::class, 'destroyCourt'])->name('venues.courts.destroy');
    Route::patch('/courts/{court}/toggle', [AdminVenueController::class, 'toggleCourtStatus'])->name('venues.courts.toggle');

    // Transactions
    Route::get('/transactions', [AdminTransactionController::class, 'index'])->name('transactions.index');
});

Route::get('/', [HomeController::class, 'index'])
    ->middleware(['auth', 'is_user'])
    ->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
