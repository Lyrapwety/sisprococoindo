<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokAmpasKeringYellow extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'stok_ampas_kering_yellows';

    // Define the fillable attributes
    protected $fillable = [
        'id_stok_ampas_kering_putih',
        'tanggal',
        'keterangan',
        'activity_type',
        'begin',
        'in_fine',
        'in_medium',
        'out',
        'remain'
    ];

    // Optionally, you can define the primary key if it's not 'id'
    // protected $primaryKey = 'id';

    // Disable auto-incrementing if necessary
    // public $incrementing = false;

    // If you don't want Laravel to handle timestamps
    // public $timestamps = false;
}
