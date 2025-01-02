<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('laporan_dkp_reject_basahs', function (Blueprint $table) {
            $table->string('detail_hasil_kerja')->nullable()->after('hasil_kerja_netto');
        });
    }
    
    public function down()
    {
        Schema::table('laporan_dkp_reject_basahs', function (Blueprint $table) {
            $table->dropColumn('detail_hasil_kerja');
        });
    }
};
