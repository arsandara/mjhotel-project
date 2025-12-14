<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Facility;

class FacilitySeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        
        Facility::truncate();
        
        Schema::enableForeignKeyConstraints();

        $facilities = [
            [
                'facility_id' => 'facility_1',
                'facility_name' => 'Resepsionis 24 Jam',
                'facility_image' => 'resepsionis.png',
            ],
            [
                'facility_id' => 'facility_2', 
                'facility_name' => 'Lobi',
                'facility_image' => 'lobi.png',
            ],
            [
                'facility_id' => 'facility_3',
                'facility_name' => 'Lift',
                'facility_image' => 'lift.jpeg',
            ],
            [
                'facility_id' => 'facility_4',
                'facility_name' => 'Kamar yang Nyaman',
                'facility_image' => 'kamar.png',
            ],
            [
                'facility_id' => 'facility_5',
                'facility_name' => 'Musholla',
                'facility_image' => 'musholla.jpg',
            ],
        ];

        foreach ($facilities as $facility) {
            Facility::create($facility);
        }
    }
}
