<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\RoomController;
use App\Http\Controllers\Public\RoomBookingController;
use App\Http\Controllers\Public\ReservationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CheckInController;
use App\Http\Controllers\Admin\CheckOutController;
use App\Http\Controllers\Admin\LandingPageController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// Homepage & Info
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('rooms.show');

// Reservation & Booking
Route::get('/reservation', [RoomBookingController::class, 'index'])->name('reservation');
Route::get('/api/available-rooms', [RoomBookingController::class, 'getAvailableRooms']);
Route::get('/api/room/{id}', [RoomBookingController::class, 'getRoomDetail']);
Route::get('/review', [ReservationController::class, 'create'])->name('booking.create');
Route::post('/booking', [ReservationController::class, 'store'])->name('booking.store');

// Payment
Route::post('/payment/create', [PaymentController::class, 'create'])->name('payment.create');
Route::post('/payment/notification', [PaymentController::class, 'notification'])->name('payment.notification');
Route::get('/reservation/thank-you', [ReservationController::class, 'thankYou'])->name('reservation.thank-you');
Route::get('/reservation/pending', [ReservationController::class, 'pending'])->name('reservation.pending');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    
    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/reservations/{reservation}/status', [DashboardController::class, 'updateReservationStatus'])->name('reservations.update-status');
    Route::post('/rooms/availability', [DashboardController::class, 'updateRoomAvailability'])->name('rooms.update-availability');
    
    // Check In (Reservasi)
    Route::get('/checkin', [CheckInController::class, 'index'])->name('checkin');
    Route::post('/checkin', [CheckInController::class, 'store'])->name('checkin.store');
    Route::post('/checkin/{reservationId}/checkin', [CheckInController::class, 'checkin'])->name('checkin.process');
    Route::post('/checkin/{reservationId}/room-number', [CheckInController::class, 'updateRoomNumber'])->name('checkin.update-room');
    Route::post('/checkin/{reservationId}/delete', [CheckInController::class, 'destroy'])->name('checkin.destroy');
    Route::get('/checkin/search', [CheckInController::class, 'search'])->name('checkin.search');
    Route::get('/checkin/{roomId}/available-numbers', [CheckInController::class, 'getAvailableNumbers'])->name('checkin.available-numbers');
    
    // Check Out (Tamu Menginap)
    Route::get('/checkout', [CheckOutController::class, 'index'])->name('checkout');
    Route::post('/checkout/{reservationId}/checkout', [CheckOutController::class, 'checkout'])->name('checkout.process');
    Route::post('/checkout/{reservationId}/room-number', [CheckOutController::class, 'updateRoomNumber'])->name('checkout.update-room');
    Route::post('/checkout/{reservationId}/delete', [CheckOutController::class, 'destroy'])->name('checkout.destroy');
    Route::get('/checkout/search', [CheckOutController::class, 'search'])->name('checkout.search');
    
    // Landing Page Management (Room CRUD) - FIXED
    Route::get('/landing', [LandingPageController::class, 'index'])->name('landing');
    Route::get('/rooms/create', [LandingPageController::class, 'create'])->name('rooms.create');
    Route::post('/rooms', [LandingPageController::class, 'store'])->name('rooms.store'); // CREATE
    Route::get('/rooms/{id}/edit', [LandingPageController::class, 'edit'])->name('rooms.edit');
    Route::put('/rooms/{id}', [LandingPageController::class, 'update'])->name('rooms.update'); // UPDATE
    Route::delete('/rooms/{id}', [LandingPageController::class, 'destroy'])->name('rooms.destroy'); // DELETE
    
    // Image Management
    Route::post('/rooms/{id}/remove-image', [LandingPageController::class, 'removeImage'])->name('rooms.removeImage');
    Route::post('/rooms/image/{imageId}/delete', [LandingPageController::class, 'deleteImage'])->name('rooms.image.delete');
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});