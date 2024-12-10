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
        Schema::create('laporan_tempurung_basahs', function (Blueprint $table) {
            $table->id();
            $table->string('id_kelapa_bulat');
            $table->string('no');
            $table->string('tanggal');
            $table->string('bruto');
            $table->string('tipe_keranjang');
            $table->string('total_keranjang');
            $table->string('total_potongan_keranjang');
            $table->string('netto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_tempurung_basahs');
    }
};
