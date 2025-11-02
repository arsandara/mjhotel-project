<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    public function process($reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);
        
        // Calculate additional charges, update status
        $reservation->update(['booking_status' => 'Completed']);
        
        return redirect()->back()->with('success', 'Check-out berhasil');
    }
}
