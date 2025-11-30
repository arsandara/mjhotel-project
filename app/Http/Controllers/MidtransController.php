<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    /**
     * Handle Midtrans notification webhook
     * INI YANG AKAN OTOMATIS UPDATE STATUS KE "CONFIRMED"
     */
    public function handleNotification(Request $request)
    {
        Log::info('🎯 Midtrans Webhook Received', $request->all());

        try {
            // 1. Verifikasi signature (security)
            $serverKey = 'Mid-server-hdmLL37tARsQYBmi_9301UgP'; // PAKAI SERVER KEY YANG SAMA
            $hashed = hash('sha512', 
                $request->order_id . 
                $request->status_code . 
                $request->gross_amount . 
                $serverKey
            );

            if ($hashed != $request->signature_key) {
                Log::warning('❌ Signature mismatch', [
                    'order_id' => $request->order_id,
                    'received' => $request->signature_key,
                    'calculated' => $hashed
                ]);
                return response()->json(['status' => 'error', 'message' => 'Invalid signature'], 400);
            }

            // 2. Cari reservasi berdasarkan order_id
            $reservation = Reservation::where('order_id', $request->order_id)->first();

            if (!$reservation) {
                Log::error('❌ Reservation not found for order_id: ' . $request->order_id);
                return response()->json(['status' => 'error', 'message' => 'Reservation not found'], 404);
            }

            $transactionStatus = $request->transaction_status;
            $fraudStatus = $request->fraud_status;

            Log::info('🔧 Processing transaction', [
                'order_id' => $request->order_id,
                'reservation_id' => $reservation->reservation_id,
                'transaction_status' => $transactionStatus,
                'fraud_status' => $fraudStatus
            ]);

            // 3. ✅ INI TRIGGER YANG KAMU MAU - UPDATE STATUS OTOMATIS
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'accept') {
                    // PEMBAYARAN BERHASIL - STATUS JADI CONFIRMED
                    $reservation->update([
                        'payment_status' => 'paid',
                        'booking_status' => 'Confirmed', // ✅ INI YANG KAMU MAU!
                        'paid_at' => now(),
                        'payment_method' => $request->payment_type ?? 'credit_card'
                    ]);
                    Log::info('✅ Payment captured and accepted: ' . $request->order_id);
                }
            } 
            else if ($transactionStatus == 'settlement') {
                // PEMBAYARAN BERHASIL - STATUS JADI CONFIRMED
                $reservation->update([
                    'payment_status' => 'paid',
                    'booking_status' => 'Confirmed', // ✅ INI YANG KAMU MAU!
                    'paid_at' => now(),
                    'payment_method' => $request->payment_type ?? $request->payment_method
                ]);
                Log::info('✅ Payment settled: ' . $request->order_id);
            } 
            else if ($transactionStatus == 'pending') {
                // MENUNGGU PEMBAYARAN
                $reservation->update([
                    'payment_status' => 'pending',
                    'booking_status' => 'Pending'
                ]);
                Log::info('⏳ Payment pending: ' . $request->order_id);
            } 
            else if ($transactionStatus == 'deny') {
                // PEMBAYARAN DITOLAK
                $reservation->update([
                    'payment_status' => 'failed',
                    'booking_status' => 'Cancelled'
                ]);
                Log::info('❌ Payment denied: ' . $request->order_id);
            } 
            else if ($transactionStatus == 'expire') {
                // PEMBAYARAN KADALUARSA
                $reservation->update([
                    'payment_status' => 'expired',
                    'booking_status' => 'Cancelled'
                ]);
                Log::info('⏰ Payment expired: ' . $request->order_id);
            } 
            else if ($transactionStatus == 'cancel') {
                // PEMBAYARAN DIBATALKAN
                $reservation->update([
                    'payment_status' => 'cancelled',
                    'booking_status' => 'Cancelled'
                ]);
                Log::info('🚫 Payment cancelled: ' . $request->order_id);
            }

            Log::info('🎉 Webhook processed successfully');
            return response()->json(['status' => 'success']);

        } catch (\Exception $e) {
            Log::error('💥 Midtrans webhook error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Internal server error'], 500);
        }
    }

    /**
     * Manual test webhook (untuk testing tanpa bayar beneran)
     */
    public function testWebhook(Request $request)
    {
        $orderId = $request->order_id ?? 'TEST_' . time();
        
        // Simulasikan data webhook dari Midtrans untuk pembayaran berhasil
        $testData = [
            'order_id' => $orderId,
            'transaction_status' => 'settlement', // Status sukses
            'status_code' => '200',
            'gross_amount' => '780000',
            'signature_key' => hash('sha512', $orderId . '200' . '780000' . 'Mid-server-hdmLL37tARsQYBmi_9301UgP'),
            'fraud_status' => 'accept',
            'payment_type' => 'gopay'
        ];

        Log::info('🧪 Testing webhook with data:', $testData);

        // Panggil handler dengan test data
        return $this->handleNotification(new Request($testData));
    }
}