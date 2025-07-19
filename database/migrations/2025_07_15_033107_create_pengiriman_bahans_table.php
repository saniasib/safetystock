<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Produk;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengiriman_bahans', function (Blueprint $table) {
            $table->id();
            // Bahan ini untuk produk mana?
            $table->foreignIdFor(Produk::class)->constrained();
            $table->date('tanggal_pemesanan');
            $table->date('tanggal_penerimaan');
            $table->integer('lead_time_aktual_hari')->storedAs('DATEDIFF(tanggal_penerimaan, tanggal_pemesanan)');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengiriman_bahans');
    }
};
