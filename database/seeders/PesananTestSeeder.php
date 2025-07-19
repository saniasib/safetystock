<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{Produk, Pesanan};

class PesananTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produk = Produk::where('nama_produk', 'Baju Anak Lengan Panjang')->first();

        if ($produk) {
            // Skenario 5: Pesanan masuk 50 unit
            Pesanan::create(['produk_id' => $produk->id, 'jumlah' => 50, 'tgl_pesanan' => '2025-07-01', 'tgl_awal' => '2025-07-01', 'tgl_akhir' => '2025-07-05', 'nama_pemesan' => 'Bu Ani', 'alamat' => 'Jl. Anggrek', 'no_tlphn' => '08123']);

            // Data tambahan untuk menguji perhitungan Dmax dan Davg
            Pesanan::create(['produk_id' => $produk->id, 'jumlah' => 30, 'tgl_pesanan' => '2025-07-02', 'tgl_awal' => '2025-07-02', 'tgl_akhir' => '2025-07-06', 'nama_pemesan' => 'Pak Budi', 'alamat' => 'Jl. Mawar', 'no_tlphn' => '08124']);
            Pesanan::create(['produk_id' => $produk->id, 'jumlah' => 60, 'tgl_pesanan' => '2025-07-03', 'tgl_awal' => '2025-07-03', 'tgl_akhir' => '2025-07-07', 'nama_pemesan' => 'Toko Ceria', 'alamat' => 'Jl. Melati', 'no_tlphn' => '08125']);
        }
    }
}
