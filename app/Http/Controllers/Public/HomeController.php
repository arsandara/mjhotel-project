<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Room;

class HomeController extends Controller
{
    public function index()
    {
        $rooms = Room::with(['images' => function($query) {
            $query->orderBy('sort_order', 'asc'); // ← PENTING
        }])->get();
        
        return view('home', compact('rooms'));
    }
}