<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisLaporan;

class LaporanTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Skenario 10
        JenisLaporan::firstOrCreate(['nama_jenislaporan' => 'Stok']);
        JenisLaporan::firstOrCreate(['nama_jenislaporan' => 'Pesanan']);
    }
}
