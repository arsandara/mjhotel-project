<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservation';
    protected $primaryKey = 'reservation_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'reservation_id',
        'customer_name',
        'customer_birthdate',
        'customer_email',
        'customer_phone',
        'special_request',
        'check_in',
        'check_out',
        'duration',
        'capacity',
        'room_price',
        'total_price',
        'booking_status',
        'room_booking_id',
    ];

    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
        'customer_birthdate' => 'date',
        'room_price' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    // Relasi ke room_booking
    public function roomBooking()
    {
        return $this->belongsTo(RoomBooking::class, 'room_booking_id', 'room_booking_id');
    }
}