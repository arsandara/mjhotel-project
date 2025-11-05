<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\RoomBooking;
use Illuminate\Http\Request;

class RoomBookingController extends Controller
{
    public function index()
    {
        $rooms = RoomBooking::where('room_booking_status', 'Ready')->get();
        
        return view('reservation', compact('rooms'));
    }

    public function getAvailableRooms(Request $request)
    {
        $rooms = RoomBooking::where('room_booking_status', 'Ready')->get();
        
        return response()->json([
            'rooms' => $rooms
        ]);
    }

    public function getRoomDetail($id)
    {
        $room = RoomBooking::findOrFail($id);
        return response()->json($room);
    }
}