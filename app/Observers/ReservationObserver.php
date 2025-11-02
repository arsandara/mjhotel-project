<?php

namespace App\Observers;

use App\Models\Reservation;

class ReservationObserver
{
    public function creating(Reservation $reservation)
    {
        if (!$reservation->reservation_id) {
            $lastReservation = Reservation::latest('reservation_id')->first();
            
            if (!$lastReservation) {
                $reservation->reservation_id = '#0001';
            } else {
                // Extract number dari ID terakhir (format: #0001)
                $lastNumber = (int) substr($lastReservation->reservation_id, 1); // Hapus '#' 
                $newNumber = $lastNumber + 1;
                $reservation->reservation_id = '#' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
            }
        }
    }
}