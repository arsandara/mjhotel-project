<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\RoomController;
use App\Http\Controllers\Public\RoomBookingController;
use App\Http\Controllers\Public\ReservationController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('rooms.show');
Route::get('/booking/{roomBooking}', [ReservationController::class, 'create'])->name('booking.create');
Route::post('/booking', [ReservationController::class, 'store'])->name('booking.store');
Route::get('/reservation', [RoomBookingController::class, 'index'])->name('reservation');
Route::get('/api/available-rooms', [RoomBookingController::class, 'getAvailableRooms']);
Route::get('/api/room/{id}', [RoomBookingController::class, 'getRoomDetail']);

// Admin Routes (sementara kosong, nanti diisi)
Route::prefix('admin')->group(function () {
    // Akan diisi nanti

    
});