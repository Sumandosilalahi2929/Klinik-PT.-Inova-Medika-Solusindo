<?php

namespace App\Filament\Widgets;

use App\Models\Kunjungan;
use Filament\Widgets\ChartWidget;

class TipeKunjunganChart extends ChartWidget
{
    protected static ?string $heading = 'Tipe Kunjungan Terbanyak Bulan Ini';

    protected function getData(): array
    {
        // Mengambil jumlah per tipe kunjungan pada bulan ini
        $data = Kunjungan::whereMonth('tanggal_kunjungan', now()->month)
            ->selectRaw('tipe_kunjungan, COUNT(*) as total')
            ->groupBy('tipe_kunjungan')
            ->orderByDesc('total')
            ->get();

        // Menyusun data untuk chart
        $labels = $data->pluck('tipe_kunjungan')->toArray();
        $counts = $data->pluck('total')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Kunjungan per Tipe',
                    'data' => $counts,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';  // Menggunakan jenis chart bar untuk menampilkan tipe kunjungan terbanyak
    }

    public function getDescription(): ?string
    {
        return 'Menampilkan jumlah kunjungan berdasarkan tipe yang paling banyak di bulan ini.';
    }
}
