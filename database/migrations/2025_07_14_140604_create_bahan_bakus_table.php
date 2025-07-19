<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Kain; // <--- TAMBAHKAN BARIS INI
use App\Models\Benang; // <--- TAMBAHKAN BARIS INI

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bahan_bakus', function (Blueprint $table) {
            $table->id(); // Sesuai dengan id_bahanbaku [cite: 99]
            $table->foreignIdFor(Kain::class, 'kain_id')->constrained('kains'); // FK ke Kain [cite: 117]
            $table->foreignIdFor(Benang::class, 'benang_id')->constrained('benangs'); // FK ke Benang [cite: 118]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahan_bakus');
    }
};
