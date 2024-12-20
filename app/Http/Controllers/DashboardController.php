<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{

public function dashboard()
{
    $departemenCounts = Pegawai::select('departemen', DB::raw('COUNT(*) as count'))
        ->whereIn('departemen', ['Produksi', 'Kupas', 'Gudang', 'Limbah'])
        ->groupBy('departemen')
        ->get();

    $data = [
        'Produksi' => $departemenCounts->firstWhere('departemen', 'Produksi')->count ?? 0,
        'Kupas' => $departemenCounts->firstWhere('departemen', 'Kupas')->count ?? 0,
        'Gudang' => $departemenCounts->firstWhere('departemen', 'Gudang')->count ?? 0,
        'Limbah' => $departemenCounts->firstWhere('departemen', 'Limbah')->count ?? 0,
    ];

    return view('dashboard', compact('data'));
}


}
