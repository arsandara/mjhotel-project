<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function create($roomBookingId)
    {
        $roomType = RoomBooking::findOrFail($roomBookingId);
        return view('public.booking-form', compact('roomType'));
    }

    public function store(StoreReservationRequest $request)
    {
        // Process booking ke reservation table
    }

    
}
