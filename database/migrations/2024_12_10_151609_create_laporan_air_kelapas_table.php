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
        Schema::create('laporan_air_kelapas', function (Blueprint $table) {
            $table->id();
            $table->string('id_kelapa_bulat');
            $table->string('tanggal');
            $table->string('nama_pegawai');
            $table->string('sheller_parer');
            $table->string('bruto');
            $table->string('total_keranjang');
            $table->string('tipe_keranjnag');
            $table->string('berat_keranjang');
            $table->string('total_potongan_keranjang');
            $table->string('hasil_kerja');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_air_kelapas');
    }
};
