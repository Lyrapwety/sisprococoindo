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
        Schema::create('stok_ampas_kering_yellows', function (Blueprint $table) {
            $table->id();
            $table->string('id_stok_ampas_kering_putih')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('activity_type')->nullable();
            $table->string('begin')->nullable();
            $table->string('in_fine')->nullable();
            $table->string('in_medium')->nullable();
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
        Schema::dropIfExists('stok_ampas_kering_yellows');
    }
};
