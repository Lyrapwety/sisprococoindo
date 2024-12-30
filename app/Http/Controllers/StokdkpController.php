<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\StokDkp;

class StokdkpController extends Controller
{
    public function index()
    {
        // Ambil data diurutkan berdasarkan tanggal
        $stokdkps = StokDkp::orderBy('tanggal', 'asc')->orderBy('id', 'asc')->get();
        return view('card_stock.dkp', compact('stokdkps'));
    }

    public function store(Request $request)
{
        $request->validate([
        'id_laporan_dkp' => 'nullable|string|max:255',
        'tanggal' => 'required|date',
        'keterangan' => 'nullable|string|max:255',
        'activity_type' => 'required|string|max:255',
        'stok' => 'required|numeric',
    ]);

    // Simpan data baru
    $newEntry = StokDkp::create($request->only([
        'id_laporan_dkp',
        'tanggal',
        'keterangan',
        'activity_type',
        'stok',
    ]));
    

    // Recalculate semua stok berdasarkan tanggal
    $this->recalculateRemains();

    return redirect()->route('card_stock.dkp.index')->with('success', 'Data berhasil ditambahkan!');
}


public function update(Request $request, $id)
{
    // Validasi data
    $request->validate([
        'id_laporan_dkp' => 'nullable|string|max:255',
        'tanggal' => 'nullable|string|max:255',
        'keterangan' => 'nullable|string|max:255',
        'activity_type' => 'required|string|max:255', // Aktivitas wajib dipilih
        'stok' => 'required|numeric', // Stok wajib dan harus numerik
    ]);

        $request->validate([
            'id_laporan_dkp' => 'nullable|string|max:255',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
            'activity_type' => 'required|string|max:255',
            'stok' => 'required|numeric',
        ]);

        $stokdkp = StokDkp::findOrFail($id);

        // Update data
        $stokdkp->update($request->only([
            'id_laporan_dkp',
            'tanggal',
            'keterangan',
            'activity_type',
            'stok',
        ]));

        // Recalculate semua stok berdasarkan tanggal
        $this->recalculateRemains();

        return redirect()->route('card_stock.dkp.index')->with('success', 'Data berhasil diperbarui!');
    }    

    protected function recalculateRemains()
    {
        // Ambil semua data diurutkan berdasarkan tanggal
        $entries = StokDkp::orderBy('tanggal', 'asc')->orderBy('id', 'asc')->get();

        $lastRemain = 0;

        foreach ($entries as $entry) {
            // Perhitungan stok
            $begin = $lastRemain;
            $in = in_array($entry->activity_type, ['hasil_produksi','pengambilan' ])? $entry->stok : 0;
            $out = in_array($entry->activity_type, ['pemakaian_produksi', 'reject']) ? $entry->stok : 0;
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
        $laporan = StokDkp::findOrFail($id);

        // Return the data in JSON format
        return response()->json([
            'id_laporan_dkp' => $laporan->id_laporan_dkp,
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
        $stokdkp = StokDkp::findOrFail($id);
        $stokdkp->delete();

        $this->recalculateRemains();

        return redirect()->route('card_stock.dkp.index')->with('success', 'Data berhasil dihapus!');
    }
}
