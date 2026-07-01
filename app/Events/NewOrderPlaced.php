<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewOrderPlaced implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $orderId;
    public string $customerName;
    public string $tableNumber;
    public int $queueNumber;
    public int $itemsCount;
    public int $totalPrice;

    public function __construct(Order $order)
    {
        $this->orderId      = $order->id;
        $this->customerName = $order->customer_name;
        $this->tableNumber  = $order->table_number;
        $this->queueNumber  = $order->queue_number;
        $this->itemsCount   = $order->items()->count();
        $this->totalPrice   = $order->total_price;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('orders'),
        ];
    }

    public function broadcastAs(): string
    {
        return 'new-order';
    }
}
