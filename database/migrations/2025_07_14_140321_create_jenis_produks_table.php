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
        Schema::create('jenis_produks', function (Blueprint $table) {
             $table->id(); // Sesuai dengan id_jenis [cite: 75]
            $table->string('jenis_produk'); // [cite: 76]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_produks');
    }
};
