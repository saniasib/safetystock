<?php

namespace App\Models;
use App\Services\SafetyStockService; // <-- Tambahkan ini
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log; // <-- Tambahkan ini

class Pesanan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'tgl_pesanan' => 'date',
            'tgl_awal' => 'date',
            'tgl_akhir' => 'date',
        ];
    }
    // protected static function booted(): void
    // {
    //     // Setiap kali sebuah pesanan BARU DIBUAT (created)...
    //     static::created(function (Pesanan $pesanan) {
    //         // Ambil produk yang terkait dengan pesanan ini
    //         $produk = $pesanan->produk;

    //         if ($produk) {
    //             // Panggil service untuk melakukan perhitungan
    //             $service = new SafetyStockService();
    //             $hasil = $service->calculateForProduct($produk);

    //             // Simpan atau perbarui hasilnya di tabel safety_stocks
    //             SafetyStock::updateOrCreate(
    //                 ['produk_id' => $produk->id],
    //                 [
    //                     'jumlah_safety_stock' => $hasil,
    //                     'dihitung_pada' => now()
    //                 ]
    //             );

    //             // (Opsional) Tambahkan log untuk debugging
    //             Log::info("Safety stock dihitung ulang untuk produk #{$produk->id}. Hasil: {$hasil}");
    //         }
    //     });
    // }
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
