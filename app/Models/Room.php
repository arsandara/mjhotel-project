<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    // TAMBAHKAN INI - kasih tau primary key nya room_id
    protected $primaryKey = 'room_id';
    
    // TAMBAHKAN INI - karena room_id adalah string, bukan auto increment
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'room_id',
        'room_name', 
        'room_type',
        'room_price',
        'room_capacity', 
        'room_facility',
        'room_rules',
        'room_amount'
    ];

    public function images()
    {
        return $this->hasMany(RoomImage::class, 'room_id', 'room_id');
    }
}