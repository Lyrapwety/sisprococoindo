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
            $table->string('id_kelapa_bulat')->nullable();
            $table->string('no')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('nama_pegawai')->nullable();
            $table->string('sheller_parer')->nullable();
            $table->string('bruto')->nullable();
            $table->string('total_keranjang')->nullable();
            $table->string('tipe_keranjang')->nullable();
            $table->string('berat_keranjang')->nullable();
            $table->string('total_potongan_keranjang')->nullable();
            $table->decimal('timbangan_hasil', 10, 2)->default(0);
            $table->json('hasil_kerja')->nullable();
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
