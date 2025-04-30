<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ObatObatanResource\Pages;
use App\Models\Obat_obatan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ObatObatanResource extends Resource
{
    protected static ?string $model = Obat_obatan::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Manajemen Obat';
    protected static ?string $pluralLabel = 'Obat-Obatan';
    protected static ?string $modelLabel = 'Obat';
    protected static ?string $slug = 'obat';
    protected static ?int $navigationSort = 30;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Obat')
                    ->required(),

                Forms\Components\TextInput::make('kode_obat')
                    ->label('Kode Obat')
                    ->unique()
                    ->required(),

                Forms\Components\TextArea::make('deskripsi')
                    ->label('Deskripsi Obat'),

                Forms\Components\TextInput::make('harga')
                    ->label('Harga')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('stok')
                    ->label('Stok')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Obat')
                    ->searchable(),

                Tables\Columns\TextColumn::make('kode_obat')
                    ->label('Kode Obat')
                    ->searchable(),

                Tables\Columns\TextColumn::make('harga')
                    ->label('Harga')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('stok')
                    ->label('Stok')
                    ->sortable(),
            ])
            ->filters([
                // Filters can be added if needed
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Relations to Obat_pasien, if needed
        ];
    }


    public static function canAccess(): bool
    {
        return auth()->user()->hasAnyRole(['admin']);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListObatObatans::route('/'),
            'create' => Pages\CreateObatObatan::route('/create'),
            'edit' => Pages\EditObatObatan::route('/{record}/edit'),
        ];
    }
}
