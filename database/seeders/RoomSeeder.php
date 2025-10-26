<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Room;
use Carbon\Carbon;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        Room::truncate();

        $rooms = [
            [
                'room_id' => 'room_1',
                'room_name' => 'Suite Double Bed (Lantai 1)',
                'room_price' => 345000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 4 Botol, Set Meal, Microwave, Ketel Listrik, Smart TV (Netflix Tersedia), Kulkas, Sofa, Hairdryer, Toiletries, Shower Air Panas Dingin, Bathub, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 2,
                'room_image' => 'main.jpg',
            ],
            [
                'room_id' => 'room_2',
                'room_name' => 'Suite Double Bed (Lantai 3)',
                'room_price' => 345000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 4 Botol, Set Meal, Microwave, Ketel Listrik, Smart TV (Netflix Tersedia), Kulkas, Sofa, Hairdryer, Toiletries, Shower Air Panas Dingin, Bathub, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 2,
                'room_image' => 'main.jpg',
            ],
            [
                'room_id' => 'room_3',
                'room_name' => 'Suite Twin Bed (Lantai 2)',
                'room_price' => 345000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 4 Botol, Set Meal, Microwave, Ketel Listrik, Smart TV (Netflix Tersedia), Kulkas, Sofa, Hairdryer, Toiletries, Shower Air Panas Dingin, Bathub, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 2,
                'room_image' => 'main.jpg',
            ],
            [
                'room_id' => 'room_4',
                'room_name' => 'Suite Twin Bed (Lantai 3)',
                'room_price' => 345000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 4 Botol, Set Meal, Microwave, Ketel Listrik, Smart TV (Netflix Tersedia), Kulkas, Sofa, Hairdryer, Toiletries, Shower Air Panas Dingin, Bathub, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 2,
                'room_image' => 'main.jpg',
            ],
            [
                'room_id' => 'room_5',
                'room_name' => 'Deluxe Double Bed (Lantai 1)',
                'room_price' => 295000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 4 Botol, Set Meal, Ketel Listrik, Smart TV, Kulkas, Sofa, Toiletries, Shower Air Panas Dingin, Bathub, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 4,
                'room_image' => 'main.jpg',
            ],
            [
                'room_id' => 'room_6',
                'room_name' => 'Deluxe Double Bed (Lantai 2)',
                'room_price' => 295000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 4 Botol, Set Meal, Ketel Listrik, Smart TV, Kulkas, Sofa, Toiletries, Shower Air Panas Dingin, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 4,
                'room_image' => 'main.jpg',
            ],
            [
                'room_id' => 'room_7',
                'room_name' => 'Deluxe Double Bed (Lantai 3)',
                'room_price' => 295000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 4 Botol, Set Meal, Ketel Listrik, Smart TV, Kulkas, Sofa, Toiletries, Shower Air Panas Dingin, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 4,
                'room_image' => 'main.jpg',
            ],
            [
                'room_id' => 'room_8',
                'room_name' => 'Deluxe Double Bed (Lantai 4)',
                'room_price' => 295000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 4 Botol, Set Meal, Ketel Listrik, Smart TV, Kulkas, Sofa, Hairdryer, Toiletries, Shower Air Panas Dingin, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 4,
                'room_image' => 'main.jpg',
            ],
            [
                'room_id' => 'room_9',
                'room_name' => 'Deluxe Twin Bed (Lantai 2)',
                'room_price' => 295000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 4 Botol, Set Meal, Ketel Listrik, Smart TV, Kulkas, Sofa, Toiletries, Shower Air Panas Dingin, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 4,
                'room_image' => 'main.jpg',
            ],
            [
                'room_id' => 'room_10',
                'room_name' => 'Deluxe Twin Bed (Lantai 3)',
                'room_price' => 295000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 4 Botol, Set Meal, Ketel Listrik, Smart TV, Kulkas, Sofa, Toiletries, Shower Air Panas Dingin, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 4,
                'room_image' => 'main.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'room_id' => 'room_11',
                'room_name' => 'Deluxe Twin Bed (Lantai 4)',
                'room_price' => 295000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 4 Botol, Set Meal, Ketel Listrik, Smart TV, Kulkas, Sofa, Hairdryer, Toiletries, Shower Air Panas Dingin, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 4,
                'room_image' => 'main.jpg',
            ],
            [
                'room_id' => 'room_12',
                'room_name' => 'Superior Double Bed (Dengan Bathub)',
                'room_price' => 245000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 2 Botol, Set Meal, Smart TV, Sofa, Toiletries, Shower Air Panas Dingin, Kamar Lebih Kecil, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 2,
                'room_image' => 'main.jpg',
            ],
            [
                'room_id' => 'room_13',
                'room_name' => 'Superior Double Bed (Tanpa Bathub)',
                'room_price' => 245000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 2 Botol, Set Meal, Smart TV, Sofa, Toiletries, Shower Air Panas Dingin, Kamar Lebih Besar, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 2,
                'room_image' => 'main.jpeg',
            ],
            [
                'room_id' => 'room_14',
                'room_name' => 'Superior Twin Bed (Lantai 2)',
                'room_price' => 245000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 2 Botol, Set Meal, Smart TV, Sofa, Toiletries, Shower Air Panas Dingin, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 2,
                'room_image' => 'main.jpg',
            ],
            [
                'room_id' => 'room_15',
                'room_name' => 'Standard Double Bed (Lantai 1)',
                'room_price' => 195000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 2 Botol, Set Meal, Smart TV, Toiletries, Shower Air Panas Dingin, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 6,
                'room_image' => 'main.jpg',
            ],
            [
                'room_id' => 'room_16',
                'room_name' => 'Standard Double Bed (Lantai 2)',
                'room_price' => 195000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 2 Botol, Set Meal, Smart TV, Toiletries, Shower Air Panas Dingin, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 6,
                'room_image' => 'main.jpg',
            ],
            [
                'room_id' => 'room_17',
                'room_name' => 'Standard Twin Bed (Lantai 1)',
                'room_price' => 195000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 2 Botol, Set Meal, Smart TV, Toiletries, Shower Air Panas Dingin, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 6,
                'room_image' => 'main.jpg',
            ],
            [
                'room_id' => 'room_18',
                'room_name' => 'Standard Twin Bed (Lantai 2)',
                'room_price' => 195000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 2 Botol, Set Meal, Smart TV, Toiletries, Shower Air Panas Dingin, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 6,
                'room_image' => 'main.jpeg',

            ],
        ];
         foreach ($rooms as $room) {
            Room::create($room);
         }
    }
}

