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
            $table->string('id_laporan_air_kelapa');
            $table->string('tanggal');
            $table->string('keterangan');
            $table->string('making_product');
            $table->string('activity_type');
            $table->string('begin');
            $table->string('in');
            $table->string('out');
            $table->string('remain');
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