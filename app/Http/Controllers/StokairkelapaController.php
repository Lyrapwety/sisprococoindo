<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokAirKelapa;

class StokairkelapaController extends Controller
{
    public function index()
    {
        $stokairkelapas = StokAirKelapa::all();
        return view('card_stock.air_kelapa', compact('stokairkelapas'));
    }

    public function store(Request $request)
{
    // Validasi data
    $request->validate([
        'id_laporan_air_kelapa' => 'nullable|string|max:255',
        'tanggal' => 'required|string|max:255',
        'keterangan' => 'nullable|string|max:255',
        'activity_type' => 'required|string|max:255',
        'making_product' => 'nullable|numeric',
        'jumlah' => 'nullable|numeric',
        'jenis_berat' => 'nullable|string|max:255',
        'fat' => 'nullable|numeric',
        'ph' => 'nullable|numeric',
    ]);

    $activity_type = $request->activity_type;
    $making_product = $request->making_product;
    $jumlah = $request->jumlah;  // Jumlah box
    $in_bags = 0;
    $in_box = 0;
    $remain = 0;
    $out = 0;
    $begin = StokAirKelapa::latest()->value('remain') ?? 0;

    // Perhitungan untuk produksi dan ekspor
    if ($activity_type === 'produksi') {
        $in_bags = $jumlah * 4;
        $in_box = $jumlah;
        $remain = $begin + $in_box;
    } elseif ($activity_type === 'ekspor') {
        $out = $jumlah;
        $remain = $begin - $out;
    } else {
        return redirect()->back()->withErrors(['activity_type' => 'Tipe aktivitas tidak valid!']);
    }

    $jenisBerat = $request->jenis_berat;
    $limakg = 0;
    $empatkg = 0;
    $tigakg = 0;
    $duakg = 0;
    $satukg = 0;

    if ($jenisBerat == "5KG") {
        $limakg = $in_box * 20;
    } elseif ($jenisBerat == "4KG") {
        $empatkg = $in_box * 20;
    } elseif ($jenisBerat == "3KG") {
        $tigakg = $in_box * 20;
    } elseif ($jenisBerat == "2KG") {
        $duakg = $in_box * 20;
    } elseif ($jenisBerat == "1KG") {
        $satukg = $in_box * 20;
    }

    // Simpan data ke database
    StokAirKelapa::create([
        'id_laporan_air_kelapa' => $request->id_laporan_air_kelapa,
        'tanggal' => $request->tanggal,
        'keterangan' => $request->keterangan,
        'activity_type' => $activity_type,
        'making_product' => $making_product,
        'jenis_berat' => $jenisBerat,
        'jumlah' => $jumlah,
        'fat' => $request->fat,
        'ph' => $request->ph,
        'begin' => $begin,
        'in_bags' => $in_bags,
        'in_box' => $in_box,
        'remain' => $remain,
        'out' => $out,
        'limakg' => $limakg,
        'empatkg' => $empatkg,
        'tigakg' => $tigakg,
        'duakg' => $duakg,
        'satukg' => $satukg,
        'catatan' => $request->catatan,
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('card_stock.air_kelapa.index')->with('success', 'Data berhasil ditambahkan!');
}
}
