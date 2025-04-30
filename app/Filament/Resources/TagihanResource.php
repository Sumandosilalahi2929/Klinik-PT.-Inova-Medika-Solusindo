<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TagihanResource\Pages;
use App\Models\Data_pasien;
use App\Models\Kunjungan;
use App\Models\Tindakan_medis;
use App\Models\Obat_pasien;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TagihanResource extends Resource
{
    protected static ?string $model = Kunjungan::class;
    protected static ?string $navigationIcon = 'heroicon-o-receipt-percent';
    protected static ?string $navigationLabel = 'Tagihan Pasien';

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('data_pasien.nama')
                    ->label('Nama Pasien'),

                Tables\Columns\TextColumn::make('tanggal_kunjungan')
                    ->label('Tanggal Kunjungan')
                    ->dateTime('d M Y H:i'),

                Tables\Columns\TextColumn::make('total_tindakan')
                    ->label('Harga tindakan medis')
                    ->money('IDR', true)
                    ->getStateUsing(function ($record) {
                        return Tindakan_medis::where('kunjungans_id', $record->id)->sum('price');
                    }),

                Tables\Columns\TextColumn::make('total_obat')
                    ->label('Harga')
                    ->money('IDR', true)
                    ->getStateUsing(function ($record) {
                        return Obat_pasien::where('kunjungans_id', $record->id)
                            ->join('obat_obatans', 'obat_obatans.id', '=', 'obat_obatans_id')
                            ->sum('obat_obatans.harga');
                    }),

                Tables\Columns\TextColumn::make('total_semua')
                    ->label('Total Tagihan')
                    ->money('IDR', true)
                    ->getStateUsing(function ($record) {
                        $tindakan = Tindakan_medis::where('kunjungans_id', $record->id)->sum('price');
                        $obat = Obat_pasien::where('kunjungans_id', $record->id)
                            ->join('obat_obatans', 'obat_obatans.id', '=', 'obat_obatans_id')
                            ->sum('obat_obatans.harga');
                        return $tindakan + $obat;
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('data_pasiens_id')
                    ->label('Filter Pasien')
                    ->options(Data_pasien::pluck('nama', 'id')),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTagihans::route('/'),
        ];
    }
}
