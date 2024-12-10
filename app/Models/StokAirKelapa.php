<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokAirKelapa extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'stok_air_kelapas';

    // Define the fillable attributes
    protected $fillable = [
        'id_laporan_air_kelapa',
        'tanggal',
        'keterangan',
        'making_product',
        'activity_type',
        'begin',
        'in',
        'out',
        'remain',
    ];

    // Optionally, you can define the primary key if it's not 'id'
    // protected $primaryKey = 'id';

    // Disable auto-incrementing if necessary
    // public $incrementing = false;

    // If you don't want Laravel to handle timestamps
    // public $timestamps = false;
}
