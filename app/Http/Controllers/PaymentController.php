<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function create(Request $request)
    {
        // Validasi sama
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $request->reservation_id . '-' . time(),
                'gross_amount' => $request->total_price,
            ],
            'customer_details' => [
                'first_name' => $request->input('customer_name', 'Guest'),
                'email' => $request->input('customer_email', 'guest@example.com'),
                'phone' => $request->input('customer_phone', '08123456789'),
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            return response()->json(['success' => true, 'snap_token' => $snapToken]);
        } catch (\Exception $e) {
            Log::error('Midtrans SDK error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}