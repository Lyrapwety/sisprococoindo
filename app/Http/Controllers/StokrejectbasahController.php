<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokDkpRejectBasah;

class StokrejectbasahController extends Controller
{
    public function index()
    {
        $stokrejectbasahs = StokDkpRejectBasah::all();
        return view('card_stock.dkp_reject_basah', compact('stokrejectbasahs'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'id_laporan_dkp_reject_basah' => 'nullable|string|max:255',
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
        StokDkpRejectBasah::create([
            'id_laporan_dkp_reject_basah' => $request->id_laporan_dkp_reject_basah,
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
        return redirect()->route('card_stock.dkp_reject_basah.index')->with('success', 'Data berhasil ditambahkan!');
    }


    public function destroy($id)
    {
        $stokrejectbasah = StokDkpRejectBasah::findOrFail($id);
        $stokrejectbasah->delete();

        return redirect()->route('card_stock.dkp_reject_basah.index')->with('success', 'Data berhasil dihapus!');
    }
}
