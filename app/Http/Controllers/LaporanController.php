<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller

{
   
    public function dkp()
    {
        return view('laporan.dkp');
    }

    public function kulitari()
    {
        return view('laporan.kulitari');
    }


    public function airkelapa()
    {
        return view('laporan.airkelapa');
    }
    public function serabutkelapa()
    {
        return view('laporan.serabutkelapa');
    }

    public function tempurung()
    {
        return view('laporan.tempurung');
    }

    public function dkp_reject()
    {
        return view('laporan.dkp_reject');
    }
}
