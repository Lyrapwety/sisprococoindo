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
        $request->validate([
            'tanggal' => 'nullable|string|max:255',
            'remark' => 'nullable|string|max:255',
            'activity_type' => 'nullable|string|max:255',
            'trip' => 'nullable|string|max:255',
            'stok' => 'required|numeric',
    ]);

    $stok = $request->stok;
    $activity_type = $request->activity_type;

    $last_remain = StokKbKelapaBulat::latest()->value('remain') ?? 0;

    $begin = $last_remain;
    $in = 0;
    $out = 0;
    $remain = $begin;

    switch ($activity_type) {
        case 'pembelian':
            $in = $stok;
            $remain = $begin + $in;
            break;

        case 'pemakaian_produksi':
            $out = $stok;
            $remain = $begin - $out;

            if ($remain < 0) {
                return redirect()->back()->withErrors(['stok' => 'Stok tidak mencukupi untuk aktivitas ini!']);
            }
            break;

        default:
            return redirect()->back()->withErrors(['activity_type' => 'Tipe aktivitas tidak valid!']);
    }

        StokKbKelapaBulat::create([
            'tanggal' => $request->tanggal,
            'remark' => $request->remark,
            'activity_type' => $request->activity_type,
            'trip' => $request->trip,
            'stok' => $stok,
            'begin' => $begin,
            'in' => $in,
            'out' => $out,
            'remain' => $remain,
        ]);

        return redirect()->route('card_stock.KB_Kelapa_Bulat.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // Find the record by its ID
        $laporan = StokKbKelapaBulat::findOrFail($id);

        // Return the data in JSON format
        return response()->json([
            'tanggal' => $laporan->tanggal,
            'remark' => $laporan->remark,
            'activity_type' => $laporan->activity_type,
            'trip' => $laporan->trip,
            'stok' => $laporan->stok,
            'begin' => $laporan->begin,
            'in' => $laporan->in,
            'out' => $laporan->out,
            'remain' => $laporan->remain,
        ]);
    }


    public function destroy($id)
    {
        $stokkb = StokKbKelapaBulat::findOrFail($id);
        $stokkb->delete();

        return redirect()->route('card_stock.KB_Kelapa_Bulat.index')->with('success', 'Data berhasil dihapus!');
    }

}
