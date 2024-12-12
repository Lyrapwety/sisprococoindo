<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanDkpRejectBasah;


class LaporandkprejectController extends Controller
{
    public function index()
    {
        $laporandkprejects = LaporanDkpRejectBasah::all();
        return view('laporan.dkp_reject', compact('laporandkprejects'));
    }
}
