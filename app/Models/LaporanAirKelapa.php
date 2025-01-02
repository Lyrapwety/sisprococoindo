<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanAirKelapa extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'laporan_air_kelapas';

    // Define the fillable attributes
    protected $fillable = [
        'id_kelapa_bulat',
        'tanggal',
        'nama_pegawai',
        'sheller_parer',
        'bruto',
        'total_ember',
        'berat_ember',
        'total_potongan_ember',
        'hasil_kerja',
        'timbangan_hasil'
    ];

    // Optionally, you can define the primary key if it's not 'id'
    // protected $primaryKey = 'id';

    // Disable auto-incrementing if necessary
    // public $incrementing = false;

    // If you don't want Laravel to handle timestamps
    // public $timestamps = false;
}
