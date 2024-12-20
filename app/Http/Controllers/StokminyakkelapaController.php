<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokMinyakKelapa;

class StokminyakkelapaController extends Controller
{
    public function index()
    {
        $stokminyakkelapas = StokMinyakKelapa::all();
        return view('card_stock.minyak_kelapa', compact('stokminyakkelapas'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
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
        StokMinyakKelapa::create([
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
        return redirect()->route('card_stock.minyak_kelapa.index')->with('success', 'Data berhasil ditambahkan!');
    }


    public function destroy($id)
    {
        $stokminyakkelapas = StokMinyakKelapa::findOrFail($id);
        $stokminyakkelapas->delete();

        return redirect()->route('card_stock.minyak_kelapa.index')->with('success', 'Data berhasil dihapus!');
    }
}
