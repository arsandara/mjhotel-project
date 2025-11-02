<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // Ambil data facilities dari database
        $facilities = Facility::orderBy('facility_name')->get();
        
        // Data untuk view
        $data = [
            'title' => 'Tentang Kami - Hotel Mukti Jaya',
            'facilities' => $facilities
        ];

        return view('about', $data);
    }
}