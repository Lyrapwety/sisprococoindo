<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekapController extends Controller
{
    
    public function tempurung()
    {
        return view('rekap_laporan.pembukaan_tempurung');
    }
    public function kulitari()
    {
        return view('rekap_laporan.pembukaan_kulit_ari');
    }
    

}


