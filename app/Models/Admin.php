<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'admin';

    // Tentukan nama tabel
    protected $table = 'admin';

    // Primary key custom
    protected $primaryKey = 'admin_id';

    // Tipe primary key
    protected $keyType = 'string';

    // Non-incrementing primary key
    public $incrementing = false;

    // Kolom yang bisa diisi
    protected $fillable = [
        'admin_id',
        'admin_username', 
        'admin_password',
        'admin_name',
        'admin_email',
    ];

    // Kolom yang disembunyikan
    protected $hidden = [
        'admin_password',
    ];

    // Timestamps - DISABLE karena tabel admin tidak punya created_at/updated_at
    public $timestamps = false;

    // Override method untuk password
    public function getAuthPassword()
    {
        return $this->admin_password;
    }

    // Override method untuk identifier name
    public function getAuthIdentifierName()
    {
        return 'admin_username';
    }

    // Override method untuk identifier
    public function getAuthIdentifier()
    {
        return $this->admin_username;
    }
}