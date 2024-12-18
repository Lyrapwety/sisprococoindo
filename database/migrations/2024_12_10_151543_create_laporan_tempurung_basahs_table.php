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
            $table->string('id_kelapa_bulat')->nullable();
            $table->string('no')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('bruto')->nullable();
            $table->string('tipe_keranjang')->nullable();
            $table->string('total_keranjang')->nullable();
            $table->string('total_potongan_keranjang')->nullable();
            $table->json('netto')->nullable();
            $table->decimal('timbangan_netto', 10, 2)->default(0);
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
