<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\JenisLaporan; // <--- TAMBAHKAN BARIS INI

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id(); // Sesuai dengan id_laporan [cite: 259]
            $table->foreignIdFor(JenisLaporan::class, 'jenis_laporan_id')->constrained('jenis_laporans'); // [cite: 260]
            $table->string('nama_laporan'); // [cite: 261]
            $table->date('tanggal_cetak'); // [cite: 288, 289]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
