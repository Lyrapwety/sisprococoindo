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
        Schema::create('stok_santans', function (Blueprint $table) {
            $table->id();
            $table->string('id_laporan_dkp')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('making_product')->nullable();
            $table->string('activity_type')->nullable();
            $table->string('jenis_berat')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('fat')->nullable();
            $table->string('ph')->nullable();
            $table->string('begin')->nullable();
            $table->string('in_bags')->nullable();
            $table->string('in_box')->nullable();
            $table->string('out')->nullable();
            $table->string('remain')->nullable();
            $table->string('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_santans');
    }
};
