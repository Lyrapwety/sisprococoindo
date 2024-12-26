<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokSantan;

class StoksantanController extends Controller
{
    public function index()
    {
        $stoksantans = StokSantan::all();
        return view('card_stock.santan', compact('stoksantans'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'id_laporan_dkp' => 'nullable|string|max:255',
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
        $begin = StokSantan::latest()->value('remain') ?? 0;

        // Logika berdasarkan tipe aktivitas
        if ($activity_type === 'produksi') {
            // Jika jenis aktivitasnya produksi, in_bags akan dihitung berdasarkan jumlah box dan berat
            $in_box = $jumlah;
            $remain = $begin + $in_box;
        } elseif ($activity_type === 'ekspor') {
            // Jika jenis aktivitas ekspor, jumlah yang dikeluarkan dari stok adalah $jumlah
            $out = $jumlah;
            $remain = $begin - $out;
        } else {
            return redirect()->back()->withErrors(['activity_type' => 'Tipe aktivitas tidak valid!']);
        }

        $jenisBerat = $request->jenis_berat;

        // Kalkulasi berat berdasarkan jenis berat yang dipilih
        $remain_kg = 0;
        $calculated_bags = 0;

        // Kalkulasi berat berdasarkan jenis berat yang dipilih
        if ($jenisBerat == "5KG") {
            $remain_kg = $in_box * 20;  // 20 untuk 5KG
            $calculated_bags = $remain_kg / 5;  // Dibagi dengan 5KG
        } elseif ($jenisBerat == "4KG") {
            $remain_kg = $in_box * 20;  // 20 untuk 4KG
            $calculated_bags = $remain_kg / 4;  // Dibagi dengan 4KG
        } elseif ($jenisBerat == "3KG") {
            $remain_kg = $in_box * 20;  // 20 untuk 3KG
            $calculated_bags = $remain_kg / 3;  // Dibagi dengan 3KG
        } elseif ($jenisBerat == "2KG") {
            $remain_kg = $in_box * 20;  // 20 untuk 2KG
            $calculated_bags = $remain_kg / 2;  // Dibagi dengan 2KG
        } elseif ($jenisBerat == "1KG") {
            $remain_kg = $in_box * 18;  // 18 untuk 1KG
            $calculated_bags = $remain_kg / 1;  // Dibagi dengan 1KG
        }

        // Kalkulasi in_bags yang sesuai dengan jenis berat yang dipilih
        $in_bags = $calculated_bags;

        // Simpan data ke database
        StokSantan::create([
            'id_laporan_dkp' => $request->id_laporan_dkp,
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
            'catatan' => $request->catatan,
            'remain_kg' => $remain_kg,
            'calculated_bags' => $calculated_bags,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('card_stock.santan.index')->with('success', 'Data berhasil ditambahkan!');
    }






}
