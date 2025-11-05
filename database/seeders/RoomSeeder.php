<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Room;
use App\Models\RoomImage;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        // Hapus data existing
        RoomImage::truncate();
        Room::truncate();
        
        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $rooms = [
            [
                'room_id' => 'room_1',
                'room_name' => 'Suite Double Bed (Lantai 1)',
                'room_type' => 'Suite Room',
                'room_price' => 345000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 4 Botol, Set Meal, Microwave, Ketel Listrik, Smart TV (Netflix Tersedia), Kulkas, Sofa, Hairdryer, Toiletries, Shower Air Panas Dingin, Bathub, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 2,
            ],
            [
                'room_id' => 'room_2',
                'room_name' => 'Suite Double Bed (Lantai 3)',
                'room_type' => 'Suite Room',
                'room_price' => 345000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 4 Botol, Set Meal, Microwave, Ketel Listrik, Smart TV (Netflix Tersedia), Kulkas, Sofa, Hairdryer, Toiletries, Shower Air Panas Dingin, Bathub, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 2,
            ],
            [
                'room_id' => 'room_3',
                'room_name' => 'Suite Twin Bed (Lantai 2)',
                'room_type' => 'Suite Room',
                'room_price' => 345000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 4 Botol, Set Meal, Microwave, Ketel Listrik, Smart TV (Netflix Tersedia), Kulkas, Sofa, Hairdryer, Toiletries, Shower Air Panas Dingin, Bathub, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 2,
            ],
            [
                'room_id' => 'room_4',
                'room_name' => 'Suite Twin Bed (Lantai 3)',
                'room_type' => 'Suite Room',
                'room_price' => 345000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 4 Botol, Set Meal, Microwave, Ketel Listrik, Smart TV (Netflix Tersedia), Kulkas, Sofa, Hairdryer, Toiletries, Shower Air Panas Dingin, Bathub, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 2,
            ],
            [
                'room_id' => 'room_5',
                'room_name' => 'Deluxe Double Bed (Lantai 1)',
                'room_type' => 'Deluxe Room',
                'room_price' => 295000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 4 Botol, Set Meal, Ketel Listrik, Smart TV, Kulkas, Sofa, Toiletries, Shower Air Panas Dingin, Bathub, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 4,
            ],
            [
                'room_id' => 'room_6',
                'room_name' => 'Deluxe Double Bed (Lantai 2)',
                'room_type' => 'Deluxe Room',
                'room_price' => 295000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 4 Botol, Set Meal, Ketel Listrik, Smart TV, Kulkas, Sofa, Toiletries, Shower Air Panas Dingin, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 4,
            ],
            [
                'room_id' => 'room_7',
                'room_name' => 'Deluxe Double Bed (Lantai 3)',
                'room_type' => 'Deluxe Room',
                'room_price' => 295000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 4 Botol, Set Meal, Ketel Listrik, Smart TV, Kulkas, Sofa, Toiletries, Shower Air Panas Dingin, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 4,
            ],
            [
                'room_id' => 'room_8',
                'room_name' => 'Deluxe Double Bed (Lantai 4)',
                'room_type' => 'Deluxe Room',
                'room_price' => 295000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 4 Botol, Set Meal, Ketel Listrik, Smart TV, Kulkas, Sofa, Hairdryer, Toiletries, Shower Air Panas Dingin, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 4,
            ],
            [
                'room_id' => 'room_9',
                'room_name' => 'Deluxe Twin Bed (Lantai 2)',
                'room_type' => 'Deluxe Room',
                'room_price' => 295000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 4 Botol, Set Meal, Ketel Listrik, Smart TV, Kulkas, Sofa, Toiletries, Shower Air Panas Dingin, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 4,
            ],
            [
                'room_id' => 'room_10',
                'room_name' => 'Deluxe Twin Bed (Lantai 3)',
                'room_type' => 'Deluxe Room',
                'room_price' => 295000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 4 Botol, Set Meal, Ketel Listrik, Smart TV, Kulkas, Sofa, Toiletries, Shower Air Panas Dingin, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 4,
            ],
            [
                'room_id' => 'room_11',
                'room_name' => 'Deluxe Twin Bed (Lantai 4)',
                'room_type' => 'Deluxe Room',
                'room_price' => 295000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 4 Botol, Set Meal, Ketel Listrik, Smart TV, Kulkas, Sofa, Hairdryer, Toiletries, Shower Air Panas Dingin, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 4,
            ],
            [
                'room_id' => 'room_12',
                'room_name' => 'Superior Double Bed (Dengan Bathub)',
                'room_type' => 'Superior Room',
                'room_price' => 245000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 2 Botol, Set Meal, Smart TV, Sofa, Toiletries, Shower Air Panas Dingin, Kamar Lebih Kecil, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 2,
            ],
            [
                'room_id' => 'room_13',
                'room_name' => 'Superior Double Bed (Tanpa Bathub)',
                'room_type' => 'Superior Room',
                'room_price' => 245000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 2 Botol, Set Meal, Smart TV, Sofa, Toiletries, Shower Air Panas Dingin, Kamar Lebih Besar, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 2,
            ],
            [
                'room_id' => 'room_14',
                'room_name' => 'Superior Twin Bed (Lantai 2)',
                'room_type' => 'Superior Room',
                'room_price' => 245000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 2 Botol, Set Meal, Smart TV, Sofa, Toiletries, Shower Air Panas Dingin, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 2,
            ],
            [
                'room_id' => 'room_15',
                'room_name' => 'Standard Double Bed (Lantai 1)',
                'room_type' => 'Standard Room',
                'room_price' => 195000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 2 Botol, Set Meal, Smart TV, Toiletries, Shower Air Panas Dingin, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 6,
            ],
            [
                'room_id' => 'room_16',
                'room_name' => 'Standard Double Bed (Lantai 2)',
                'room_type' => 'Standard Room',
                'room_price' => 195000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 2 Botol, Set Meal, Smart TV, Toiletries, Shower Air Panas Dingin, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 6,
            ],
            [
                'room_id' => 'room_17',
                'room_name' => 'Standard Twin Bed (Lantai 1)',
                'room_type' => 'Standard Room',
                'room_price' => 195000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 2 Botol, Set Meal, Smart TV, Toiletries, Shower Air Panas Dingin, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 6,
            ],
            [
                'room_id' => 'room_18',
                'room_name' => 'Standard Twin Bed (Lantai 2)',
                'room_type' => 'Standard Room',
                'room_price' => 195000.00,
                'room_capacity' => 2,
                'room_facility' => 'AC, WiFi, Air Mineral 2 Botol, Set Meal, Smart TV, Toiletries, Shower Air Panas Dingin, Smoking Room Only.',
                'room_rules' => "Peraturan Check Out / Keluar:\nBatas Check Out: Pukul 12.00 WIB\nTambahan sewa kamar 25%: Check Out Pukul 12.00 WIB s/d 15.00 WIB\nTambahan sewa kamar 50%: Check Out Pukul 15.00 WIB s/d 18.00 WIB\nTambahan sewa kamar 100%: Check Out melebihi Pukul 18.00 WIB",
                'room_amount' => 6,
            ],
        ];

        foreach ($rooms as $roomData) {
            // Create room
            $room = Room::create($roomData);
            
            // Get images untuk room ini
            $images = $this->getRoomImages($roomData['room_name']);
            
            // Create room images
            foreach ($images as $index => $imagePath) {
                RoomImage::create([
                    'room_id' => $room->room_id,
                    'image_path' => $imagePath,
                    'sort_order' => $index
                ]);
            }
        }
    }

    private function getRoomImages($roomName)
    {
        $imageMap = [
            'Suite Double Bed (Lantai 1)' => [
                'suite-double-1.jpg',
                'suite-double-1-2.jpg',
                'suite-double-1-3.jpg',
                'suite-double-1-4.jpg', 
                'suite-double-1-5.jpg'
            ],
            'Suite Double Bed (Lantai 3)' => [
                'suite-double-3.jpg',
                'suite-double-3-2.jpg', 
                'suite-double-3-3.jpg',
                'suite-double-3-4.jpg',
                'suite-double-3-5.jpg'
            ],
            'Suite Twin Bed (Lantai 2)' => [
                'suite-twin-2.jpg',
                'suite-twin-2-2.jpg',
                'suite-twin-2-3.jpg',
                'suite-twin-2-4.jpg',
                'suite-twin-2-5.jpg'
            ],
            'Suite Twin Bed (Lantai 3)' => [
                'suite-twin-3.jpg',
                'suite-twin-3-2.jpg',
                'suite-twin-3-3.jpg',
                'suite-twin-3-4.jpg',
                'suite-twin-3-5.jpg'
            ],
            'Deluxe Double Bed (Lantai 1)' => [
                'deluxe-double-1.jpg',
                'deluxe-double-1-2.jpg',
                'deluxe-double-1-3.jpg',
            ],
            'Deluxe Double Bed (Lantai 2)' => [
                'deluxe-double-2.jpg',
                'deluxe-double-2-2.jpg',
                'deluxe-double-2-3.jpg',
                'deluxe-double-2-4.jpg',
                'deluxe-double-2-5.jpg'
            ],
            'Deluxe Double Bed (Lantai 3)' => [
                'deluxe-double-3.jpg',
                'deluxe-double-3-2.jpg',
                'deluxe-double-3-3.jpg',
                'deluxe-double-3-4.jpg',
                'deluxe-double-3-5.jpg'
            ],
            'Deluxe Double Bed (Lantai 4)' => [
                'deluxe-double-4.jpg',
                'deluxe-double-4-2.jpg',
                'deluxe-double-4-3.jpg',
                'deluxe-double-4-4.jpg',
                'deluxe-double-4-5.jpg'
            ],
            'Deluxe Twin Bed (Lantai 2)' => [
                'deluxe-twin-2.jpg',
                'deluxe-twin-2-2.jpg',
                'deluxe-twin-2-3.jpg',
                'deluxe-twin-2-4.jpg',
                'deluxe-twin-2-5.jpg'
            ],
            'Deluxe Twin Bed (Lantai 3)' => [
                'deluxe-twin-3.jpg',
                'deluxe-twin-3-2.jpg',
                'deluxe-twin-3-3.jpg',
                'deluxe-twin-3-4.jpg',
                'deluxe-twin-3-5.jpg'
            ],
            'Deluxe Twin Bed (Lantai 4)' => [
                'deluxe-twin-4.jpg',
                'deluxe-twin-4-2.jpg',
                'deluxe-twin-4-3.jpg',
                'deluxe-twin-4-4.jpg',
                'deluxe-twin-4-5.jpg'
            ],
            'Superior Double Bed (Dengan Bathub)' => [
                'superior-double-bath.jpg',
                'superior-double-bathub-2.jpg',
                'superior-double-bathub-3.jpg'
            ],
            'Superior Double Bed (Tanpa Bathub)' => [
                'superior-double-nobath.jpeg',
                'superior-double-nobathub-2.jpeg',
                'superior-double-nobathub-3.jpeg'
            ],
            'Superior Twin Bed (Lantai 2)' => [
                'superior-twin-2.jpg',
                'superior-twin-2-2.jpg',
                'superior-twin-2-3.jpg',
                'superior-twin-2-4.jpg',
                'superior-twin-2-5.jpg'
            ],
            'Standard Double Bed (Lantai 1)' => [
                'standard-double-1.jpeg',
                'standard-double-1-2.jpg',
                'standard-double-1-3.jpg',
                'standard-double-1-4.jpg',
                'standard-double-1-5.jpg'
            ],
            'Standard Double Bed (Lantai 2)' => [
                'standard-double-2.jpg',
                'standard-double-2-2.jpg',
                'standard-double-2-3.jpg',
                'standard-double-2-4.jpg',
                'standard-double-2-5.jpg'
            ],
            'Standard Twin Bed (Lantai 1)' => [
                'standard-twin-1.jpg',
                'standard-twin-1-2.jpg',
                'standard-twin-1-3.jpg',
                'standard-twin-1-4.jpg',
                'standard-twin-1-5.jpg'
            ],
            'Standard Twin Bed (Lantai 2)' => [
                'standard-twin-2.jpg',
                'standard-twin-2-2.jpeg',
                'standard-twin-2-3.jpeg',
                'standard-twin-2-4.jpeg',
                'standard-twin-2-5.jpeg'
            ],
        ];

        return $imageMap[$roomName] ?? ['default-room.jpg'];
    }
}