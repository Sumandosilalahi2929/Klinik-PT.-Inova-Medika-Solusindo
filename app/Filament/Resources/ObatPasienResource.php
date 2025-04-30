<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ObatPasienResource\Pages;
use App\Models\Obat_pasien;
use App\Models\Kunjungan;
use App\Models\Obat_obatan;
use App\Models\Data_pasien;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ObatPasienResource extends Resource
{
    protected static ?string $model = Obat_pasien::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('data_pasiens_id')
                    ->label('Data Pasien')
                    ->options(Data_pasien::all()->pluck('nama', 'id'))
                    ->required()
                    ->reactive(),

                Forms\Components\Select::make('kunjungans_id')
                    ->label('Tanggal Kunjungan')
                    ->nullable()
                    ->options(function (callable $get) {
                        $dataPasienId = $get('data_pasiens_id');

                        if (!$dataPasienId) {
                            return [];
                        }

                        return Kunjungan::where('data_pasiens_id', $dataPasienId)
                            ->pluck('tanggal_kunjungan', 'id')
                            ->toArray();
                    }),

                Forms\Components\Select::make('obat_obatans_id')
                    ->label('Obat Obatan')
                    ->options(Obat_obatan::all()->pluck('nama', 'id'))
                    ->required(),

                Forms\Components\TextInput::make('dosis')
                    ->label('Dosis')
                    ->required(),

                Forms\Components\DatePicker::make('tanggal_mulai')
                    ->label('Tanggal Mulai')
                    ->required(),

                Forms\Components\DatePicker::make('tanggal_selesai')
                    ->label('Tanggal Selesai')
                    ->required(),

                Forms\Components\TextInput::make('catatan')
                    ->label('Catatan')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('data_pasien.nama')
                    ->label('Nama Pasien')
                    ->sortable(),

                Tables\Columns\TextColumn::make('kunjungan.tanggal_kunjungan')
                    ->label('Tanggal Kunjungan')
                    ->sortable(),

                Tables\Columns\TextColumn::make('obat_obatan.nama')
                    ->label('Nama Obat')
                    ->sortable(),

                Tables\Columns\TextColumn::make('obat_obatan.harga')
                    ->label('Harga Obat')
                    ->money('IDR', true)
                    ->sortable(),

                Tables\Columns\TextColumn::make('dosis')
                    ->label('Dosis'),

                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->label('Tanggal Mulai')
                    ->sortable(),

                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->label('Tanggal Selesai')
                    ->sortable(),

                Tables\Columns\TextColumn::make('catatan')
                    ->label('Catatan'),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
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
            // Tambahkan relasi jika diperlukan
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListObatPasiens::route('/'),
            'create' => Pages\CreateObatPasien::route('/create'),
            'edit' => Pages\EditObatPasien::route('/{record}/edit'),
        ];
    }
}
