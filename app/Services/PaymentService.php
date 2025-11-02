<?php

namespace App\Services;

use App\Models\Reservation;

class PaymentService
{
    public function createTransaction(Reservation $reservation)
    {
        // Structure data untuk Midtrans
        return [
            'transaction_details' => [
                'order_id' => $reservation->reservation_id, // #0001
                'gross_amount' => $reservation->total_price,
            ],
            'customer_details' => [
                'first_name' => $reservation->customer_name,
                'email' => $reservation->customer_email,
                'phone' => $reservation->customer_phone,
            ],
            'item_details' => [
                [
                    'id' => $reservation->room_booking_id,
                    'price' => $reservation->room_price,
                    'quantity' => $reservation->duration,
                    'name' => 'Kamar ' . $reservation->roomBooking->room_booking_name,
                ]
            ]
        ];
    }

    public function handlePaymentNotification($notification)
    {
        // Logic handle callback dari Midtrans
        // Update status reservation berdasarkan payment status
    }
}