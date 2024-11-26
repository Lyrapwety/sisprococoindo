<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProduksiController extends Controller{


   public function air_kelapa()
    {
        return view('produksi.air_kelapa');
    }
    public function santan()
    {
        return view('produksi.santan');
    }

}
