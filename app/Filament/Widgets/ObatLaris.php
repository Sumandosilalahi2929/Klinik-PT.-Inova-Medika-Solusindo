<?php

namespace App\Filament\Widgets;

use DB;
use Filament\Tables;
use App\Models\Obat_pasien;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;

class ObatLaris extends BaseWidget
{
    public function getTableRecordKey($record): string
    {
        // Pastikan kunci unik ada, misalnya menggunakan 'obat_obatans_id' atau ID lainnya
        return (string) $record->obat_obatans_id;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Obat_pasien::whereMonth('tanggal_mulai', now()->month)
                ->whereYear('tanggal_mulai', now()->year)
                ->select('obat_obatans_id', DB::raw('count(*) as total'))
                ->groupBy('obat_obatans_id')
                ->orderByDesc('total')
                ->limit(5))  // Ambil 5 obat terlaris
            ->columns([
                TextColumn::make('obat_obatan.nama')
                    ->label('Nama Obat')
                    ->sortable(),
                TextColumn::make('total')
                    ->label('Jumlah/bulan')
                    ->sortable()
                    ->formatStateUsing(fn($state) => number_format($state, 0, ',', '.')),  // Format angka
            ]);
    }
}
