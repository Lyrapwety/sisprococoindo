<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKulitAriBasah extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'laporan_kulit_ari_basahs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_kelapa_bulat',
        'no',
        'tanggal',
        'sheller_parer',
        'bruto',
        'total_keranjang',
        'tipe_keranjang',
        'berat_keranjang',
        'total_potongan_keranjang',
        'hasil_kerja',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tanggal' => 'date',
    ];
}
