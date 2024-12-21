<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProduksiAirKelapa;

class ProduksiairkelapaController extends Controller
{
    public function index()
    {
        $produksiairkelapas = ProduksiAirKelapa::all();
        return view('produksi.air_kelapa', compact('produksiairkelapas'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'id_air_kelapa' => 'nullable|string|max:255',
            'tanggal' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
        'activity_type' => 'required|string|max:255',
        'sn' => 'nullable|string|max:255',
        'bags' => 'required|numeric', // Wajib input angka
    ]);

    // Ambil nilai dari request
    $activity_type = $request->activity_type;
    $sn = $request->sn;
    $bags = $request->bags * 5; // Kalikan dengan 5

    // Inisialisasi variabel
    $begin = ProduksiAirKelapa::latest()->value('remain') ?? 0; // Sisa stok terakhir
    $in_steril = 0;
    $in_nonsteril = 0;
    $out_rep = 0;
    $out_eks = 0;
    $out_adj = 0;
    $remain = $begin;

    // Logika berdasarkan tipe aktivitas
    switch ($activity_type) {
        case 'produksi':
            if ($sn === 'steril') {
                $in_steril = $bags;
            } elseif ($sn === 'nonsteril') {
                $in_nonsteril = $bags;
            }
            $remain += $bags; // Tambahkan ke remain
            break;

        case 'adjust':
            $out_adj = $bags;
            $remain -= $bags; // Kurangi dari remain
            break;

        case 'ekspor':
            $out_eks = $bags;
            $remain -= $bags; // Kurangi dari remain
            break;

        case 'reproses':
            $out_rep = $bags;
            $remain -= $bags; // Kurangi dari remain
            break;

        default:
            return redirect()->back()->withErrors(['activity_type' => 'Tipe aktivitas tidak valid!']);
    }

        // Simpan data ke database
        ProduksiAirKelapa::create([
            'id_air_kelapa' => $request->id_santan,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'activity_type' => $activity_type,
            'fat' => $request->fat,
            'ph' => $request->ph,
            'sn' => $sn,
            'briz' => $request->briz,
            'bags' => $bags,
            'begin' => $begin,
            'in_steril' => $in_steril,
            'in_nonsteril' => $in_nonsteril,
            'out_rep' => $out_rep,
            'out_eks' => $out_eks,
            'out_adj' => $out_adj,
            'remain' => $remain,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('produksi.air_kelapa.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $produksiairkelapa = ProduksiAirKelapa::findOrFail($id);
        $produksiairkelapa->delete();

        return redirect()->route('laporan.dkp_reject.index')->with('success', 'Data berhasil dihapus!');
    }
}
