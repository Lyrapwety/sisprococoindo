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
        Schema::create('laporan_kulit_ari_basahs', function (Blueprint $table) {
            $table->id();
            $table->string('id_kelapa_bulat');
            $table->string('no');
            $table->date('tanggal');
            $table->string('sheller_parer');
            $table->string('bruto');
            $table->string('total_keranjang');
            $table->string('tipe_keranjang');
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
        Schema::dropIfExists('laporan_kulit_ari_basahs');
    }
};
