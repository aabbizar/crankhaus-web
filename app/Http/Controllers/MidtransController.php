<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function notification(Request $request)
    {
        \Midtrans\Config::$serverKey    = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');

        try {
            $notif = new \Midtrans\Notification();
        } catch (\Exception $e) {
            return response('OK', 200);
        }

        $transaction = $notif->transaction_status;
        $orderId     = $notif->order_id;

        $order = Order::where('midtrans_order_id', $orderId)->first();

        if (!$order) {
            return response('Order not found', 404);
        }

        $statusMap = [
            'capture'          => 'success',
            'settlement'       => 'success',
            'pending'          => 'pending',
            'deny'             => 'failure',
            'expire'           => 'failure',
            'cancel'           => 'failure',
        ];

        $newStatus = $statusMap[$transaction] ?? $order->payment_status;

        if ($newStatus === 'success') {
            $order->items->each(function ($item) {
                $item->product->decrement('stock', $item->quantity);
            });
        }

        $order->update(['payment_status' => $newStatus]);

        return response('OK', 200);
    }
}
