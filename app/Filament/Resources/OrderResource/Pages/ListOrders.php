<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\ListRecords;
use Livewire\Attributes\On;
use Filament\Notifications\Notification;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    #[On('echo:orders,new-order')]
    public function handleNewOrderPlaced($event): void
    {
        Notification::make()
            ->title('🚲 Pesanan Baru Masuk!')
            ->body("Meja " . ($event['tableNumber'] ?? '-') . " — " . ($event['customerName'] ?? '-') . " | Antrian #" . ($event['queueNumber'] ?? '-') . " | Rp " . number_format($event['totalPrice'] ?? 0, 0, ',', '.'))
            ->success()
            ->send();
    }
}
