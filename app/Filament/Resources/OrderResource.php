<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Schemas\Components\Section as InfolistSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Select;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Pesanan Masuk';

    protected static ?string $modelLabel = 'Pesanan';

    protected static ?string $pluralModelLabel = 'Daftar Pesanan';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'customer_name';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('status')
                ->label('Status Pesanan')
                ->options([
                    'pending'    => '🕒 Menunggu Diproses (Belum Dimasak)',
                    'processing' => '🔥 Sedang Dimasak (Proses)',
                    'completed'  => '✅ Selesai (Sudah Dibayar/Diantar)',
                ])
                ->required()
                ->native(false)
                ->columnSpanFull(),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                InfolistSection::make('Detail Pesanan')
                    ->schema([
                        TextEntry::make('queue_number')
                            ->label('Nomor Antrian')
                            ->size(\Filament\Support\Enums\TextSize::Large)
                            ->weight(\Filament\Support\Enums\FontWeight::Bold)
                            ->formatStateUsing(fn ($state) => '#' . str_pad($state, 3, '0', STR_PAD_LEFT)),

                        TextEntry::make('customer_name')
                            ->label('Nama Pelanggan'),

                        TextEntry::make('table_number')
                            ->label('Nomor Meja'),

                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending'    => 'warning',
                                'processing' => 'info',
                                'completed'  => 'success',
                                default      => 'gray',
                            }),

                        TextEntry::make('payment_method')
                            ->label('Metode Pembayaran'),

                        TextEntry::make('total_price')
                            ->label('Total Harga')
                            ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                            ->size(\Filament\Support\Enums\TextSize::Large)
                            ->weight(\Filament\Support\Enums\FontWeight::Bold),
                    ])
                    ->columns(3),

                InfolistSection::make('Item Pesanan')
                    ->schema([
                        RepeatableEntry::make('items')
                            ->label('')
                            ->schema([
                                TextEntry::make('menu.name')->label('Menu'),
                                TextEntry::make('quantity')->label('Qty'),
                                TextEntry::make('unit_price')
                                    ->label('Harga Satuan')
                                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                                TextEntry::make('subtotal')
                                    ->label('Subtotal')
                                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                            ])
                            ->columns(4),
                    ]),

                InfolistSection::make('Waktu')
                    ->schema([
                        TextEntry::make('created_at')->label('Waktu Pesan')->dateTime('d M Y, H:i'),
                        TextEntry::make('updated_at')->label('Terakhir Update')->dateTime('d M Y, H:i'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('queue_number')
                    ->label('#Antrian')
                    ->formatStateUsing(fn ($state) => str_pad($state, 3, '0', STR_PAD_LEFT))
                    ->sortable()
                    ->weight(\Filament\Support\Enums\FontWeight::Bold)
                    ->size(\Filament\Support\Enums\TextSize::Large),

                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Nama Pelanggan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('table_number')
                    ->label('Meja')
                    ->searchable()
                    ->badge()
                    ->color('gray'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending'    => 'warning',
                        'processing' => 'info',
                        'completed'  => 'success',
                        default      => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('items_count')
                    ->label('Item')
                    ->counts('items')
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu Pesan')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->since(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending'    => 'Pending',
                        'processing' => 'Processing',
                        'completed'  => 'Completed',
                    ])
                    ->native(false),

                Tables\Filters\Filter::make('today')
                    ->label('Hari Ini')
                    ->query(fn ($query) => $query->whereDate('created_at', today()))
                    ->toggle(),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),

                \Filament\Actions\Action::make('process')
                    ->label('Proses')
                    ->icon('heroicon-o-fire')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading('Proses Pesanan Ini?')
                    ->modalDescription('Pesanan akan ditandai sebagai sedang diproses dapur.')
                    ->visible(fn (Order $record) => $record->status === 'pending')
                    ->action(function (Order $record) {
                        $record->update(['status' => 'processing']);
                        Notification::make()
                            ->title('Pesanan diproses 🔥')
                            ->body("Meja {$record->table_number} — #{$record->queue_number} sedang dimasak.")
                            ->warning()
                            ->send();
                    }),

                \Filament\Actions\Action::make('complete')
                    ->label('Selesai ✓')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Tandai Pesanan Selesai?')
                    ->modalDescription('Pesanan telah diserahkan ke pelanggan dan pembayaran diterima.')
                    ->visible(fn (Order $record) => $record->status === 'processing')
                    ->action(function (Order $record) {
                        $record->update(['status' => 'completed']);
                        Notification::make()
                            ->title('Pesanan selesai! ✓')
                            ->body("Meja {$record->table_number} — #{$record->queue_number} telah dilayani.")
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\BulkAction::make('bulk_complete')
                        ->label('Tandai Selesai')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(fn ($records) => $records->each->update(['status' => 'completed'])),
                ]),
            ])
            ->poll('30s')
            ->striped();
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getGlobalSearchResultDetails(\Illuminate\Database\Eloquent\Model $record): array
    {
        return [
            'Meja'   => $record->table_number,
            'Status' => $record->status,
            'Total'  => 'Rp ' . number_format($record->total_price, 0, ',', '.'),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'view'  => Pages\ViewOrder::route('/{record}'),
        ];
    }
}
