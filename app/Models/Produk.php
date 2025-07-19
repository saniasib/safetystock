<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Produk extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function jenisProduk(): BelongsTo
    {
        return $this->belongsTo(JenisProduk::class, 'jenis_produk_id');
    }
    
    public function stok(): HasOne
    {
        return $this->hasOne(Stok::class, 'produk_id');
    }

    public function pesanans(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'produk_id');
    }

    public function safetyStock(): HasOne
    {
        return $this->hasOne(SafetyStock::class, 'produk_id');
    }
}
