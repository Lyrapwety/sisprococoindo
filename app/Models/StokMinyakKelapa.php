<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokMinyakKelapa extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'stok_minyak_kelapas';

    // Define the fillable attributes
    protected $fillable = [
        'tanggal',
        'remark',
        'activity_type',
        'stok',
        'begin',
        'in',
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