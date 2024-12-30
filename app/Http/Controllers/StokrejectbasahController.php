<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokDkpRejectBasah;

class StokrejectbasahController extends Controller
{
    public function index()
    {
        $stokrejectbasahs = StokDkpRejectBasah::orderBy('tanggal', 'asc')->orderBy('id', 'asc')->get();

        return view('card_stock.dkp_reject_basah', compact('stokrejectbasahs'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'id_laporan_dkp_reject_basah' => 'nullable|string|max:255',
            'tanggal' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'activity_type' => 'required|string|max:255',
            'stok' => 'required|numeric',
        ]);
        // Simpan data baru
        $newEntry = StokDkpRejectBasah::create($request->only([
            'id_laporan_dkp_reject_basah',
            'tanggal',
            'keterangan',
            'activity_type',
            'stok',
        ]));
        

        // Recalculate semua stok berdasarkan tanggal
        $this->recalculateRemains();

        return redirect()->route('card_stock.dkp_reject_basah.index')->with('success', 'Data berhasil ditambahkan!');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'id_laporan_dkp_reject_basah' => 'nullable|string|max:255',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
            'activity_type' => 'required|string|max:255',
            'stok' => 'required|numeric',
        ]);

        $stokrejectbasah = StokDkpRejectBasah::findOrFail($id);

        // Update data
        $stokrejectbasah->update($request->only([
            'id_laporan_dkp_reject_basah',
            'tanggal',
            'keterangan',
            'activity_type',
            'stok',
        ]));

        // Recalculate semua stok berdasarkan tanggal
        $this->recalculateRemains();

        return redirect()->route('card_stock.dkp_reject_basah.index')->with('success', 'Data berhasil diperbarui!');
    }
    protected function recalculateRemains()
    {
        // Ambil semua data diurutkan berdasarkan tanggal
        $entries = StokDkpRejectBasah::orderBy('tanggal', 'asc')->orderBy('id', 'asc')->get();

        $lastRemain = 0;

        foreach ($entries as $entry) {
            // Perhitungan stok
            $begin = $lastRemain;
            $in = $entry->activity_type === 'reject' ? $entry->stok : 0;
            $out = in_array($entry->activity_type, ['produksi', 'penjualan']) ? $entry->stok : 0;
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
        $laporan = StokDkpRejectBasah::findOrFail($id);

        // Return the data in JSON format
        return response()->json([
            'id_laporan_dkp_reject_basah' => $laporan->id_laporan_kulit_ari_basah,
            'tanggal' => $laporan->tanggal,
            'keterangan' => $laporan->remark,
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
        $stokrejectbasah = StokDkpRejectBasah::findOrFail($id);
        $stokrejectbasah->delete();

        return redirect()->route('card_stock.dkp_reject_basah.index')->with('success', 'Data berhasil dihapus!');
    }
}
