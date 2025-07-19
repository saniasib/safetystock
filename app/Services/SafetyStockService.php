<?php

namespace App\Services;

use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class SafetyStockService
{
    /**
     * Menghasilkan laporan gabungan untuk SEMUA produk dalam rentang tanggal.
     */
    public function generateCombinedReport(string $startDate, string $endDate): array
    {
        $allProducts = Produk::all();
        $reportResults = [];

        foreach ($allProducts as $produk) {
            // Panggil metode privat untuk menghitung per produk
            $reportResults[] = $this->calculateForSingleProduct($produk, $startDate, $endDate);
        }

        return $reportResults;
    }

    /**
     * Logika perhitungan untuk satu produk (dipindahkan ke sini).
     */
    private function calculateForSingleProduct(Produk $produk, string $startDate, string $endDate): array
    {
        // === 1. Data Penjualan ===
        $penjualanHarian = DB::table('pesanans')
            ->where('produk_id', $produk->id)
            ->whereBetween('tgl_pesanan', [$startDate, $endDate])
            ->get();

        // === 2. Data Lead Time ===
        $leadTimeHistory = DB::table('pengiriman_bahans')
            ->where('produk_id', $produk->id)
            ->get();

        // Jika tidak ada data penjualan ATAU pengiriman, beri status error
        if ($penjualanHarian->isEmpty() || $leadTimeHistory->isEmpty()) {
            return [
                'produk_id' => $produk->id,
                'produk_nama' => $produk->nama_produk,
                'status' => 'Data Tidak Lengkap',
                'Dmax' => 0, 'Davg' => 0, 'Lmax' => 0, 'Lavg' => 0, 'safety_stock' => 0, 'rop' => 0,
            ];
        }

        $Dmax = $penjualanHarian->max('jumlah');
        $Davg = $penjualanHarian->average('jumlah');
        $Lmax = $leadTimeHistory->max('lead_time_aktual_hari');
        $Lavg = $leadTimeHistory->average('lead_time_aktual_hari');
        
        $safetyStock = ($Dmax * $Lmax) - ($Davg * $Lavg);
        $safetyStock = max(0, round($safetyStock));

        $rop = ($Davg * $produk->lead_time_hari) + $safetyStock;
        $rop = round($rop);

        return [
            'produk_id' => $produk->id,
            'produk_nama' => $produk->nama_produk,
            'status' => 'OK',
            'Dmax' => (float) $Dmax,
            'Davg' => (float) round($Davg, 2),
            'Lmax' => (float) $Lmax,
            'Lavg' => (float) round($Lavg, 2),
            'safety_stock' => (int) $safetyStock,
            'rop' => (int) $rop,
        ];
    }
}