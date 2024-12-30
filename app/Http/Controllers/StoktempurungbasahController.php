<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokTempurungBasah;

class StoktempurungbasahController extends Controller
{
    public function index()
    {
        $stoktempurungs = StokTempurungBasah::orderBy('tanggal', 'asc')->orderBy('id', 'asc')->get();
        return view('card_stock.tempurung_basah', compact('stoktempurungs'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'id_laporan_tempurung_basah' => 'nullable|string|max:255',
            'tanggal' => 'required|date_format:Y-m-d',
            'keterangan' => 'nullable|string|max:255',
            'activity_type' => 'required|string|max:255',
            'stok' => 'required|numeric',
        ]);

           // Simpan data baru
           $newEntry = StokTempurungBasah::create($request->only([
          'id_laporan_tempurung_basah',
            'tanggal',
            'keterangan',
            'activity_type',
            'stok',
        ]));
          // Recalculate semua stok berdasarkan tanggal
          $this->recalculateRemains();

          return redirect()->route('card_stock.tempurung_basah.index')->with('success', 'Data berhasil ditambahkan!');
      }

      
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_laporan_tempurung_basah' => 'nullable|string|max:255',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
            'activity_type' => 'required|string|max:255',
            'stok' => 'required|numeric',
        ]);

        $stoktempurungbasah = StokTempurungBasah::findOrFail($id);

        // Update data
        $stoktempurungbasah->update($request->only([
            'id_laporan_tempurung_basah',
            'tanggal',
            'keterangan',
            'activity_type',
            'stok',
        ]));

        // Recalculate semua stok berdasarkan tanggal
        $this->recalculateRemains();

        return redirect()->route('card_stock.tempurung_basah.index')->with('success', 'Data berhasil diperbarui!');
    }

      protected function recalculateRemains()
      {
        $entries = StokTempurungBasah::orderBy('tanggal', 'asc')->orderBy('id', 'asc')->get();

        $lastRemain = 0;

        foreach ($entries as $entry) {
            // Perhitungan stok
            $begin = $lastRemain;
            $in = $entry->activity_type === 'produksi' ? $entry->stok : 0;
            $out = in_array($entry->activity_type, ['penjualan', 'adjustment']) ? $entry->stok : 0;
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
        $laporan = StokTempurungBasah::findOrFail($id);

        // Return the data in JSON format
        return response()->json([
            'id_laporan_tempurung_basah' => $laporan->id_laporan_dkp,
            'tanggal' => $laporan->tanggal,
            'keterangan' => $laporan->keterangan,
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
        $stoktempurung = StokTempurungBasah::findOrFail($id);
        $stoktempurung->delete();
        
            // Recalculate semua stok setelah penghapusan
            $this->recalculateRemains();

        return redirect()->route('card_stock.tempurung_basah.index')->with('success', 'Data berhasil dihapus!');
    }
}


