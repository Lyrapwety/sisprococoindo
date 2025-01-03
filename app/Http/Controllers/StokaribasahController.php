<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokKulitAriBasah;

class StokaribasahController extends Controller
{
    public function index()
    {
       
        $stokaribasahs = StokKulitAriBasah::orderBy('tanggal', 'asc')->orderBy('id', 'asc')->get();
        return view('card_stock.kulit_ari_basah', compact('stokaribasahs'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_laporan_kulit_ari_basah' => 'nullable|string|max:255',
            'tanggal' => 'required|date',
            'remark' => 'nullable|string|max:255',
            'activity_type' => 'required|string|max:255',
            'stok' => 'required|numeric',
        ]);

       
        $newEntry = StokKulitAriBasah::create($request->only([
            'id_laporan_kulit_ari_basah',
            'tanggal',
            'remark',
            'activity_type',
            'stok',
        ]));
        

       
        $this->recalculateRemains();

        return redirect()->route('card_stock.kulit_ari_basah.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_laporan_kulit_ari_basah' => 'nullable|string|max:255',
            'tanggal' => 'required|date',
            'remark' => 'nullable|string|max:255',
            'activity_type' => 'required|string|max:255',
            'stok' => 'required|numeric',
        ]);

        $stokaribasah = StokKulitAriBasah::findOrFail($id);

       
        $stokaribasah->update($request->only([
            'id_laporan_kulit_ari_basah',
            'tanggal',
            'remark',
            'activity_type',
            'stok',
        ]));

        
        $this->recalculateRemains();

        return redirect()->route('card_stock.kulit_ari_basah.index')->with('success', 'Data berhasil diperbarui!');
    }

    protected function recalculateRemains()
    {
       
        $entries = StokKulitAriBasah::orderBy('tanggal', 'asc')->orderBy('id', 'asc')->get();

        $lastRemain = 0;

        foreach ($entries as $entry) {
           
            $begin = $lastRemain;
            $in = $entry->activity_type === 'hasil_produksi' ? $entry->stok : 0;
            $out = in_array($entry->activity_type, ['produksi', 'penjualan', 'adjustment']) ? $entry->stok : 0;
            $remain = $begin + $in - $out;

            
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
        
        $laporan = StokKulitAriBasah::findOrFail($id);

    
        return response()->json([
            'id_laporan_kulit_ari_basah' => $laporan->id_laporan_kulit_ari_basah,
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
        $stokaribasah = StokKulitAriBasah::findOrFail($id);
        $stokaribasah->delete();

       
        $this->recalculateRemains();

        return redirect()->route('card_stock.kulit_ari_basah.index')->with('success', 'Data berhasil dihapus!');
    }
}