<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProduksiSantan;

class ProduksisantanController extends Controller
{
    public function index()
    {
        $produksisantans = ProduksiSantan::all();
        return view('produksi.santan', compact('produksisantans'));
    }
}
