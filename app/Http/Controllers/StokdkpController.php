<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokDkp;

class StokdkpController extends Controller
{
    public function index()
    {
        $stokdkps = StokDkp::all();
        return view('card_stock.dkp', compact('stokdkps'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'id_laporan_dkp' => 'nullable|string|max:255',
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
        StokDkp::create([
            'id_laporan_dkp' => $request->id_laporan_dkp,
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
        return redirect()->route('card_stock.dkp.index')->with('success', 'Data berhasil ditambahkan!');
    }


    public function destroy($id)
    {
        $stokdkp = StokDkp::findOrFail($id);
        $stokdkp->delete();

        return redirect()->route('card_stock.dkp.index')->with('success', 'Data berhasil dihapus!');
    }
}
