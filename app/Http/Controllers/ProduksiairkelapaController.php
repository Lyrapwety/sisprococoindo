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
            'activity_type' => 'nullable|string|max:255',
            'fat' => 'nullable|string|max:255',
            'ph' => 'nullable|string|max:255',
            'sn' => 'nullable|string|max:255',
            'briz' => 'nullable|string|max:255',
            'bags' => 'nullable|string|max:255',
            'begin' => 'nullable|string|max:255',
            'in_steril' => 'nullable|string|max:255',
            'in_nonsteril' => 'nullable|string|max:255',
            'out_rep' => 'nullable|string|max:255',
            'out_eks' => 'nullable|string|max:255',
            'out_adj' => 'nullable|string|max:255',
            'remain' => 'nullable|string|max:255',
        ]);

        // Simpan data ke database
        ProduksiAirKelapa::create([
            'id_air_kelapa' => $request->id_santan,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'activity_type' => $request->activity_type,
            'fat' => $request->fat,
            'ph' => $request->ph,
            'sn' => $request->sn,
            'briz' => $request->briz,
            'bags' => $request->bags,
            'begin' => $request->begin,
            'in_steril' => $request->in_steril,
            'in_nonsteril' => $request->in_nonsteril,
            'out_rep' => $request->out_rep,
            'out_eks' => $request->out_eks,
            'out_adj' => $request->out_adj,
            'remain' => $request->remain,
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
