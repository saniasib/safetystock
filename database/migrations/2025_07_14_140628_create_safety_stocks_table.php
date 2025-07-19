<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('safety_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_laporan');
            
            // Relasi ke tabel users dan produks
            $table->foreignId('user_id')->constrained('users');
            // $table->foreignId('produk_id')->constrained('produks');

            // Parameter laporan
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');

            // Hasil perhitungan akan disimpan di sini dalam format JSON
            $table->json('hasil_perhitungan');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('safety_stocks');
    }
};