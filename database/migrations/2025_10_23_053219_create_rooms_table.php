<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->string('room_id', 20)->primary();
            $table->string('room_name', 100);
            $table->decimal('room_price', 10, 2);
            $table->string('room_capacity', 50);
            $table->text('room_facility');
            $table->text('room_rules');
            $table->integer('room_amount');
            $table->string('room_image')->default('main.jpg');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
