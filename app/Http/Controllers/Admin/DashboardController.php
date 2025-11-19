<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\RoomBooking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total semua nomor kamar dari semua tipe kamar
        $totalRooms = RoomBooking::all()->sum(function($room) {
            return count(explode(',', $room->room_booking_number));
        });

        // Ambil semua nomor kamar yang sedang terpakai (status Confirmed + Checked In)
        $occupiedRoomNumbers = Reservation::whereIn('booking_status', ['Confirmed', 'Checked In'])
            ->whereNotNull('room_number')
            ->pluck('room_number')
            ->toArray();

        // Hitung kamar yang tersedia (total - terpakai)
        $availableRooms = $totalRooms - count($occupiedRoomNumbers);

        // Total reservasi & pending
        $totalBookings = Reservation::count();
        $pendingBookings = Reservation::where('booking_status', 'Pending')->count();

        // Reservasi terbaru (10 terbaru untuk slider)
        $latestReservations = Reservation::with('roomBooking')
            ->orderBy('created_at', 'desc')
            ->limit(10) // Tambah limit untuk slider
            ->get()
            ->map(function($reservation) {
                return [
                    'reservation_id' => $reservation->reservation_id,
                    'customer_name' => $reservation->customer_name,
                    'customer_email' => $reservation->customer_email,
                    'customer_phone' => $reservation->customer_phone,
                    'room_name' => $reservation->roomBooking->room_booking_name,
                    'check_in' => $reservation->check_in,
                    'special_request' => $reservation->special_request,
                    'booking_status' => $reservation->booking_status,
                    'is_editable' => $reservation->booking_status === 'Pending' // Hanya pending yang bisa diedit
                ];
            });

        // Hitung tamu yang sedang menginap (status Checked In)
        $currentGuests = Reservation::where('booking_status', 'Checked In')->count();
        
        // Status kamar dengan DUAL STATUS (otomatis + manual)
        $roomStatus = RoomBooking::all()->map(function($room) use ($occupiedRoomNumbers) {
            $allNumbers = explode(',', $room->room_booking_number);
            $occupiedCount = count(array_intersect($allNumbers, $occupiedRoomNumbers));
            
            // Status otomatis berdasarkan ketersediaan
            $autoStatus = ($occupiedCount == count($allNumbers)) ? 'Sold' : 'Ready';
            
            return [
                'id' => $room->room_booking_id,
                'name' => $room->room_booking_name,
                'auto_status' => $autoStatus,
                'manual_status' => $room->availability_status ?? 'Available',
                'total' => count($allNumbers),
                'occupied' => $occupiedCount,
                'available' => count($allNumbers) - $occupiedCount
            ];
        });

        // Ketersediaan kamar REAL-TIME
        $roomAvailability = RoomBooking::all()->map(function($room) use ($occupiedRoomNumbers) {
            $allNumbers = explode(',', $room->room_booking_number);
            $availableNumbers = array_values(array_diff($allNumbers, $occupiedRoomNumbers));
            
            return [
                'name' => $room->room_booking_name,
                'numbers' => $availableNumbers,
                'total' => count($allNumbers),
                'available_count' => count($availableNumbers),
                'manual_status' => $room->availability_status ?? 'Available'
            ];
        });

        return view('admin.dashboard', compact(
            'totalRooms', 
            'availableRooms', 
            'totalBookings', 
            'pendingBookings',
            'latestReservations',
            'roomStatus',
            'roomAvailability'
        ));
    }

    public function updateReservationStatus(Request $request, $reservationId)
    {
        $request->validate([
            'status' => 'required|in:Pending,Confirmed,Cancelled'
        ]);

        try {
            // PERBAIKAN: Gunakan reservation_id bukan primary key
            $reservation = Reservation::where('reservation_id', $reservationId)->firstOrFail();
            
            // Validasi: hanya reservasi dengan status Pending yang bisa diubah
            if ($reservation->booking_status !== 'Pending') {
                return response()->json([
                    'success' => false,
                    'message' => 'Hanya reservasi dengan status Pending yang bisa diubah'
                ], 422);
            }

            $reservation->update([
                'booking_status' => $request->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status reservasi berhasil diupdate'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate status: ' . $e->getMessage()
            ], 422);
        }
    }

    public function updateRoomAvailability(Request $request)
    {
        $request->validate([
            'updates' => 'required|array',
            'updates.*.room_id' => 'required|exists:room_booking,room_booking_id',
            'updates.*.status' => 'required|in:Available,Unavailable'
        ]);

        $updates = $request->input('updates', []);
        
        foreach ($updates as $update) {
            $room = RoomBooking::find($update['room_id']);
            if ($room) {
                $room->update([
                    'availability_status' => $update['status']
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Status ketersediaan kamar berhasil diperbarui'
        ]);
    }
}