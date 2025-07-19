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
        Schema::create('kains', function (Blueprint $table) {
            $table->id(); // Sesuai dengan id_kain [cite: 124]
            $table->string('nama_kain'); // [cite: 125]
            $table->string('warna_kain'); // [cite: 126]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kains');
    }
};
