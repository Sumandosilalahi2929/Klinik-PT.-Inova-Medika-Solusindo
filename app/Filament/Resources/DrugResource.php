<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DrugResource\Pages;
use App\Models\Drug;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DrugResource extends Resource
{
    protected static ?string $model = Drug::class;
    protected static ?string $navigationLabel = 'Nama Obat';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Menambahkan kontrol hak akses SRBAC
    public static function canViewAny(): bool
    {
        return auth()->user()->role === 'admin' || auth()->user()->role === 'apotek';
    }

    public static function canCreate(): bool
    {
        return auth()->user()->role === 'admin' || auth()->user()->role === 'apotek';
    }
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->role === 'admin' || auth()->user()->role === 'apotek';
    }


    public static function canEdit($record): bool
    {
        return auth()->user()->role === 'admin' || auth()->user()->role === 'apotek';
    }

    public static function canDelete($record): bool
    {
        return auth()->user()->role === 'admin';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name_drugs')
                    ->label('Nama Obat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('type_drugs')
                    ->label('Jenis Obat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->label('Harga')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name_drugs')
                    ->label('Nama Obat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type_drugs')
                    ->label('Jenis Obat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Filter opsional jika diperlukan
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
            // Jika ada relasi, tambahkan di sini
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDrugs::route('/'),
            'create' => Pages\CreateDrug::route('/create'),
            'edit' => Pages\EditDrug::route('/{record}/edit'),
        ];
    }
}
