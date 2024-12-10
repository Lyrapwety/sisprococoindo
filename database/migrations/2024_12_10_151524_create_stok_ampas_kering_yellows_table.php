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
            $table->string('id_stok_ampas_kering_putih');
            $table->string('tanggal');
            $table->string('keterangan');
            $table->string('activity_type');
            $table->string('begin');
            $table->string('in_fine');
            $table->string('in_medium');
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
        Schema::dropIfExists('stok_ampas_kering_yellows');
    }
};
