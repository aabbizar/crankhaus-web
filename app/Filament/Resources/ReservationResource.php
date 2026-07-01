<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages;
use App\Models\Reservation;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationLabel = 'Reservations';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Guest Details')
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Full Name')
                        ->required()
                        ->maxLength(100),

                    Forms\Components\TextInput::make('email')
                        ->label('Email Address')
                        ->email()
                        ->required()
                        ->maxLength(150),

                    Forms\Components\TextInput::make('phone')
                        ->label('Phone Number')
                        ->tel()
                        ->required()
                        ->maxLength(20),

                    Forms\Components\Select::make('party_size')
                        ->label('Party Size')
                        ->options(array_combine(range(1, 20), range(1, 20)))
                        ->required()
                        ->default(2),
                ]),

            Forms\Components\Section::make('Booking Details')
                ->columns(2)
                ->schema([
                    Forms\Components\DatePicker::make('date')
                        ->label('Reservation Date')
                        ->required()
                        ->minDate(now()->toDateString()),

                    Forms\Components\TimePicker::make('time')
                        ->label('Preferred Time')
                        ->required()
                        ->seconds(false)
                        ->default('19:00'),

                    Forms\Components\Select::make('status')
                        ->label('Status')
                        ->options([
                            'pending'   => 'Pending',
                            'confirmed' => 'Confirmed',
                            'cancelled' => 'Cancelled',
                        ])
                        ->default('pending')
                        ->required(),

                    Forms\Components\Textarea::make('special_requests')
                        ->label('Special Requests')
                        ->maxLength(500)
                        ->rows(2)
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Guest')
                    ->searchable()
                    ->sortable()
                    ->weight(\Filament\Support\Enums\FontWeight::Bold),

                Tables\Columns\TextColumn::make('party_size')
                    ->label('Guests')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date('D, d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('time')
                    ->label('Time')
                    ->time('H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'confirmed',
                        'danger'  => 'cancelled',
                    ]),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('date', 'asc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending'   => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                    ]),
                Tables\Filters\Filter::make('upcoming')
                    ->label('Upcoming Only')
                    ->query(fn ($query) => $query->where('date', '>=', now()->toDateString()))
                    ->default(),
            ])
            ->actions([
                \Filament\Tables\Actions\Action::make('confirm')
                    ->label('Confirm')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Reservation $record) => $record->status === 'pending')
                    ->action(function (Reservation $record) {
                        $record->update(['status' => 'confirmed']);
                        Notification::make()
                            ->title('Reservation confirmed!')
                            ->success()
                            ->send();
                    }),

                \Filament\Tables\Actions\Action::make('cancel')
                    ->label('Cancel')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (Reservation $record) => $record->status !== 'cancelled')
                    ->requiresConfirmation()
                    ->action(function (Reservation $record) {
                        $record->update(['status' => 'cancelled']);
                        Notification::make()
                            ->title('Reservation cancelled.')
                            ->warning()
                            ->send();
                    }),

                \Filament\Tables\Actions\EditAction::make(),
                \Filament\Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Tables\Actions\BulkActionGroup::make([
                    \Filament\Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservation::route('/create'),
            'edit'   => Pages\EditReservation::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')
            ->where('date', '>=', now()->toDateString())
            ->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
}
