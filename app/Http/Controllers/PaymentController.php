<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Reservation;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function create(Request $request)
    {
        Log::info('Payment create called', $request->all());

        $validated = $request->validate([
            'reservation_id' => 'required|exists:reservation,reservation_id',
            'total_price'    => 'required|numeric|min:1000',
            'customer_name'  => 'required|string|max:100',
            'customer_email' => 'required|email|max:100',
            'customer_phone' => 'required|string|max:20',
        ]);

        Log::info('Validation passed', $validated);

        // Cari reservasi dengan log
        $reservation = Reservation::where('reservation_id', $validated['reservation_id'])->first();

        if (!$reservation) {
            Log::error('Reservation NOT FOUND in payment create!', [
                'reservation_id' => $validated['reservation_id']
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Reservasi tidak ditemukan. Silakan ulangi proses pemesanan.'
            ], 404);
        }

        Log::info('Reservation found', [
            'reservation_id' => $reservation->reservation_id,
            'total_price' => $reservation->total_price
        ]);

        // Setup Midtrans
        \Midtrans\Config::$serverKey    = 'Mid-server-hdmLL37tARsQYBmi_9301UgP';
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized  = true;
        \Midtrans\Config::$is3ds        = true;

        $orderId = $validated['reservation_id'] . '_' . time();

        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => (int)$validated['total_price']
            ],
            'customer_details' => [
                'first_name' => $validated['customer_name'],
                'email'      => $validated['customer_email'],
                'phone'      => $validated['customer_phone'],
            ],
            'callbacks' => [
                'finish' => url('/reservation/thank-you') . '?order_id=' . $orderId,
            ]
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            Log::info('Snap token generated', ['order_id' => $orderId]);

            $reservation->update([
                'order_id'       => $orderId,
                'payment_status' => 'pending'
            ]);

            session(['last_midtrans_order_id' => $orderId]);

            return response()->json([
                'success'    => true,
                'snap_token' => $snapToken,
                'order_id'   => $orderId
            ]);

        } catch (\Exception $e) {
            Log::error('Midtrans Snap error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat transaksi Midtrans: ' . $e->getMessage()
            ], 500);
        }
    }

    // ✅ TAMBAHAN: Payment Callback Routes
    public function paymentFinish()
    {
        return view('payment.finish', [
            'message' => 'Pembayaran berhasil! Reservasi Anda telah dikonfirmasi.',
            'status' => 'success'
        ]);
    }

    public function paymentError()
    {
        return view('payment.finish', [
            'message' => 'Maaf, terjadi kesalahan dalam proses pembayaran.',
            'status' => 'error'
        ]);
    }

    public function paymentPending()
    {
        return view('payment.finish', [
            'message' => 'Menunggu konfirmasi pembayaran. Silakan selesaikan pembayaran Anda.',
            'status' => 'pending'
        ]);
    }

    // ✅ TAMBAHAN: Check Payment Status
    public function checkStatus($reservationId)
    {
        try {
            $reservation = Reservation::where('reservation_id', $reservationId)->firstOrFail();
            
            return response()->json([
                'success' => true,
                'payment_status' => $reservation->payment_status,
                'booking_status' => $reservation->booking_status,
                'is_paid' => $reservation->isPaid()
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}