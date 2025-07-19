<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PengirimanBahan extends Model
{
    use HasFactory;

    /**
     * Mass-assignment protection.
     * $guarded adalah kebalikan dari $fillable.
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast.
     * Mengubah kolom tanggal menjadi objek Carbon secara otomatis.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tanggal_pemesanan' => 'date',
            'tanggal_penerimaan' => 'date',
        ];
    }

    /**
     * Mendefinisikan relasi "belongsTo" ke model Produk.
     * Setiap catatan pengiriman bahan dimiliki oleh satu produk.
     */
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}