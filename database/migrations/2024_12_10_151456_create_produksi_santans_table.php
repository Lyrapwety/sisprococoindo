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
        Schema::create('produksi_santans', function (Blueprint $table) {
            $table->id();
            $table->string('id_santan');
            $table->string('tanggal');
            $table->string('keterangan');
            $table->string('activity_type');
            $table->string('briz');
            $table->string('bags');
            $table->string('ph');
            $table->string('steril_nonsteril');
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
        Schema::dropIfExists('produksi_santans');
    }
};
