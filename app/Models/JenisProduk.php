<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisProduk extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function produks(): HasMany
    {
        return $this->hasMany(Produk::class, 'jenis_produk_id');
    }
}
