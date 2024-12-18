<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduksiAirKelapa extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'produksi_air_kelapas';

    // Define the fillable attributes
    protected $fillable = [
        'id_air_kelapa',
        'tanggal',
        'keterangan',
        'briz',
        'ph',
        'sn',
        'bags',
        'begin',
        'in',
        'out',
        'remain',
    ];
}
