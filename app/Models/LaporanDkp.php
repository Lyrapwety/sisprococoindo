<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanDkp extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'laporan_dkps';

    // Define the fillable attributes
    protected $fillable = [
        'id_kelapa_bulat',
        'no',
        'tanggal',
        'nama_sheller',
        'nama_parer',
        'hasil_kerja_parer',
        'hasil_kerja_sheller',
        'total_keranjang',
        'tipe_keranjang',
        'berat_keranjang',
        'total_potongan_keranjang'
    ];

    // Optionally, you can define the primary key if it's not 'id'
    // protected $primaryKey = 'id';

    // Disable auto-incrementing if necessary
    // public $incrementing = false;

    // If you don't want Laravel to handle timestamps
    // public $timestamps = false;
}
