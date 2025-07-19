<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{JenisProduk, Produk, Stok, PengirimanBahan};

class ProdukTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Skenario 2: Admin menambahkan produk baru "Baju Anak"
        $jenisProduk = JenisProduk::firstOrCreate(['jenis_produk' => 'Baju Anak']);

        $produk = Produk::firstOrCreate(
            ['nama_produk' => 'Baju Anak Lengan Panjang'],
            [
                'jenis_produk_id' => $jenisProduk->id,
                'lead_time_hari' => 3 // Skenario 7
            ]
        );
        
        // Skenario 4: Admin mengisi stok produk 50 unit
        Stok::updateOrCreate(
            ['produk_id' => $produk->id],
            ['jumlah' => 50]
        );
        
        // Data tambahan untuk menguji perhitungan Lmax dan Lavg
        PengirimanBahan::firstOrCreate(['produk_id' => $produk->id, 'tanggal_pemesanan' => '2025-06-01', 'tanggal_penerimaan' => '2025-06-04']); // Lead time: 3 hari
        PengirimanBahan::firstOrCreate(['produk_id' => $produk->id, 'tanggal_pemesanan' => '2025-06-10', 'tanggal_penerimaan' => '2025-06-15']); // Lead time: 5 hari
        PengirimanBahan::firstOrCreate(['produk_id' => $produk->id, 'tanggal_pemesanan' => '2025-06-20', 'tanggal_penerimaan' => '2025-06-23']); // Lead time: 3 hari
    }
}
