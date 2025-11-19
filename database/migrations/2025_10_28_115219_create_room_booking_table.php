<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('room_booking', function (Blueprint $table) {
            $table->string('room_booking_id', 50)->primary();
            $table->string('room_booking_name', 100);
            $table->string('room_booking_type', 100);
            $table->decimal('room_booking_price', 10, 2);
            $table->string('room_booking_capacity', 50);
            $table->text('room_booking_facility');
            $table->text('room_booking_rules');
            $table->integer('room_booking_amount');
            $table->string('room_booking_number', 100);
            $table->string('room_booking_image', 255)->nullable();
            $table->enum('room_booking_status', ['Ready', 'Sold'])->default('Ready');
            $table->enum('availability_status', ['Available', 'Unavailable'])
                  ->default('Available')
                  ->comment('Status yang dikontrol manual oleh admin untuk tampil/tidak di public');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('room_booking');
    }
};