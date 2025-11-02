<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoomBookingController extends Controller
{
    public function index()
    {
        $roomTypes = RoomBooking::all(); // Pilihan tipe kamar dari room_booking
        return view('public.reservation', compact('roomTypes'));
    }
}
