<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_laporan extends Model
{
    use HasFactory;

    protected $table = 'jenis_laporans';
    protected $primaryKey = 'id_jenis_laporan';
    public $incrementing = false;
    protected $keyType = 'string';
}
