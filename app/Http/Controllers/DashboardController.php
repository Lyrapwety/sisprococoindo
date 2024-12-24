<?php

namespace App\Http\Controllers;

use App\Models\StokDkp;
use App\Models\StokKulitAriBasah;
use App\Models\StokAirKelapa;
use App\Models\StokTempurungBasah;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $dagingKelapaPutih = StokDkp::where('activity_type', 'hasil_produksi')
            ->sum('in');

        $airKelapa = StokAirKelapa::where('activity_type', 'produksi')
            ->sum('in_box');

        $kulitAriBasah = StokKulitAriBasah::where('activity_type', 'hasil_produksi')
            ->sum('in');

        $tempurungKelapa = StokTempurungBasah::where('activity_type', 'hasil_produksi')
            ->sum('in');

        $total = $dagingKelapaPutih + $airKelapa + $kulitAriBasah + $tempurungKelapa;

        $dagingKelapaPutihPercentage = ($total > 0) ? number_format(($dagingKelapaPutih / $total) * 100, 2) : 0;
        $airKelapaPercentage = ($total > 0) ? number_format(($airKelapa / $total) * 100, 2) : 0;
        $kulitAriBasahPercentage = ($total > 0) ? number_format(($kulitAriBasah / $total) * 100, 2) : 0;
        $tempurungKelapaPercentage = ($total > 0) ? number_format(($tempurungKelapa / $total) * 100, 2) : 0;

        $missingPercentage = 100 - ($dagingKelapaPutihPercentage + $airKelapaPercentage + $kulitAriBasahPercentage + $tempurungKelapaPercentage);

        return view('dashboard', compact(
            'dagingKelapaPutihPercentage',
            'airKelapaPercentage',
            'kulitAriBasahPercentage',
            'tempurungKelapaPercentage',
            'missingPercentage'
        ));
    }
}
