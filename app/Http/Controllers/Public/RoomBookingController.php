<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\RoomBooking;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class RoomBookingController extends Controller
{
    public function index()
    {
        // Cek apakah kolom availability_status sudah ada
        $hasAvailabilityColumn = Schema::hasColumn('room_booking', 'availability_status');
        
        if ($hasAvailabilityColumn) {
            // Jika ada, filter berdasarkan availability_status = Available
            $rooms = RoomBooking::where('availability_status', 'Available')->get();
        } else {
            // Jika belum ada kolom, fallback ke room_booking_status = Ready
            $rooms = RoomBooking::where('room_booking_status', 'Ready')->get();
        }
        
        // Ambil nomor kamar yang sedang terpakai (Confirmed)
        $occupiedRoomNumbers = Reservation::where('booking_status', 'Confirmed')
            ->whereNotNull('room_number')
            ->pluck('room_number')
            ->toArray();
        
        // Tambahkan info ketersediaan real-time ke setiap room
        $rooms = $rooms->map(function($room) use ($occupiedRoomNumbers) {
            $allNumbers = explode(',', $room->room_booking_number);
            $availableNumbers = array_diff($allNumbers, $occupiedRoomNumbers);
            
            $room->total_rooms = count($allNumbers);
            $room->available_count = count($availableNumbers);
            $room->available_numbers = array_values($availableNumbers);
            $room->is_available = count($availableNumbers) > 0;
            
            return $room;
        });
        
        return view('reservation', compact('rooms'));
    }

    public function getAvailableRooms(Request $request)
    {
        $hasAvailabilityColumn = Schema::hasColumn('room_booking', 'availability_status');
        
        if ($hasAvailabilityColumn) {
            $rooms = RoomBooking::where('availability_status', 'Available')->get();
        } else {
            $rooms = RoomBooking::where('room_booking_status', 'Ready')->get();
        }
        
        // Ambil nomor kamar yang sedang terpakai
        $occupiedRoomNumbers = Reservation::where('booking_status', 'Confirmed')
            ->whereNotNull('room_number')
            ->pluck('room_number')
            ->toArray();
        
        // Tambahkan info ketersediaan real-time
        $rooms = $rooms->map(function($room) use ($occupiedRoomNumbers) {
            $allNumbers = explode(',', $room->room_booking_number);
            $availableNumbers = array_diff($allNumbers, $occupiedRoomNumbers);
            
            $room->total_rooms = count($allNumbers);
            $room->available_count = count($availableNumbers);
            $room->available_numbers = array_values($availableNumbers);
            $room->is_available = count($availableNumbers) > 0;
            
            return $room;
        });
        
        return response()->json([
            'rooms' => $rooms
        ]);
    }

    public function getRoomDetail($id)
    {
        $room = RoomBooking::findOrFail($id);
        
        // Ambil nomor kamar yang sedang terpakai untuk room ini
        $occupiedRoomNumbers = Reservation::where('booking_status', 'Confirmed')
            ->where('room_booking_id', $id)
            ->whereNotNull('room_number')
            ->pluck('room_number')
            ->toArray();
        
        $allNumbers = explode(',', $room->room_booking_number);
        $availableNumbers = array_diff($allNumbers, $occupiedRoomNumbers);
        
        $room->total_rooms = count($allNumbers);
        $room->available_count = count($availableNumbers);
        $room->available_numbers = array_values($availableNumbers);
        $room->is_available = count($availableNumbers) > 0;
        
        return response()->json($room);
    }
}