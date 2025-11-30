<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;

class CleanupExpiredPendingReservations extends Command
{
    protected $signature = 'reservations:cleanup-expired';
    protected $description = 'Otomatis batalkan reservasi Pending yang sudah lebih dari 24 jam';

    public function handle()
    {
        $count = Reservation::where('booking_status', 'Pending')
            ->where('created_at', '<=', now()->subHours(24))
            ->update([
                'booking_status'      => 'Cancelled',
                'cancellation_reason' => 'Otomatis dibatalkan: Belum dibayar dalam 24 jam',
                'cancelled_at'        => now()
            ]);

        if ($count > 0) {
            \Log::info("AUTO-CANCEL: {$count} reservasi Pending dibatalkan otomatis karena >24 jam");
            $this->info("Berhasil membatalkan {$count} reservasi Pending.");
        } else {
            $this->info('Tidak ada reservasi Pending yang kadaluarsa.');
        }

        return 0;
    }
}