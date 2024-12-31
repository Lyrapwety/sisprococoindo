<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawais'; // Nama tabel

    protected $fillable = [
        'nama',
        'tgl_join',
        'tgl_out',
        'posisi',
        'id_pegawai',
        'departemen',
        'kepagawaian',
        'status',
        'email',
        'foto',
    ];

}
