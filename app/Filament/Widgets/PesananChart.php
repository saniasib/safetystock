<?php

namespace App\Filament\Widgets;

use App\Models\Pesanan; // 1. Import model Pesanan
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class PesananChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Pesanan (7 Hari Terakhir)';

    protected static ?int $sort = 1; // Urutan widget di dashboard

    protected function getType(): string
    {
        // Jenis grafik: 'line', 'bar', 'pie', 'doughnut', 'radar', 'polarArea'
        return 'line';
    }

    protected function getData(): array
    {
        // 2. Logika untuk mengambil data
        $data = Pesanan::query()
            ->where('created_at', '>=', now()->subDays(6)) // Ambil data 7 hari (termasuk hari ini)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->keyBy('date'); // Jadikan tanggal sebagai key untuk memudahkan pencarian

        // 3. Siapkan array untuk label (tanggal) dan data (jumlah pesanan)
        $labels = [];
        $values = [];

        // Loop untuk 7 hari dari sekarang ke belakang
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $formattedDate = Carbon::parse($date)->format('d M'); // Format tanggal untuk label (Contoh: 19 Jul)
            
            // Masukkan label tanggal ke awal array agar urutannya benar
            array_unshift($labels, $formattedDate);
            
            // Masukkan jumlah pesanan ke awal array. Jika tanggal tidak ada di data, nilainya 0.
            array_unshift($values, $data->get($date)->count ?? 0);
        }

        // 4. Kembalikan data dalam format yang dimengerti oleh ChartWidget
        return [
            'datasets' => [
                [
                    'label' => 'Pesanan Dibuat',
                    'data' => $values,
                    'borderColor' => '#36A2EB',
                    'backgroundColor' => '#9BD0F5',
                ],
            ],
            'labels' => $labels,
        ];
    }
}