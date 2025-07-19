<?php

namespace App\Filament\Resources\PesananResource\Pages;

use App\Filament\Resources\PesananResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model; // Pastikan ini di-import
use App\Models\Produk; // Import model Produk
class CreatePesanan extends CreateRecord
{
    protected static string $resource = PesananResource::class;
    protected function afterCreate(): void
    {
        // $this->record berisi data pesanan yang baru saja dibuat
        $pesanan = $this->record;

        // Cari produk yang terkait dengan pesanan ini
        $produk = Produk::find($pesanan->produk_id);

        // Pastikan produk dan relasi stoknya ada
        if ($produk && $produk->stok) {
            // Kurangi jumlah stok berdasarkan jumlah pesanan
            // Menggunakan decrement lebih aman untuk operasi database
            $produk->stok->decrement('jumlah', $pesanan->jumlah);
        }
    }
}
