<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomBooking extends Model
{
    use HasFactory;

    protected $table = 'room_booking';
    protected $primaryKey = 'room_booking_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'room_booking_id',
        'room_booking_name',
        'room_booking_type',
        'room_booking_price',
        'room_booking_capacity',
        'room_booking_facility',
        'room_booking_rules',
        'room_booking_amount',
        'room_booking_number',
        'room_booking_image',
        'room_booking_status',
    ];

    protected $casts = [
        'room_booking_price' => 'decimal:2',
    ];
}