<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Import HasMany untuk relasi

class Benang extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'benangs'; // Secara default Laravel akan mengasumsikan 'benangs'
                                // Tapi lebih baik didefinisikan secara eksplisit.

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_benang',
        'warna_benang',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // Jika ada kolom yang perlu di-cast (misalnya tanggal, boolean), tambahkan di sini.
        // Untuk timestamps, Laravel sudah menanganinya secara otomatis.
    ];

    /**
     * Get the BahanBaku associated with the Benang.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bahanBaku(): HasMany
    {
        // Mendefinisikan relasi "one-to-many"
        // Satu Benang bisa memiliki banyak BahanBaku
        // 'benang_id' adalah foreign key di tabel 'bahan_bakus'
        return $this->hasMany(BahanBaku::class, 'benang_id');
    }
}

