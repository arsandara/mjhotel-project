<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'admin_id' => 'ADM001',
            'admin_username' => 'muktijaya_admin1',
            'admin_password' => Hash::make('hotelnyaman1'),
        ]);
    }
}   