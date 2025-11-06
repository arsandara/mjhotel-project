<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\RoomController;
use App\Http\Controllers\Public\RoomBookingController;
use App\Http\Controllers\Public\ReservationController;
use App\Http\Controllers\PaymentController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('rooms.show');

// Reservation Routes
Route::get('/reservation', [RoomBookingController::class, 'index'])->name('reservation');
Route::get('/api/available-rooms', [RoomBookingController::class, 'getAvailableRooms']);
Route::get('/api/room/{id}', [RoomBookingController::class, 'getRoomDetail']);

// Booking Routes
Route::get('/review', [ReservationController::class, 'create'])->name('booking.create');
Route::post('/booking', [ReservationController::class, 'store'])->name('booking.store');

//Payment Routes
Route::post('/payment/create', [PaymentController::class, 'create'])->name('payment.create');
Route::post('/payment/notification', [PaymentController::class, 'notification'])->name('payment.notification');
Route::get('/reservation/thank-you', [ReservationController::class, 'thankYou'])->name('reservation.thank-you');
Route::get('/reservation/pending', [ReservationController::class, 'pending'])->name('reservation.pending');

// Admin Routes
Route::prefix('admin')->group(function () {
    // Akan diisi nanti
});