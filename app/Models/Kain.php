<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Import HasMany untuk relasi

class Kain extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kains'; // Secara default Laravel akan mengasumsikan 'kains'
                               // Tapi lebih baik didefinisikan secara eksplisit.

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_kain',
        'warna_kain',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // Jika ada kolom yang perlu di-cast (misalnya tanggal, boolean), tambahkan di sini.
        // Contoh: 'created_at' => 'datetime', 'updated_at' => 'datetime'
        // Namun, untuk timestamps, Laravel sudah menanganinya secara otomatis.
    ];

    /**
     * Get the BahanBaku associated with the Kain.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bahanBaku(): HasMany
    {
        // Mendefinisikan relasi "one-to-many"
        // Satu Kain bisa memiliki banyak BahanBaku
        // 'kain_id' adalah foreign key di tabel 'bahan_bakus'
        return $this->hasMany(BahanBaku::class, 'kain_id');
    }
}