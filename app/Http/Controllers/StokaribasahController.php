<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokKulitAriBasah;

class StokaribasahController extends Controller
{
    public function index()
    {
        $stokaribasahs = StokKulitAriBasah::all();
        return view('card_stock.kulit_ari_basah', compact('stokaribasahs'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'id_laporan_kulit_ari_basah' => 'nullable|string|max:255',
            'tanggal' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'activity_type' => 'nullable|string|max:255',
            'stok' => 'nullable|string|max:255',
            'begin' => 'nullable|string|max:255',
            'in' => 'nullable|string|max:255',
            'out' => 'nullable|string|max:255',
            'remain' => 'nullable|string|max:255',
        ]);

        // Simpan data ke database
        StokKulitAriBasah::create([
            'id_laporan_kulit_ari_basah' => $request->id_laporan_kulit_ari_basah,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'activity_type' => $request->activity_type,
            'stok' => $request->stok,
            'begin' => $request->begin,
            'in' => $request->in,
            'out' => $request->out,
            'remain' => $request->remain,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('card_stock.kulit_ari_basah.index')->with('success', 'Data berhasil ditambahkan!');
    }


    public function destroy($id)
    {
        $stokaribasah = StokKulitAriBasah::findOrFail($id);
        $stokaribasah->delete();

        return redirect()->route('card_stock.kulit_ari_basah.index')->with('success', 'Data berhasil dihapus!');
    }
}
