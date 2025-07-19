<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Laporan extends Model {
    protected $guarded = ['id'];
    protected function casts(): array {
        return ['tanggal_cetak' => 'date'];
    }
    public function jenisLaporan(): BelongsTo {
        return $this->belongsTo(JenisLaporan::class, 'jenis_laporan_id');
    }
}