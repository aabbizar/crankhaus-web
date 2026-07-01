<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Models\Menu;
use Filament\Schemas\Components\Section;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = 'Menu Makanan';

    protected static ?string $modelLabel = 'Menu';

    protected static ?string $pluralModelLabel = 'Daftar Menu';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Menu')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Menu')
                            ->required()
                            ->maxLength(255)
                            ->live(debounce: 500)
                            ->afterStateUpdated(function (string $state, $set) {
                                $set('slug', Str::slug($state));
                            }),

                        TextInput::make('slug')
                            ->label('Slug (auto)')
                            ->required()
                            ->unique(Menu::class, 'slug', ignoreRecord: true)
                            ->maxLength(255),

                        Select::make('category')
                            ->label('Kategori')
                            ->options([
                                'Makanan Utama' => '🍜 Makanan Utama',
                                'Cemilan'       => '🥟 Cemilan',
                                'Minuman'       => '🥤 Minuman',
                            ])
                            ->required()
                            ->native(false),

                        TextInput::make('price')
                            ->label('Harga (Rp)')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->prefix('Rp')
                            ->step(1000),

                        Toggle::make('is_available')
                            ->label('Tersedia / Aktif')
                            ->default(true)
                            ->inline(false),
                    ])
                    ->columns(2),

                Section::make('Konten')
                    ->schema([
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),

                        FileUpload::make('image_url')
                            ->label('Foto Menu')
                            ->image()
                            ->directory('menu-images')
                            ->maxSize(2048)
                            ->columnSpanFull()
                            ->helperText('Upload foto makanan atau minuman. Maksimal 2MB.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_url')
                    ->label('Foto')
                    ->width(64)
                    ->height(64)
                    ->defaultImageUrl('https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=200&auto=format&fit=crop')
                    ->extraImgAttributes(['class' => 'rounded-xl object-cover']),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Menu')
                    ->searchable()
                    ->sortable()
                    ->weight(\Filament\Support\Enums\FontWeight::SemiBold),

                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->label('Kategori')
                    ->color(fn (string $state): string => match ($state) {
                        'Makanan Utama' => 'warning',
                        'Cemilan'       => 'success',
                        'Minuman'       => 'info',
                        default         => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_available')
                    ->label('Tersedia')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'Makanan Utama' => 'Makanan Utama',
                        'Cemilan'       => 'Cemilan',
                        'Minuman'       => 'Minuman',
                    ]),

                Tables\Filters\TernaryFilter::make('is_available')
                    ->label('Status Ketersediaan')
                    ->trueLabel('Tersedia')
                    ->falseLabel('Tidak Tersedia')
                    ->native(false),
            ])
            ->actions([
                EditAction::make(),
                \Filament\Actions\Action::make('toggle_availability')
                    ->label(fn (Menu $record) => $record->is_available ? 'Nonaktifkan' : 'Aktifkan')
                    ->icon(fn (Menu $record) => $record->is_available ? 'heroicon-o-eye-slash' : 'heroicon-o-eye')
                    ->color(fn (Menu $record) => $record->is_available ? 'warning' : 'success')
                    ->requiresConfirmation()
                    ->action(fn (Menu $record) => $record->update(['is_available' => ! $record->is_available])),
                DeleteAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('category')
            ->striped();
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit'   => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
