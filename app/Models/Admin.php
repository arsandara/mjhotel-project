<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admin';
    protected $primaryKey = 'admin_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'admin_id',
        'admin_username',
        'admin_password',
    ];

    protected $hidden = [
        'admin_password',
    ];
}