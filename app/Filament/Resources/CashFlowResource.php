<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CashFlowResource\Pages;
use App\Models\CashFlow;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CashFlowResource extends Resource
{
    protected static ?string $model = CashFlow::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'Pembukuan (Cash Flow)';

    protected static ?string $modelLabel = 'Cash Flow';

    protected static ?string $pluralModelLabel = 'Rekap Cash Flow';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Keuangan')
                    ->schema([
                        DatePicker::make('date')
                            ->label('Tanggal')
                            ->default(now())
                            ->required(),

                        Select::make('type')
                            ->label('Tipe Transaksi')
                            ->options([
                                'income' => '📥 Pemasukan (Income)',
                                'expense' => '📤 Pengeluaran (Expense)',
                            ])
                            ->required()
                            ->native(false),

                        TextInput::make('amount')
                            ->label('Jumlah Uang (Rp)')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->prefix('Rp')
                            ->step(1000),

                        Select::make('category')
                            ->label('Kategori')
                            ->options([
                                'Sales' => '💰 Penjualan Makanan/Minuman',
                                'Raw Materials' => '🥩 Pembelian Bahan Baku',
                                'Operational' => '⚡ Biaya Operasional / Listrik',
                                'Salaries' => '👥 Gaji Karyawan',
                                'Marketing' => '📢 Biaya Promosi / Marketing',
                                'Others' => '📦 Lain-lain',
                            ])
                            ->required()
                            ->native(false),
                    ])
                    ->columns(2),

                Section::make('Keterangan Tambahan')
                    ->schema([
                        Textarea::make('description')
                            ->label('Deskripsi / Keterangan')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'income' => 'success',
                        'expense' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => $state === 'income' ? 'Pemasukan' : 'Pengeluaran')
                    ->sortable(),

                Tables\Columns\TextColumn::make('category')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('amount')
                    ->label('Jumlah')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable()
                    ->weight(\Filament\Support\Enums\FontWeight::SemiBold),

                Tables\Columns\TextColumn::make('description')
                    ->label('Keterangan')
                    ->limit(50)
                    ->searchable(),
            ])
            ->defaultSort('date', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Tipe')
                    ->options([
                        'income' => 'Pemasukan',
                        'expense' => 'Pengeluaran',
                    ]),
                Tables\Filters\SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'Sales' => 'Penjualan Makanan/Minuman',
                        'Raw Materials' => 'Pembelian Bahan Baku',
                        'Operational' => 'Biaya Operasional / Listrik',
                        'Salaries' => 'Gaji Karyawan',
                        'Marketing' => 'Biaya Promosi / Marketing',
                        'Others' => 'Lain-lain',
                    ]),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->striped();
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCashFlows::route('/'),
            'create' => Pages\CreateCashFlow::route('/create'),
            'edit' => Pages\EditCashFlow::route('/{record}/edit'),
        ];
    }
}
