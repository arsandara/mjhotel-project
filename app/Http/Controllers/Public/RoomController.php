<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function show($id)
    {
        // PASTIKAN load relationship images
        $room = Room::with('images')->findOrFail($id);
        return view('public.room-detail', compact('room'));
    }
}