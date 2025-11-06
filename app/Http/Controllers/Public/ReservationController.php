<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\RoomBooking;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Show the booking form
     */
    public function create(Request $request)
    {
        // Ambil data dari query parameters
        $roomId = $request->get('room_id');
        $roomName = $request->get('room');
        $price = $request->get('price');
        $checkin = $request->get('checkin');
        $checkout = $request->get('checkout');
        $persons = $request->get('persons');
        $image = $request->get('img') ?? 'images/default-room.jpg'; // ✅ default value

        // Jika ada room_id, ambil data lengkap dari database
        if ($roomId) {
            $room = RoomBooking::find($roomId);
            if ($room) {
                $roomName = $room->room_booking_name;
                $price = $room->room_booking_price;
                $image = $room->room_booking_image;
                $capacity = $room->room_booking_capacity;
            }
        }

        return view('public.booking-form', compact(
            'roomName', 'price', 'checkin', 'checkout', 'persons', 'image', 'roomId'
        ));
    }

    public function review(Request $request)
    {
        // Get data from request/session
        $checkin = $request->input('checkin') ?? session('checkin');
        $checkout = $request->input('checkout') ?? session('checkout');
        $price = $request->input('price') ?? session('price') ?? 0;
        $roomId = $request->input('room_id') ?? session('room_id');
        $roomName = $request->input('room_name') ?? session('room_name');
        $persons = $request->input('persons') ?? session('persons') ?? 2;
        $image = $request->input('image') ?? session('image');

        // Parse dates using Carbon
        $checkinDate = Carbon::parse($checkin);
        $checkoutDate = Carbon::parse($checkout);
        
        // Calculate duration (PASTI POSITIF!)
        $duration = $checkoutDate->diffInDays($checkinDate);
        
        // Ensure minimum 1 night
        if ($duration < 1) {
            $duration = 1;
        }
        
        // Calculate total
        $totalPrice = $price * $duration;

        // Pass to view
        return view('reservation.review-booking', compact(
            'checkin',
            'checkout',
            'checkinDate',
            'checkoutDate',
            'duration',
            'price',
            'totalPrice',
            'roomId',
            'roomName',
            'persons',
            'image'
        ));
    }

    /**
     * Store booking data
     */
    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'full_name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required|min:10',
            'dob_day' => 'required|digits:2',
            'dob_month' => 'required|digits:2', 
            'dob_year' => 'required|digits:4',
            'room_name' => 'required',
            'price' => 'required|numeric',
            'checkin' => 'required|date',
            'checkout' => 'required|date',
            'persons' => 'required|numeric'
        ]);

        // Hitung durasi
        $checkin = \Carbon\Carbon::parse($validated['checkin']);
        $checkout = \Carbon\Carbon::parse($validated['checkout']);
        $duration = $checkout->diffInDays($checkin);
        
        // Format birthdate
        $birthdate = $validated['dob_year'] . '-' . $validated['dob_month'] . '-' . $validated['dob_day'];
        
        // Generate reservation ID
        $reservationId = 'RSV' . date('Ymd') . rand(1000, 9999);

        // Simpan ke database
        $reservation = \App\Models\Reservation::create([
            'reservation_id' => $reservationId,
            'customer_name' => $validated['full_name'],
            'customer_birthdate' => $birthdate,
            'customer_email' => $validated['email'],
            'customer_phone' => $validated['phone'],
            'special_request' => $request->note,
            'check_in' => $validated['checkin'],
            'check_out' => $validated['checkout'],
            'duration' => $duration,
            'capacity' => $validated['persons'],
            'room_price' => $validated['price'],
            'total_price' => $validated['price'] * $duration,
            'booking_status' => 'Pending',
            'room_booking_id' => $request->room_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Booking berhasil! Reservasi ID: ' . $reservationId,
            'reservation_id' => $reservationId
        ]);
    }
}