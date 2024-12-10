<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockController extends Controller
{
    public function dkp_reject_kering()
    {
        return view('card_stock.dkp_reject_kering');
    }

    public function dkp_reject_basah()
    {
        return view('card_stock.dkp_reject_basah');
    }

    public function dkp()
    {
        return view('card_stock.dkp');
    }

    public function minyak_kelapa()
    {
        return view('card_stock.minyak_kelapa');
    }

    public function kulit_ari_kering()
    {
        return view('card_stock.kulit_ari_kering');
    }
    public function kulit_ari_basah()
    {
        return view('card_stock.kulit_ari_basah');
    }


    public function tempurung_basah()
    {
        return view('card_stock.tempurung_basah');
    }

    public function air_kelapa()
    {
        return view('card_stock.air_kelapa');
    }

    public function santan()
    {
        return view('card_stock.santan');
    }

    public function kelapa_bulat()
    {
        return view('card_stock.kelapa_bulat');
    }
    public function ampas_kering_putih()
    {
        return view('card_stock.ampas_kering_putih');
    }
    public function ampas_kering_yellow()
    {
        return view('card_stock.ampas_kering_yellow');
    }
}
