<?php

namespace App\Filament\Widgets;

use App\Models\Kunjungan;
use Illuminate\Support\Carbon;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {

        $currentMonthKunjungan = Kunjungan::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();


        $previousMonthKunjungan = Kunjungan::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();


        $kunjunganStatus = ($currentMonthKunjungan > $previousMonthKunjungan)
            ? "Terdapat penambahan kunjungan bulan ini"
            : "Terdapat pengurangan kunjungan bulan ini";

        return [
            Stat::make('Jumlah Kunjungan Pasien Bulan Ini', $currentMonthKunjungan),
            Stat::make('Jumlah Kunjungan Pasien Bulan Lalu', $previousMonthKunjungan),
            Stat::make('Status Perubahan Kunjungan', $kunjunganStatus),
        ];
    }
}
