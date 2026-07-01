<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions;

class ViewOrder extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('process')
                ->label('Proses Pesanan')
                ->icon('heroicon-o-fire')
                ->color('warning')
                ->requiresConfirmation()
                ->visible(fn () => $this->record->status === 'pending')
                ->action(fn () => $this->record->update(['status' => 'processing'])),

            Actions\Action::make('complete')
                ->label('Selesaikan Pesanan')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->requiresConfirmation()
                ->visible(fn () => $this->record->status === 'processing')
                ->action(fn () => $this->record->update(['status' => 'completed'])),
        ];
    }
}
