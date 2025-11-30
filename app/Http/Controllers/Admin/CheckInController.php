<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\RoomBooking;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CheckInController extends Controller
{
    public function index()
    {
        // HANYA tampilkan reservasi yang belum check-in (status Confirmed)
        $reservations = Reservation::with('roomBooking')
            ->where('booking_status', 'Confirmed') // Hanya yang confirmed
            ->orderBy('check_in', 'asc')
            ->get();

        // Ambil semua nomor kamar yang sedang terpakai (Confirmed + Checked In)
        $occupiedRoomNumbers = Reservation::whereIn('booking_status', ['Confirmed', 'Checked In'])
            ->whereNotNull('room_number')
            ->pluck('room_number')
            ->toArray();

        // Ambil data kamar dengan informasi ketersediaan real-time
        $availableRooms = RoomBooking::all()
            ->map(function($room) use ($occupiedRoomNumbers) {
                $allNumbers = explode(',', $room->room_booking_number);
                $availableNumbers = array_values(array_diff($allNumbers, $occupiedRoomNumbers));
                
                return [
                    'id' => $room->room_booking_id,
                    'name' => $room->room_booking_name,
                    'price' => $room->room_booking_price,
                    'total_rooms' => count($allNumbers),
                    'available_count' => count($availableNumbers),
                    'available_numbers' => $availableNumbers,
                    'all_numbers' => $allNumbers,
                ];
            })
            ->filter(function($room) {
                return $room['available_count'] > 0;
            })
            ->values()
            ->toArray();

        return view('admin.checkin', compact('reservations', 'availableRooms'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'room_booking_id'   => 'required|exists:room_booking,room_booking_id',
                'customer_name'     => 'required|string|max:100',
                'customer_email'    => 'required|email|max:100',
                'customer_phone'    => 'required|string|max:20',
                'check_in'          => 'required|date',
                'check_out'         => 'required|date|after:check_in',
                'room_number'       => 'required|string|max:10',
                'special_request'   => 'nullable|string',
            ]);

            // AMBIL DATA KAMAR
            $room = RoomBooking::findOrFail($validated['room_booking_id']);
            $pricePerNight = $room->room_booking_price;

            // HITUNG DURASI & TOTAL
            $checkIn  = Carbon::parse($validated['check_in']);
            $checkOut = Carbon::parse($validated['check_out']);
            $duration = $checkIn->diffInDays($checkOut);
            if ($duration < 1) $duration = 1;
            $totalPrice = $pricePerNight * $duration;

            // CEK NOMOR KAMAR SUDAH DIPAKAI
            $exists = Reservation::where('room_number', $validated['room_number'])
                ->where('room_booking_id', $validated['room_booking_id'])
                ->whereIn('booking_status', ['Confirmed', 'Checked In'])
                ->exists();

            if ($exists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Nomor kamar ' . $validated['room_number'] . ' sudah dipakai!'
                ], 422);
            }

            // GENERATE ID
            $reservationId = Reservation::generateReservationId();

            Reservation::create([
                'reservation_id'   => $reservationId,
                'room_booking_id'  => $validated['room_booking_id'],
                'customer_name'    => $validated['customer_name'],
                'customer_email'   => $validated['customer_email'],
                'customer_phone'   => $validated['customer_phone'],
                'check_in'         => $validated['check_in'],
                'check_out'        => $validated['check_out'],
                'duration'         => $duration,
                'room_number'      => $validated['room_number'],
                'special_request'  => $validated['special_request'],
                'capacity'         => '2 orang',
                'room_price'       => $pricePerNight,
                'total_price'      => $totalPrice,
                'booking_status'   => 'Confirmed',
                'payment_status'   => 'paid',
                'paid_at'          => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Reservasi manual berhasil dibuat!',
                'reservation_id' => $reservationId
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak lengkap: ' . implode(', ', $e->errors()->all())
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Manual Reservation Error: ' . $e->getMessage(), $request->all());
            return response()->json([
                'success' => false,
                'message' => 'Gagal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateRoomNumber(Request $request, $reservationId)
    {
        try {
            $validated = $request->validate([
                'room_number' => 'required|string|max:50'
            ]);

            // PERBAIKAN: Cari berdasarkan reservation_id (bukan primary key)
            $reservation = Reservation::where('reservation_id', $reservationId)->firstOrFail();
            
            // Cek apakah nomor kamar sudah dipakai oleh reservasi lain
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

            $reservation->update([
                'room_number' => $validated['room_number']
            ]);

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
            $reservation->delete();

            return response()->json([
                'success' => true,
                'message' => 'Reservasi berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus reservasi: ' . $e->getMessage()
            ], 422);
        }
    }

    public function search(Request $request)
    {
        $query = $request->get('q', '');

        // Hanya search di reservasi yang Confirmed
        $reservations = Reservation::with('roomBooking')
            ->where('booking_status', 'Confirmed')
            ->where(function($q) use ($query) {
                $q->where('customer_name', 'like', "%{$query}%")
                  ->orWhere('customer_email', 'like', "%{$query}%")
                  ->orWhere('room_number', 'like', "%{$query}%");
            })
            ->orderBy('check_in', 'asc')
            ->get();

        return response()->json($reservations);
    }

    public function getAvailableNumbers($roomId)
    {
        $room = RoomBooking::findOrFail($roomId);
        $allNumbers = explode(',', $room->room_booking_number);
        
        // Ambil nomor kamar yang sudah dipakai (Confirmed + Checked In)
        $usedNumbers = Reservation::where('room_booking_id', $roomId)
            ->whereIn('booking_status', ['Confirmed', 'Checked In'])
            ->whereNotNull('room_number')
            ->pluck('room_number')
            ->toArray();

        // Filter nomor yang tersedia
        $availableNumbers = array_values(array_diff($allNumbers, $usedNumbers));

        return response()->json([
            'available_numbers' => $availableNumbers,
            'total' => count($allNumbers),
            'available_count' => count($availableNumbers)
        ]);
    }

    public function checkin($reservationId)
    {
        try {
            \Log::info('Checkin attempt for reservation: ' . $reservationId);
            
            // PERBAIKAN: Cari berdasarkan reservation_id (bukan primary key)
            $reservation = Reservation::where('reservation_id', $reservationId)->firstOrFail();
            
            // Validasi: hanya reservasi dengan status Confirmed yang bisa check-in
            if ($reservation->booking_status !== 'Confirmed') {
                return response()->json([
                    'success' => false,
                    'message' => 'Hanya reservasi dengan status Confirmed yang bisa check-in'
                ], 422);
            }
            
            // Update status reservasi menjadi Checked In
            $reservation->update([
                'booking_status' => 'Checked In',
                'checked_in_at' => now() // tambahkan timestamp check-in
            ]);

            \Log::info('Checkin successful for reservation: ' . $reservationId);

            return response()->json([
                'success' => true,
                'message' => 'Tamu berhasil check-in'
            ]);

        } catch (\Exception $e) {
            \Log::error('Checkin failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal check-in: ' . $e->getMessage()
            ], 422);
        }
    }
    
    public function checkout($reservationId)
    {
        try {
            // PERBAIKAN: Cari berdasarkan reservation_id (bukan primary key)
            $reservation = Reservation::where('reservation_id', $reservationId)->firstOrFail();
            
            // Update status reservasi menjadi Checked Out
            $reservation->update([
                'booking_status' => 'Checked Out',
                'checked_out_at' => now() // tambahkan timestamp check-out
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Checkout berhasil'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal checkout: ' . $e->getMessage()
            ], 422);
        }
    }
}