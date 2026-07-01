<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'table_number',
        'total_price',
        'payment_method',
        'status',
        'queue_number',
        'user_id',
    ];

    protected $casts = [
        'total_price' => 'integer',
        'queue_number' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    protected static function booted(): void
    {
        static::updated(function (Order $order) {
            if ($order->isDirty('status') && $order->status === 'completed') {
                // Auto record cash flow
                \App\Models\CashFlow::create([
                    'date' => now(),
                    'type' => 'income',
                    'category' => 'Sales',
                    'amount' => $order->total_price,
                    'description' => "Penjualan otomatis dari Pesanan #" . str_pad($order->queue_number, 3, '0', STR_PAD_LEFT) . " atas nama {$order->customer_name} (Meja {$order->table_number})",
                ]);
            }
        });
    }

    /**
     * Get the next queue number for today.
     */
    public static function nextQueueNumber(): int
    {
        $todayMax = static::whereDate('created_at', today())->max('queue_number');
        return ($todayMax ?? 0) + 1;
    }
}

