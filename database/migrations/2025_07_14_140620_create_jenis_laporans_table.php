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
         Schema::create('jenis_laporans', function (Blueprint $table) {
            $table->id(); // Sesuai dengan id_jenislaporan [cite: 268]
            $table->string('nama_jenislaporan'); // [cite: 269]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_laporans');
    }
};
