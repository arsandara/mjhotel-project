<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Room;

class HomeController extends Controller
{
    public function index()
    {
        $rooms = Room::with('images')->get();
        return view('home', compact('rooms'));
    }
}