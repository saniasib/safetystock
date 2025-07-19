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
        Schema::create('benangs', function (Blueprint $table) {
            $table->id(); // Sesuai dengan id_benang [cite: 153]
            $table->string('nama_benang'); // [cite: 154]
            $table->string('warna_benang'); // [cite: 155]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('benangs');
    }
};
