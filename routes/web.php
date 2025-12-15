<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScoreboardController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\VenueController as AdminVenueController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;

// Public
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/venue', [VenueController::class, 'index'])->name('venues.index');
Route::get('/venue/{id}', [VenueController::class, 'show'])->name('venues.show');
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
Route::post('/cart/sync', function (Request $request) {
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

Route::post('/cart/save-to-session', function (Request $request) {
    $cart = $request->input('cart', []);
    session(['cart' => $cart]);

    return response()->json(['success' => true]);
})->name('cart.saveToSession');

// API endpoint untuk get cart data
Route::get('/api/cart/data', function (Request $request) {
    $cart = session('booking_cart', []);
    return response()->json([
        'success' => true,
        'cart' => $cart,
        'count' => count($cart)
    ]);
})->middleware('auth')->name('api.cart.data');

// User (auth)
Route::middleware(['auth', 'is_user'])->group(function () {
    Route::post('/booking/add-to-cart', [VenueController::class, 'addToCart'])->name('booking.addToCart');
    Route::get('/booking/cart', [VenueController::class, 'viewCart'])->name('booking.cart');
    Route::delete('/booking/cart/{index}', [VenueController::class, 'removeFromCart'])->name('booking.removeFromCart');
    Route::post('/booking/confirm', [VenueController::class, 'confirmBooking'])->name('booking.confirm');
    Route::post('/booking/create-single/{index}', [VenueController::class, 'createSingleBooking'])->name('booking.createSingle');
    Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');

    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('my.bookings');
    Route::get('/payment/{bookings}', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/{bookings}', [PaymentController::class, 'pay'])->name('payment.pay');

    Route::post('/rating/{booking}', [BookingController::class, 'store'])->name('rating.store');
    Route::post('/venue/{venue}/rating', [RatingController::class, 'storeFromVenue'])->name('rating.storeFromVenue');
});

// Admin
Route::prefix('admin')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Venue & Court Management
    Route::resource('/venue', AdminVenueController::class);

    // Route Khusus untuk Manage Court di dalam halaman Edit Venue
    Route::post('/venues/{venue}/courts', [AdminVenueController::class, 'storeCourt'])->name('venues.courts.store');
    Route::delete('/courts/{court}', [AdminVenueController::class, 'destroyCourt'])->name('venues.courts.destroy');
    Route::patch('/courts/{court}/toggle', [AdminVenueController::class, 'toggleCourtStatus'])->name('venues.courts.toggle');

    // Bookings
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{id}', [AdminBookingController::class, 'show'])->name('bookings.show');
    Route::post('/bookings/{id}/approve', [AdminBookingController::class, 'approve'])->name('bookings.approve');
    Route::post('/bookings/{id}/reject', [AdminBookingController::class, 'reject'])->name('bookings.reject');

    // Transactions
    Route::get('/transactions', [AdminTransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{payment}', [AdminTransactionController::class, 'show'])->name('transactions.show');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');
});


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

//     Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
Route::middleware('auth')->group(function () {
    // Profile routes (using Breeze structure)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    // Edit profile (using existing Breeze form)
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // New routes for separate pages
    Route::get('/profile/password', [ProfileController::class, 'password'])->name('password.edit');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::get('/profile/delete', [ProfileController::class, 'delete'])->name('profile.delete');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
