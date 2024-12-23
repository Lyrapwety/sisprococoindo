<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokKbKelapaBulat extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'stok_kb_kelapa_bulats';

    // Define the fillable attributes
    protected $fillable = [
        'tanggal',
        'remark',
        'activity_type',
        'stok',
        'trip',
        'begin',
        'in',
        'out',
        'remain'
    ];
}
