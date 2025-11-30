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
        'room_number',
        'order_id',
        'payment_status',
        'payment_response',
        'paid_at',
        'payment_method',
    ];

    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
        'customer_birthdate' => 'date',
        'room_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'paid_at' => 'datetime',
        'payment_response' => 'array', // Cast JSON response
    ];

    // METHOD BARU: GENERATE ID FORMAT RSV2025XXXXXXX
    public static function generateReservationId()
    {
        $year = date('Y');
        $prefix = "RSV{$year}";

        // Cari nomor terakhir hari ini
        $last = self::where('reservation_id', 'LIKE', $prefix . '%')
                    ->orderBy('reservation_id', 'desc')
                    ->first();

        if ($last) {
            $lastNumber = (int) substr($last->reservation_id, strlen($prefix));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return $prefix . str_pad($newNumber, 7, '0', STR_PAD_LEFT);
    }

    // Relasi ke room_booking
    public function roomBooking()
    {
        return $this->belongsTo(RoomBooking::class, 'room_booking_id', 'room_booking_id');
    }

    // Database Relationships & Scopes
    public function scopePending($query)
    {
        return $query->where('booking_status', 'Pending');
    }

    public function scopeForCheckIn($query)
    {
        return $query->where('booking_status', 'Confirmed')
                    ->where('check_in', '<=', now());
    }

    // Scope untuk payment status
    public function scopePaymentPending($query)
    {
        return $query->where('payment_status', 'pending');
    }

    public function scopePaymentPaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    // Ambil nama kamar dari relasi
    public function getRoomNameAttribute()
    {
        return $this->roomBooking ? $this->roomBooking->room_booking_name : 'Unknown';
    }

    // ✅ METHOD BARU UNTUK MIDTRANS
    public function updatePaymentStatus($status, $paymentData = null)
    {
        $this->update([
            'payment_status' => $status,
            'payment_response' => $paymentData,
            'paid_at' => $status === 'paid' ? now() : null,
            'booking_status' => $status === 'paid' ? 'Confirmed' : $this->booking_status
        ]);
    }

    public function isPaid()
    {
        return $this->payment_status === 'paid';
    }

    public function isPendingPayment()
    {
        return $this->payment_status === 'pending';
    }
}