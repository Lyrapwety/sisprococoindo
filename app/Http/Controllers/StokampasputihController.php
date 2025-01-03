<?php

namespace App\Http\Controllers;

use App\Models\StokAmpasKeringPutih;
use Illuminate\Http\Request;


class StokampasputihController extends Controller
{
   
    public function index()
    {
       
        $stokampaskeringputihs = StokAmpasKeringPutih::orderBy('tanggal', 'asc')->orderBy('id', 'asc')->get();
        return view('card_stock.ampas_kering_putih', compact('stokampaskeringputihs'));
    }
    public function store(Request $request)
    {
        
        $request->validate([
            'id_laporan_santan' => 'nullable|string|max:255',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
            'activity_type' => 'required|string|max:255',
            'stok' => 'required|numeric',
            'kategori' => 'nullable|string|in:fine,medium',
        ]);
    
       
        StokAmpasKeringPutih::create([
           'id_laporan_santan' => $request->id_laporan_santan,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'activity_type' => $request->activity_type,
            'stok' => $request->stok,
            'kategori' => $request->kategori,
            'begin' => 0, // Akan dihitung ulang
            'in_fine' => $request->kategori === 'fine' ? $request->stok : 0,
            'in_medium' => $request->kategori === 'medium' ? $request->stok : 0,
            'out' => in_array($request->activity_type, ['ekspor', 'penjualan']) ? $request->stok : 0,
            'remain' => 0, // Akan dihitung ulang
        ]);
    
       
        $this->recalculateStock();
    
        return redirect()->route('card_stock.ampas_kering_putih.index')
            ->with('success', 'Data berhasil ditambahkan');
    }
    private function recalculateStock()
    {
       
        $allEntries = StokAmpasKeringPutih::orderBy('tanggal', 'asc')
            ->orderBy('id', 'asc')
            ->get();
    
        $current_remain = 0; 
    
      
        foreach ($allEntries as $row) {
            $begin = $current_remain; 
            $in_fine = $row->in_fine;
            $in_medium = $row->in_medium;
            $out = $row->out;
    
         
            $remain = $begin + $in_fine + $in_medium - $out;
    
         
            $row->update([
                'begin' => $begin,
                'remain' => $remain,
            ]);
    
           
            $current_remain = $remain;
        }
    }
    public function update(Request $request, $id)
    {
       
        $request->validate([
            'id_laporan_santan' => 'nullable|string|max:255',
            'tanggal' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'activity_type' => 'required|string|max:255',
            'stok' => 'required|numeric',
            'kategori' => 'nullable|string|in:fine,medium',
        ]);
    
       
        $stokampaskeringputih = StokAmpasKeringPutih::findOrFail($id);
    
       
        $stokampaskeringputih->update([
            'id_laporan_santan' => $request->id_laporan_santan,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'activity_type' => $request->activity_type,
            'stok' => $request->stok,
            'kategori' => $request->kategori,
            'in_fine' => $request->kategori === 'fine' ? $request->stok : 0,
            'in_medium' => $request->kategori === 'medium' ? $request->stok : 0,
            'out' => in_array($request->activity_type, ['ekspor', 'penjualan']) ? $request->stok : 0,
        ]);
    
        
        $this->recalculateStock();
    
        return redirect()->route('card_stock.ampas_kering_putih.index')
            ->with('success', 'Data berhasil diperbarui ');
    }

    public function edit($id)
    {
        $laporan = StokAmpasKeringPutih::findOrFail($id);

        return response()->json([
            'id_laporan_santan' => $laporan->id_laporan_santan,
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
    
    $stokampaskeringputih = StokAmpasKeringPutih::findOrFail($id);

    
    $stokampaskeringputih->delete();

    
    $allEntries = StokAmpasKeringPutih::orderBy('id', 'asc')->get();
    $current_remain = 0; 

    
    foreach ($allEntries as $row) {
        $begin = $current_remain;
        $in_fine = $row->in_fine;
        $in_medium = $row->in_medium;
        $out = $row->out;

       
        $remain = $begin + $in_fine + $in_medium - $out;

        
        $row->update([
            'begin' => $begin,
            'remain' => $remain,
        ]);

        
        $current_remain = $remain;
    }

    return redirect()->route('card_stock.ampas_kering_putih.index')->with('success', 'Data berhasil dihapus');
}
}