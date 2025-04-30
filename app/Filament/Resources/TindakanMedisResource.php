<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TindakanMedisResource\Pages;
use App\Models\Tindakan_medis;
use App\Models\Data_pasien;
use App\Models\Kunjungan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TindakanMedisResource extends Resource
{
    protected static ?string $model = Tindakan_medis::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationLabel = 'Tindakan Medis';
    protected static ?string $pluralLabel = 'Tindakan Medis';
    protected static ?string $modelLabel = 'Tindakan';
    protected static ?string $slug = 'tindakan-medis';
    protected static ?int $navigationSort = 25;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('data_pasiens_id')
                    ->label('Nama Pasien')
                    ->options(Data_pasien::pluck('nama', 'id'))
                    ->searchable()
                    ->required()
                    ->reactive(), // ← Ini penting agar kunjungan bisa bereaksi

                Forms\Components\Select::make('kunjungans_id')
                    ->label('Tanggal Kunjungan')
                    ->options(function ($get) {
                        $pasienId = $get('data_pasiens_id');
                        return $pasienId
                            ? Kunjungan::where('data_pasiens_id', $pasienId)->pluck('tanggal_kunjungan', 'id')
                            : [];
                    })
                    ->required(),

                Forms\Components\TextInput::make('name_actions')
                    ->label('Tindakan')
                    ->required(),

                Forms\Components\TextInput::make('price')
                    ->label('Harga')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pasien.nama')
                    ->label('Nama Pasien')
                    ->searchable(),

                Tables\Columns\TextColumn::make('kunjungan.tanggal_kunjungan')
                    ->label('Tanggal Kunjungan')
                    ->date(),

                Tables\Columns\TextColumn::make('name_actions')
                    ->label('Tindakan Medis'),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR', true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('data_pasiens_id')
                    ->label('Filter Pasien')
                    ->options(Data_pasien::pluck('nama', 'id')),

                Tables\Filters\SelectFilter::make('kunjungans_id')
                    ->label('Filter Tanggal Kunjungan')
                    ->options(Kunjungan::pluck('tanggal_kunjungan', 'id')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function canAccess(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'dokter']);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTindakanMedis::route('/'),
            'create' => Pages\CreateTindakanMedis::route('/create'),
            'edit' => Pages\EditTindakanMedis::route('/{record}/edit'),
        ];
    }
}
