<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\RoomBooking;
use Illuminate\Http\Request;

class CheckOutController extends Controller
{
    public function index()
    {
        // HANYA tampilkan tamu yang sedang menginap (status Checked In)
        $guests = Reservation::with('roomBooking')
            ->where('booking_status', 'Checked In')
            ->orderBy('check_in', 'asc')
            ->get();

        return view('admin.checkout', compact('guests'));
    }

    public function updateRoomNumber(Request $request, $reservationId)
    {
        try {
            $validated = $request->validate([
                'room_number' => 'required|string|max:50'
            ]);

            // PERBAIKAN: Cari berdasarkan reservation_id (bukan primary key)
            $reservation = Reservation::where('reservation_id', $reservationId)->firstOrFail();
            
            if ($reservation->booking_status !== 'Checked In') {
                return response()->json([
                    'success' => false,
                    'message' => 'Hanya tamu yang sedang menginap yang bisa edit nomor kamar'
                ], 422);
            }

            $existingReservation = Reservation::where('room_number', $validated['room_number'])
                ->where('room_booking_id', $reservation->room_booking_id)
                ->whereIn('booking_status', ['Confirmed', 'Checked In'])
                ->where('reservation_id', '!=', $reservationId)
                ->first();

            if ($existingReservation) {
                return response()->json([
                    'success' => false,
                    'message' => 'Nomor kamar ' . $validated['room_number'] . ' sudah dipakai'
                ], 422);
            }

            $reservation->update(['room_number' => $validated['room_number']]);

            return response()->json([
                'success' => true,
                'message' => 'Nomor kamar berhasil diupdate'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate nomor kamar: ' . $e->getMessage()
            ], 422);
        }
    }

    public function destroy($reservationId)
    {
        try {
            // PERBAIKAN: Cari berdasarkan reservation_id (bukan primary key)
            $reservation = Reservation::where('reservation_id', $reservationId)->firstOrFail();
            
            if ($reservation->booking_status !== 'Checked In') {
                return response()->json([
                    'success' => false,
                    'message' => 'Hanya tamu yang sedang menginap yang bisa dihapus'
                ], 422);
            }

            $reservation->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data tamu berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data tamu: ' . $e->getMessage()
            ], 422);
        }
    }

    public function checkout($reservationId)
    {
        try {
            \Log::info('Checkout attempt for reservation: ' . $reservationId);
            
            // PERBAIKAN: Cari berdasarkan reservation_id (bukan primary key)
            $reservation = Reservation::where('reservation_id', $reservationId)->firstOrFail();
            
            // Validasi: hanya tamu yang sudah check-in yang bisa check-out
            if ($reservation->booking_status !== 'Checked In') {
                return response()->json([
                    'success' => false,
                    'message' => 'Hanya tamu yang sudah check-in yang bisa check-out'
                ], 422);
            }
            
            // Update status reservasi menjadi Checked Out
            $reservation->update([
                'booking_status' => 'Checked Out',
                'checked_out_at' => now() // tambahkan timestamp check-out
            ]);
            \Log::info('Checkout successful for reservation: ' . $reservationId);

            return response()->json([
                'success' => true,
                'message' => 'Tamu berhasil check-out'
            ]);

        } catch (\Exception $e) {
            \Log::error('Checkout failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal check-out: ' . $e->getMessage()
            ], 422);
        }
    }

    public function search(Request $request)
    {
        $query = $request->get('q', '');

        // Hanya search di tamu yang Checked In
        $guests = Reservation::with('roomBooking')
            ->where('booking_status', 'Checked In')
            ->where(function($q) use ($query) {
                $q->where('customer_name', 'like', "%{$query}%")
                  ->orWhere('customer_email', 'like', "%{$query}%")
                  ->orWhere('room_number', 'like', "%{$query}%")
                  ->orWhereHas('roomBooking', function($roomQuery) use ($query) {
                      $roomQuery->where('room_booking_name', 'like', "%{$query}%");
                  });
            })
            ->orderBy('check_in', 'asc')
            ->get();

        return response()->json($guests);
    }
}