<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use Illuminate\Support\Carbon;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data existing dulu
        Reservation::truncate();

        Reservation::create([
            'reservation_id' => '#0001',
            'room_booking_id' => 'room_booking_3',
            'customer_name' => 'Morgan Vero',
            'customer_birthdate' => '2003-04-15',
            'customer_email' => 'hidupjokowi@gmail.com',
            'customer_phone' => '081234567890',
            'special_request' => 'Mohon disiapkan handuk tambahan dan kamar di dekat jendela.',
            'check_in' => Carbon::create(2026, 1, 15, 14, 0, 0),
            'check_out' => Carbon::create(2026, 1, 18, 12, 0, 0),
            'duration' => 3,
            'capacity' => 2, 
            'room_price' => 345000.00,
            'total_price' => 1035000.00,
            'booking_status' => 'Confirmed',
            'room_number' => '128',
        ]);
    }
}