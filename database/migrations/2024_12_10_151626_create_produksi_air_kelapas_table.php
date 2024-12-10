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
        Schema::create('produksi_air_kelapas', function (Blueprint $table) {
            $table->id();
            $table->string('id_air_kelapa')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('briz')->nullable();
            $table->string('ph')->nullable();
            $table->string('sn')->nullable();
            $table->string('bags')->nullable();
            $table->string('begin')->nullable();
            $table->string('in')->nullable();
            $table->string('out')->nullable();
            $table->string('remain')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produksi_air_kelapas');
    }
};
