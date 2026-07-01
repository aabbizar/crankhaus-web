<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class DummyPaymentController extends Controller
{
    public function checkout(Request $request, Product $product)
    {
        if ($product->stock < 1) {
            return response()->json(['error' => 'Stok produk habis.'], 422);
        }

        $orderId = 'DUMMY-' . strtoupper(uniqid()) . '-' . $product->id;

        $order = auth()->user()->orders()->create([
            'midtrans_order_id' => $orderId,
            'payment_status'    => 'pending',
            'snap_token'        => 'dummy-token-' . $orderId,
        ]);

        $order->items()->create([
            'product_id' => $product->id,
            'quantity'   => 1,
        ]);

        return response()->json([
            'snap_token' => 'dummy-' . $orderId,
            'order_id'   => $order->id,
            'is_dummy'   => true,
            'product'    => $product->name,
            'amount'     => $product->price,
        ]);
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer|exists:orders,id',
            'status'   => 'required|in:success,pending,failure',
        ]);

        $order = Order::findOrFail($request->order_id);

        $statusMap = [
            'success' => 'settlement',
            'pending' => 'pending',
            'failure' => 'deny',
        ];

        $order->update(['payment_status' => $statusMap[$request->status]]);

        if ($request->status === 'success') {
            $order->items->each(function ($item) {
                $item->product->decrement('stock', $item->quantity);
            });
        }

        return response()->json([
            'message' => 'Order updated',
            'status'  => $order->payment_status,
        ]);
    }

    public function modal()
    {
        return view('dummy-payment-modal');
    }
}
