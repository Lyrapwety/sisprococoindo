<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduksiSantan extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'produksi_santans';

    // Define the fillable attributes
    protected $fillable = [
        'id_santan',
        'tanggal',
        'keterangan',
        'activity_type',
        'fat',
        'ph',
        'sn',
        'briz',
        'bags',
        'begin',
        'in_steril',
        'in_nonsteril',
        'out_rep',
        'out_eks',
        'out_adj',
        'remain'
    ];

    // Optionally, you can define the primary key if it's not 'id'
    // protected $primaryKey = 'id';

    // Disable auto-incrementing if necessary
    // public $incrementing = false;

    // If you don't want Laravel to handle timestamps
    // public $timestamps = false;
}
