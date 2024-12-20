<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokAmpasKeringPutih;

class StokampasputihController extends Controller
{
    public function index()
    {
        $stokampaskeringputihs = StokAmpasKeringPutih::all();
        return view('card_stock.ampas_kering_putih', compact('stokampaskeringputihs'));
    }


    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'id_laporan_santan' => 'nullable|string|max:255',
            'tanggal' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'activity_type' => 'nullable|string|max:255',
            'stok' => 'nullable|string|max:255',
            'begin' => 'nullable|string|max:255',
            'in_fine' => 'nullable|string|max:255',
            'in_medium' => 'nullable|string|max:255',
            'out' => 'nullable|string|max:255',
            'remain' => 'nullable|string|max:255',
        ]);

        // Simpan data ke database
        StokAmpasKeringPutih::create([
            'id_laporan_santan' => $request->id_laporan_santan,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'activity_type' => $request->activity_type,
            'stok' => $request->stok,
            'begin' => $request->begin,
            'in_fine' => $request->in_fine,
            'in_medium' => $request->in_medium,
            'out' => $request->out,
            'remain' => $request->remain,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('card_stock.ampas_kering_putih.index')->with('success', 'Data berhasil ditambahkan!');
    }



    public function destroy($id)
    {
        $stokarikering = StokAmpasKeringPutih::findOrFail($id);
        $stokarikering->delete();

        return redirect()->route('card_stock.kulit_ari_kering.index')->with('success', 'Data berhasil dihapus!');
    }
}
