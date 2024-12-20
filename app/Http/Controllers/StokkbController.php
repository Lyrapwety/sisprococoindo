<?php

namespace App\Http\Controllers;

use App\Models\StokKbKelapaBulat;
use Illuminate\Http\Request;

class StokkbController extends Controller
{
    public function index()
    {
        $stokkbs = StokKbKelapaBulat::all();
        return view('card_stock.KB_Kelapa_Bulat', compact('stokkbs'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'tanggal' => 'nullable|string|max:255',
            'remark' => 'nullable|string|max:255',
            'activity_type' => 'nullable|string|max:255',
            'stok' => 'nullable|string|max:255',
            'begin' => 'nullable|string|max:255',
            'in' => 'nullable|string|max:255',
            'out' => 'nullable|string|max:255',
            'remain' => 'nullable|string|max:255',
        ]);

        // Simpan data ke database
        StokKbKelapaBulat::create([
            'tanggal' => $request->tanggal,
            'remark' => $request->remark,
            'activity_type' => $request->activity_type,
            'stok' => $request->stok,
            'begin' => $request->begin,
            'in' => $request->in,
            'out' => $request->out,
            'remain' => $request->remain,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('card_stock.KB_Kelapa_Bulat.index')->with('success', 'Data berhasil ditambahkan!');
    }


    public function destroy($id)
    {
        $stokkb = StokKbKelapaBulat::findOrFail($id);
        $stokkb->delete();

        return redirect()->route('card_stock.KB_Kelapa_Bulat.index')->with('success', 'Data berhasil dihapus!');
    }

}
