<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';
    protected $primaryKey = 'room_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'room_id',
        'room_name',
        'room_price',
        'room_capacity', 
        'room_facility',
        'room_rules',
        'room_amount',
        'room_image',
    ];

    protected $casts = [
        'room_price' => 'decimal:2',
    ];
}