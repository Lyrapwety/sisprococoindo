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
            $table->string('id_kelapa_bulat')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('nama_pegawai')->nullable();
            $table->string('sheller_parer')->nullable();
            $table->string('bruto')->nullable();
            $table->string('total_keranjang')->nullable();
            $table->string('tipe_keranjnag')->nullable();
            $table->string('berat_keranjang')->nullable();
            $table->string('total_potongan_keranjang')->nullable();
            $table->string('hasil_kerja')->nullable();
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
