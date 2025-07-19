<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BahanBaku extends Model
{
    protected $guarded = ['id'];

    public function kain(): BelongsTo
    {
        return $this->belongsTo(Kain::class, 'kain_id');
    }

    public function benang(): BelongsTo
    {
        return $this->belongsTo(Benang::class, 'benang_id');
    }
}