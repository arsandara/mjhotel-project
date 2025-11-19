<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoomBooking;
use Illuminate\Support\Facades\DB;

class RoomBookingSeeder extends Seeder
{
    public function run(): void
    {
        // NONAKTIFKAN FOREIGN KEY CHECKS
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        RoomBooking::truncate();
        
        // AKTIFKAN KEMBALI
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $roomBookings = [
            [
                'room_booking_id' => 'room_booking_1',
                'room_booking_name' => 'Suite Double Bed',
                'room_booking_type' => 'Suite Room',
                'room_booking_price' => 345000.00,
                'room_booking_capacity' => '2 orang',
                'room_booking_facility' => 'AC, WiFi, air mineral 4 botol, set meal, microwave, ketel listrik, Smart TV (Netflix tersedia), kulkas, sofa, hairdryer, toiletries, shower air panas dingin, bathub, smoking room only.',
                'room_booking_rules' => 'Peraturan Check Out / Keluar: Batas Check Out: Pukul 12.00 WIB. Tambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB. Tambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB. Tambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB.',
                'room_booking_amount' => 4,
                'room_booking_number' => '121,122,321,322',
                'room_booking_image' => 'suite-double.jpg',
                'room_booking_status' => 'Ready',
                'availability_status' => 'Available',
            ],
            [
                'room_booking_id' => 'room_booking_2',
                'room_booking_name' => 'Deluxe Double Bed', 
                'room_booking_type' => 'Deluxe Room',
                'room_booking_price' => 295000.00,
                'room_booking_capacity' => '2 orang',
                'room_booking_facility' => 'AC, WiFi, air mineral 4 botol, set meal, ketel listrik, Smart TV, kulkas, sofa, hairdryer (hanya di bagian L4), toiletries, shower air panas dingin, bathub (area L1), smoking room only.',
                'room_booking_rules' => 'Peraturan Check Out / Keluar: Batas Check Out: Pukul 12.00 WIB. Tambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB. Tambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB. Tambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB.',
                'room_booking_amount' => 16,
                'room_booking_number' => '123,124,125,126,223,224,225,226,325,326,327,328,421,422,423,424',
                'room_booking_image' => 'deluxe-double.jpg',
                'room_booking_status' => 'Ready',
                'availability_status' => 'Available',
            ],
            [
                'room_booking_id' => 'room_booking_3',
                'room_booking_name' => 'Superior Double Bed (Bathub)',
                'room_booking_type' => 'Superior Room',
                'room_booking_price' => 245000.00,
                'room_booking_capacity' => '2 orang',
                'room_booking_facility' => 'AC, WiFi, air mineral 2 botol, set meal, Smart TV, sofa, toiletries, shower air panas dingin, bathub (kamar lebih kecil), smoking room only.',
                'room_booking_rules' => 'Peraturan Check Out / Keluar: Batas Check Out: Pukul 12.00 WIB. Tambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB. Tambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB. Tambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB.',
                'room_booking_amount' => 2,
                'room_booking_number' => '128,129',
                'room_booking_image' => 'superior-double-bath.jpg',
                'room_booking_status' => 'Ready',
                'availability_status' => 'Available',
            ],
            [
                'room_booking_id' => 'room_booking_4',
                'room_booking_name' => 'Superior Double Bed (Tanpa Bathub)',
                'room_booking_type' => 'Superior Room',
                'room_booking_price' => 245000.00,
                'room_booking_capacity' => '2 orang',
                'room_booking_facility' => 'AC, WiFi, air mineral 2 botol, set meal, Smart TV, sofa, toiletries, shower air panas dingin, smoking room only.',
                'room_booking_rules' => 'Peraturan Check Out / Keluar: Batas Check Out: Pukul 12.00 WIB. Tambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB. Tambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB. Tambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB.',
                'room_booking_amount' => 2,
                'room_booking_number' => '130,131',
                'room_booking_image' => 'superior-double-nobath.jpeg',
                'room_booking_status' => 'Ready',
                'availability_status' => 'Available',
            ],
            [
                'room_booking_id' => 'room_booking_5',
                'room_booking_name' => 'Standard Double Bed',
                'room_booking_type' => 'Standard Room',
                'room_booking_price' => 195000.00,
                'room_booking_capacity' => '2 orang',
                'room_booking_facility' => 'AC, WiFi, air mineral 2 botol, set meal, Smart TV, toiletries, shower air panas dingin, smoking room only.',
                'room_booking_rules' => 'Peraturan Check Out / Keluar: Batas Check Out: Pukul 12.00 WIB. Tambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB. Tambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB. Tambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB.',
                'room_booking_amount' => 12,
                'room_booking_number' => '132,133,134,135,136,137,233,234,235,236,237,238',
                'room_booking_image' => 'standard-double.jpg',
                'room_booking_status' => 'Ready',
                'availability_status' => 'Available',
            ],
            [
                'room_booking_id' => 'room_booking_6',
                'room_booking_name' => 'Standard Twin Bed',
                'room_booking_type' => 'Standard Room',
                'room_booking_price' => 195000.00,
                'room_booking_capacity' => '2 orang',
                'room_booking_facility' => 'AC, WiFi, air mineral 2 botol, set meal, Smart TV, toiletries, shower air panas dingin, smoking room only.',
                'room_booking_rules' => 'Peraturan Check Out / Keluar: Batas Check Out: Pukul 12.00 WIB. Tambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB. Tambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB. Tambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB.',
                'room_booking_amount' => 12,
                'room_booking_number' => '138,139,140,141,142,143,239,240,241,242,243,244',
                'room_booking_image' => 'standard-twin.jpg',
                'room_booking_status' => 'Ready',
                'availability_status' => 'Available',
            ],
            [
                'room_booking_id' => 'room_booking_7',
                'room_booking_name' => 'Suite Twin Bed',
                'room_booking_type' => 'Suite Room',
                'room_booking_price' => 345000.00,
                'room_booking_capacity' => '2 orang',
                'room_booking_facility' => 'AC, WiFi, air mineral 4 botol, set meal, microwave, ketel listrik, Smart TV (Netflix tersedia), kulkas, sofa, hairdryer, toiletries, shower air panas dingin, bathub, smoking room only.',
                'room_booking_rules' => 'Peraturan Check Out / Keluar: Batas Check Out: Pukul 12.00 WIB. Tambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB. Tambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB. Tambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB.',
                'room_booking_amount' => 4,
                'room_booking_number' => '221,222,323,324',
                'room_booking_image' => 'suite-twin.jpg',
                'room_booking_status' => 'Ready',
                'availability_status' => 'Available',
            ],
            [
                'room_booking_id' => 'room_booking_8',
                'room_booking_name' => 'Deluxe Twin Bed',
                'room_booking_type' => 'Deluxe Room',
                'room_booking_price' => 295000.00,
                'room_booking_capacity' => '2 orang',
                'room_booking_facility' => 'AC, WiFi, air mineral 4 botol, set meal, ketel listrik, Smart TV, kulkas, sofa, hairdryer (hanya di bagian L4), toiletries, shower air panas dingin, bathub (area L1), smoking room only.',
                'room_booking_rules' => 'Peraturan Check Out / Keluar: Batas Check Out: Pukul 12.00 WIB. Tambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB. Tambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB. Tambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB.',
                'room_booking_amount' => 12,
                'room_booking_number' => '227,228,229,230,329,330,331,332,425,426,427,428',
                'room_booking_image' => 'deluxe-twin.jpg',
                'room_booking_status' => 'Ready',
                'availability_status' => 'Available',
            ],
            [
                'room_booking_id' => 'room_booking_9',
                'room_booking_name' => 'Superior Twin Bed',
                'room_booking_type' => 'Superior Room',
                'room_booking_price' => 245000.00,
                'room_booking_capacity' => '2 orang',
                'room_booking_facility' => 'AC, WiFi, air mineral 2 botol, set meal, Smart TV, sofa, toiletries, shower air panas dingin, smoking room only.',
                'room_booking_rules' => 'Peraturan Check Out / Keluar: Batas Check Out: Pukul 12.00 WIB. Tambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB. Tambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB. Tambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB.',
                'room_booking_amount' => 2,
                'room_booking_number' => '231,232',
                'room_booking_image' => 'superior-twin.jpg',
                'room_booking_status' => 'Ready',
                'availability_status' => 'Available',
            ],
        ];

        foreach ($roomBookings as $roomBooking) {
            RoomBooking::create($roomBooking);
        }
    }
}