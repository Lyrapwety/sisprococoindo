<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokAmpasKeringYellow;

class StokampasyellowController extends Controller
{
    public function index()
    {
        $stokampaskeringyellows = StokAmpasKeringYellow::all();
        return view('card_stock.ampas_kering_yellow', compact('stokampaskeringyellows'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'id_stok_ampas_kering_putih' => 'nullable|string|max:255',
            'tanggal' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'activity_type' => 'required|string|max:255',
            'stok' => 'required|numeric',
            'kategori' => 'nullable|string|in:fine,medium',
        ]);

        $stok = $request->stok;
        $activity_type = $request->activity_type;

        $begin = 0;
        $in_fine = 0;
        $in_medium = 0;
        $out = 0;
        $remain = 0;

        $last_entry = StokAmpasKeringYellow::latest()->first();

        switch ($activity_type) {
            case 'produksi':
                if ($request->kategori === 'fine') {
                    $in_fine = $stok;
                    $begin = $last_entry ? $last_entry->remain : 0;
                    $remain = $begin + $in_fine;
                } elseif ($request->kategori === 'medium') {
                    $in_medium = $stok;
                    $begin = $last_entry ? $last_entry->remain : 0;
                    $remain = $begin + $in_medium;
                }
                break;

            case 'ekspor':
            case 'penjualan':
                $out = $stok;

                $begin = $last_entry ? $last_entry->remain : 0;
                $remain = $begin - $out;

                if ($remain < 0) {
                    return redirect()->back()->withErrors(['stok' => 'Stok tidak cukup untuk aktivitas ini.']);
                }
                break;

            default:
                return redirect()->back()->withErrors(['activity_type' => 'Tipe aktivitas tidak valid!']);
        }

        StokAmpasKeringYellow::create([
            'id_stok_ampas_kering_putih' => $request->id_stok_ampas_kering_putih,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'activity_type' => $activity_type,
            'stok' => $stok,
            'kategori' => $request->kategori,
            'begin' => $begin,
            'in_fine' => $in_fine,
            'in_medium' => $in_medium,
            'out' => $out,
            'remain' => $remain,
        ]);

        return redirect()->route('card_stock.ampas_kering_yellow.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // Find the record by its ID
        $laporan = StokAmpasKeringYellow::findOrFail($id);

        // Return the data in JSON format
        return response()->json([
            'id_stok_ampas_kering_putih' => $laporan->id_stok_ampas_kering_putih,
            'tanggal' => $laporan->tanggal,
            'keterangan' => $laporan->keterangan,
            'activity_type' => $laporan->activity_type,
            'stok' => $laporan->stok,
            'begin' => $laporan->begin,
            'kategori' => $laporan->kategori,
            'in_fine' => $laporan->in_fine,
            'in_medium' => $laporan->in_medium,
            'out' => $laporan->out,
            'remain' => $laporan->remain,
        ]);
    }

    public function destroy($id)
    {
        $stokampaskeringyellow = StokAmpasKeringYellow::findOrFail($id);
        $stokampaskeringyellow->delete();

        return redirect()->route('card_stock.ampas_kering_yellow.index')->with('success', 'Data berhasil dihapus!');
    }



}
