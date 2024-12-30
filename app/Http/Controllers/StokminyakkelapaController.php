<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokMinyakKelapa;

class StokminyakkelapaController extends Controller
{
    public function index()
    {
        $stokminyakkelapas = StokMinyakKelapa::orderBy('tanggal', 'asc')->orderBy('id', 'asc')->get();

        return view('card_stock.minyak_kelapa', compact('stokminyakkelapas'));
    }

    public function store(Request $request)
{
    // Validasi data
    $request->validate([
        'tanggal' => 'nullable|string|max:255',
        'remark' => 'nullable|string|max:255',
        'activity_type' => 'required|string|max:255', // Aktivitas wajib dipilih
        'stok' => 'required|numeric', // Stok wajib dan harus numerik
    ]);
      // Simpan data baru
      $newEntry = StokMinyakKelapa::create($request->only([
        'tanggal',
        'remark',
        'activity_type',
        'stok',
    ]));
    
    // Ambil data stok dan tipe aktivitas
     // Recalculate semua stok berdasarkan tanggal
     $this->recalculateRemains();

     return redirect()->route('card_stock.minyak_kelapa.index')->with('success', 'Data berhasil ditambahkan!');
 }


public function update(Request $request, $id)
{
    // Validasi data
    $request->validate([
        'tanggal' => 'nullable|string|max:255',
        'remark' => 'nullable|string|max:255',
        'activity_type' => 'required|string|max:255', // Aktivitas wajib dipilih
        'stok' => 'required|numeric', // Stok wajib dan harus numerik
    ]);
    $stokminyakkelapas = StokMinyakKelapa::findOrFail($id);

    // Update data
    $stokminyakkelapas->update($request->only([
        'tanggal',
        'remark',
        'activity_type',
        'stok',
    ]));

    // Recalculate semua stok berdasarkan tanggal
    $this->recalculateRemains();

    return redirect()->route('card_stock.minyak_kelapa.index')->with('success', 'Data berhasil diperbarui!');
}

protected function recalculateRemains()
{
    // Ambil semua data diurutkan berdasarkan tanggal
    $entries = StokMinyakKelapa::orderBy('tanggal', 'asc')->orderBy('id', 'asc')->get();

    $lastRemain = 0;

    foreach ($entries as $entry) {
        // Perhitungan stok
        $begin = $lastRemain;
        $in = $entry->activity_type === 'hasil_produksi' ? $entry->stok : 0;
        $out = in_array($entry->activity_type, [ 'penjualan']) ? $entry->stok : 0;
        $remain = $begin + $in - $out;

        // Update nilai
        $entry->update([
            'begin' => $begin,
            'in' => $in,
            'out' => $out,
            'remain' => $remain,
        ]);

        $lastRemain = $remain;
    }
}

    public function edit($id)
    {
        // Find the record by its ID
        $laporan = StokMinyakKelapa::findOrFail($id);

        // Return the data in JSON format
        return response()->json([
            'tanggal' => $laporan->tanggal,
            'remark' => $laporan->remark,
            'activity_type' => $laporan->activity_type,
            'stok' => $laporan->stok,
            'begin' => $laporan->begin,
            'in' => $laporan->in,
            'out' => $laporan->out,
            'remain' => $laporan->remain,
        ]);
    }


    public function destroy($id)
    {
        $stokminyakkelapas = StokMinyakKelapa::findOrFail($id);
        $stokminyakkelapas->delete();

        return redirect()->route('card_stock.minyak_kelapa.index')->with('success', 'Data berhasil dihapus!');
    }
}
