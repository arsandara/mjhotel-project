<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function show($id)
    {
        $room = Room::with(['images' => function($query) {
            $query->orderBy('sort_order', 'asc'); // ← INI YANG PENTING!
        }])->findOrFail($id);
        
        return view('public.room-detail', compact('room'));
    }
}