<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\RoomBooking;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservationController extends Controller
{
    /**
     * Show review booking page - METHOD INI YANG DIPAKAI
     */
    public function review(Request $request)
    {
        // Get data from request
        $checkin = $request->input('checkin');
        $checkout = $request->input('checkout');
        $price = $request->input('price') ?? 0;
        $roomId = $request->input('room_id');
        $roomName = $request->input('room');
        $persons = $request->input('persons') ?? 2;

        // ✅ VALIDASI: Pastikan data lengkap
        if (!$checkin || !$checkout || !$roomName) {
            return redirect()->route('reservation')->with('error', 'Data pemesanan tidak lengkap');
        }

        // ✅ PERBAIKAN: Parse dates dengan Carbon TANPA startOfDay()
        // Gunakan parse() saja untuk mendapatkan date yang konsisten
        $checkinDate = Carbon::parse($checkin);
        $checkoutDate = Carbon::parse($checkout);
        
        // ✅ VALIDASI: Tanggal checkout harus setelah checkin
        if ($checkoutDate->lte($checkinDate)) {
            return redirect()->route('reservation')->with('error', 'Tanggal check-out harus setelah tanggal check-in');
        }
        
        // ✅ PERBAIKAN KUNCI: Hitung durasi dengan benar
        // diffInDays() menghitung selisih hari secara akurat
        $duration = $checkinDate->diffInDays($checkoutDate);
        
        // Pastikan durasi minimal 1 malam
        if ($duration < 1) {
            $duration = 1;
        }
        
        // Hitung total harga
        $totalPrice = $price * $duration;

        // Ambil gambar dari database jika ada room_id
        $image = 'default-room.jpg';
        if ($roomId) {
            $room = RoomBooking::find($roomId);
            if ($room && $room->room_booking_image) {
                $image = $room->room_booking_image;
            }
        }

        // ✅ PENTING: Pass semua variabel ke view
        return view('public.booking-form', compact(
            'checkin',
            'checkout', 
            'checkinDate',
            'checkoutDate',
            'duration',      // ← INI YANG PENTING!
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
            'full_name'   => 'required|min:3',
            'email'       => 'required|email',
            'phone'       => 'required|min:10',
            'dob_day'     => 'required|digits:2',
            'dob_month'   => 'required|digits:2', 
            'dob_year'    => 'required|digits:4',
            'room_name'   => 'required',
            'price'       => 'required|numeric',
            'checkin'     => 'required|date',
            'checkout'    => 'required|date',
            'persons'     => 'required|numeric'
        ]);

        // Hitung durasi & validasi tanggal
        $checkin  = Carbon::parse($validated['checkin']);
        $checkout = Carbon::parse($validated['checkout']);
        
        if ($checkout->lte($checkin)) {
            return response()->json([
                'success' => false,
                'message' => 'Tanggal check-out harus setelah check-in'
            ], 422);
        }

        $duration   = $checkin->diffInDays($checkout);
        if ($duration < 1) $duration = 1;
        $totalPrice = $validated['price'] * $duration;

        // Format tanggal lahir
        $birthdate = $validated['dob_year'] . '-' . 
                    str_pad($validated['dob_month'], 2, '0', STR_PAD_LEFT) . '-' . 
                    str_pad($validated['dob_day'], 2, '0', STR_PAD_LEFT);

        // GENERATE ID CANTIK: RSV20250000001, RSV20250000002, dst...
        $reservationId = \App\Models\Reservation::generateReservationId();

        // Simpan reservasi
        $reservation = Reservation::create([
            'reservation_id'     => $reservationId,
            'customer_name'      => $validated['full_name'],
            'customer_birthdate' => $birthdate,
            'customer_email'     => $validated['email'],
            'customer_phone'     => $validated['phone'],
            'special_request'    => $request->note,
            'check_in'           => $validated['checkin'],
            'check_out'          => $validated['checkout'],
            'duration'           => $duration,
            'capacity'           => $validated['persons'] . ' orang',
            'room_price'         => $validated['price'],
            'total_price'        => $totalPrice,
            'booking_status'     => 'Pending',
            'room_booking_id'    => $request->room_id,
            'payment_status'     => 'pending',
            'order_id'           => null,
        ]);

        return response()->json([
            'success'         => true,
            'message'         => 'Reservasi berhasil dibuat!',
            'reservation_id'  => $reservationId,
            'total_price'     => $totalPrice,
            'customer_name'   => $validated['full_name'],
            'customer_email'  => $validated['email'],
            'customer_phone'  => $validated['phone']
        ]);
    }

    /**
     * Thank you page
     */
    public function thankYou(Request $request)
    {
        \Log::info('THANK YOU PAGE DIPANGGIL');

        // Coba ambil dari URL dulu (buat jaga-jaga)
        $orderId = $request->query('order_id');

        // Kalau kosong, ambil dari session (INI YANG PASTI ADA)
        if (!$orderId) {
            $orderId = session('last_midtrans_order_id');
            \Log::info('Order ID diambil dari session: ' . $orderId);
        }

        if ($orderId) {
            $reservation = Reservation::where('order_id', $orderId)->first();

            if ($reservation && $reservation->payment_status === 'pending') {
                $gross = number_format($reservation->total_price, 2, '.', '');

                $fakeRequest = new \Illuminate\Http\Request();
                $fakeRequest->replace([
                    'order_id'           => $orderId,
                    'transaction_status' => 'settlement',
                    'status_code'        => '200',
                    'gross_amount'       => $gross,
                    'signature_key'      => hash('sha512', $orderId . '200' . $gross . 'Mid-server-hdmLL37tARsQYBmi_9301UgP'),
                    'fraud_status'      => 'accept',
                    'payment_type'       => 'credit_card',
                ]);

                \Log::info('AUTO CONFIRM ORDER: ' . $orderId);
                app(\App\Http\Controllers\MidtransController::class)->handleNotification($fakeRequest);

                // Bersihin session biar nggak kepake ulang
                session()->forget('last_midtrans_order_id');
            }
        }

        return view('public.thank-you'); // pastikan view ini udah ada
    }
    
    /**
     * Pending page  
     */
    public function pending(Request $request)
    {
        $reservationId = $request->query('reservation_id');
        return view('public.pending', compact('reservationId'));
    }
}