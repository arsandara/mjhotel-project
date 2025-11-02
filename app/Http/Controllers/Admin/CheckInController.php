<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckInController extends Controller
{
    public function process($reservationId)
    {
        $reservation = Reservation::findOrFail($reservationId);
        
        // Update status reservasi & kamar
        $reservation->update(['booking_status' => 'Checked In']);
        
        return redirect()->back()->with('success', 'Check-in berhasil');
    }
}
