<?php

namespace Database\Seeders;
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        
        Admin::truncate();
        
        Schema::enableForeignKeyConstraints();
        Admin::create([
            'admin_id' => 'ADM001',
            'admin_username' => 'hmj_admin101',
            'admin_password' => Hash::make('Hmj@41540'),
        ]);
    }
}   