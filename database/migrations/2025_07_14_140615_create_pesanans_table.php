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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id(); // Sesuai dengan id_pesanan [cite: 207]
            $table->foreignIdFor(Produk::class, 'produk_id')->constrained('produks'); // Produk yang dipesan [cite: 232]
            $table->integer('jumlah'); // [cite: 209]
            $table->date('tgl_pesanan'); // [cite: 210]
            $table->date('tgl_awal'); // [cite: 211]
            $table->date('tgl_akhir'); // [cite: 212]
            $table->string('nama_pemesan'); // [cite: 213]
            $table->text('alamat'); // [cite: 214]
            $table->string('no_tlphn'); // [cite: 215]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
