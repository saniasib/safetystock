<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Produk; // <--- TAMBAHKAN BARIS INI

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::create('stoks', function (Blueprint $table) {
            $table->id(); // Sesuai dengan id_stok [cite: 174]
            $table->foreignIdFor(Produk::class, 'produk_id')->unique()->constrained('produks'); // Produk terkait [cite: 196]
            $table->integer('jumlah'); // [cite: 176]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stoks');
    }
};
