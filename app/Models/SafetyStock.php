<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SafetyStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_laporan',
        'user_id',
        // 'produk_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'hasil_perhitungan',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'hasil_perhitungan' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class);
    }
}