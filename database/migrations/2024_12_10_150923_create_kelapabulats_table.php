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
        Schema::create('kelapabulats', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('shift')->nullable();
            $table->string('stop')->nullable();
            $table->string('keranjang')->nullable();
            $table->string( 'kbtanggalsupplier')->nullable();
            $table->string( 'jam')->nullable();
            $table->string( 'qty')->nullable();
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
        Schema::dropIfExists('kelapabulats');
    }
};
