<?php

use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\CourtController as AdminCourtController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScoreboardController;
use App\Http\Controllers\venueController;

// Public
Route::get('/', [HomeController::class, 'index']);
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


// User (auth)
Route::middleware('auth')->group(function () {
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
    Route::get('/', [DashboardController::class, 'index']);

    Route::resource('courts', AdminCourtController::class);

    Route::get('/bookings', [AdminBookingController::class, 'index']);
    Route::post('/bookings/{id}/approve', [AdminBookingController::class, 'approve']);
    Route::post('/bookings/{id}/reject', [AdminBookingController::class, 'reject']);

    Route::get('/transactions', [TransactionController::class, 'index']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
