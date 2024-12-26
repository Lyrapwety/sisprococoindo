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
        Schema::create('stok_air_kelapas', function (Blueprint $table) {
            $table->id();
            $table->string('id_laporan_air_kelapa')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('making_product')->nullable();
            $table->string('activity_type')->nullable();
            $table->string('jenis_berat')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('briz')->nullable();
            $table->decimal('ph', 5, 2)->nullable();
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
        Schema::dropIfExists('stok_air_kelapas');
    }
};
