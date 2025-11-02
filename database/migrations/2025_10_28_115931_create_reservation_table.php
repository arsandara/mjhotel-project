<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservation', function (Blueprint $table) {
            $table->string('reservation_id', 20)->primary();
            $table->string('customer_name', 100);
            $table->date('customer_birthdate')->nullable();
            $table->string('customer_email', 100);
            $table->string('customer_phone', 20);
            $table->text('special_request')->nullable();
            $table->dateTime('check_in');
            $table->dateTime('check_out');
            $table->integer('duration')->nullable();
            $table->string('capacity', 50)->nullable();
            $table->decimal('room_price', 10, 2)->nullable();
            $table->decimal('total_price', 10, 2);
            $table->enum('booking_status', ['Pending', 'Confirmed', 'Cancelled'])->default('Pending');
            $table->string('room_booking_id', 50)->nullable();
            $table->timestamps();
            // Foreign key ke room_booking
            $table->foreign('room_booking_id')->references('room_booking_id')->on('room_booking')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservation');
    }
};