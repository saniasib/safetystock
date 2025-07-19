<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\JenisProduk; // <--- TAMBAHKAN BARIS INI

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id(); // Sesuai dengan id_produk [cite: 41]
            $table->string('nama_produk'); // [cite: 42]
            $table->integer('lead_time_hari'); // [cite: 43]
            // Relasi ke Jenis_produk [cite: 66]
            $table->foreignIdFor(JenisProduk::class, 'jenis_produk_id')->constrained('jenis_produks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
