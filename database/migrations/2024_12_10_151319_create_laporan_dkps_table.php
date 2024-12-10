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
        Schema::create('laporan_dkps', function (Blueprint $table) {
            $table->id();
            $table->string('id_kelapa_bulat');
            $table->string('no');
            $table->string('tanggal');
            $table->string('nama_sheller');
            $table->string('nama_parer');
            $table->string('hasil_kerja_parer');
            $table->string('hasil_kerja_sheller');
            $table->string('total_keranjang');
            $table->string('tipe_keranjang');
            $table->string('berat_keranjang');
            $table->string('total_potongan_keranjang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_dkps');
    }
};
