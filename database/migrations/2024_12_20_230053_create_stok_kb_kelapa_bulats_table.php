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
        Schema::create('stok_kb_kelapa_bulats', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal')->nullable();
            $table->string('remark')->nullable();
            $table->string('activity_type')->nullable();
            $table->string('stok')->nullable();
            $table->string('trip')->nullable();
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
        Schema::dropIfExists('stok_kb_kelapa_bulats');
    }
};
