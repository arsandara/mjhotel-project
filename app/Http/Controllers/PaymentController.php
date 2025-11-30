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
        $validated = $request->validate([
            'reservation_id' => 'required|exists:reservation,reservation_id',
            'total_price'    => 'required|numeric|min:1000',
            'customer_name'  => 'required|string|max:100',
            'customer_email' => 'required|email|max:100',
            'customer_phone' => 'required|string|max:20',
        ]);

        Log::info('Payment create request:', $validated);

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

            // UPDATE RESERVASI DENGAN ORDER_ID
            $reservation = Reservation::where('reservation_id', $validated['reservation_id'])->firstOrFail();
            $reservation->update([
                'order_id'       => $orderId,
                'payment_status' => 'pending'
            ]);

            Log::info('Reservation updated with order_id', [
                'reservation_id' => $validated['reservation_id'],
                'order_id'       => $orderId
            ]);

            // INI YANG PENTING – SIMPAN ORDER_ID KE SESSION SEBELUM RETURN
            session(['last_midtrans_order_id' => $orderId]);

            return response()->json([
                'success'    => true,
                'snap_token' => $snapToken,
                'order_id'   => $orderId
            ]);

        } catch (\Exception $e) {
            Log::error('Midtrans error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Payment gateway error: ' . $e->getMessage()
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