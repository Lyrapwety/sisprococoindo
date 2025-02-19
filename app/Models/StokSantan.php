<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokSantan extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'stok_santans';

    // Define the fillable attributes
    protected $fillable = [
        'id_laporan_dkp',
        'tanggal',
        'keterangan',
        'making_product',
        'activity_type',
        'jenis_berat',
        'jumlah',
        'fat',
        'ph',
        'begin',
        'in_bags',
        'in_box',
        'out',
        'remain',
        'catatan'
    ];

    // Optionally, you can define the primary key if it's not 'id'
    // protected $primaryKey = 'id';

    // Disable auto-incrementing if necessary
    // public $incrementing = false;

    // If you don't want Laravel to handle timestamps
    // public $timestamps = false;
}
