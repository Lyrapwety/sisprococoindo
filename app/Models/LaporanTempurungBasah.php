<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanTempurungBasah extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'laporan_tempurung_basahs';

    // Define the fillable attributes
    protected $fillable = [
        'id_kelapa_bulat',
        'no',
        'tanggal',
        'bruto',
        'tipe_keranjang',
        'total_keranjang',
        'total_potongan_keranjang',
        'netto',
        'timbangan_netto'
    ];

    // Optionally, you can define the primary key if it's not 'id'
    // protected $primaryKey = 'id';

    // Disable auto-incrementing if necessary
    // public $incrementing = false;

    // If you don't want Laravel to handle timestamps
    // public $timestamps = false;
}
