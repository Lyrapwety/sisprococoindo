<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokAmpasKeringYellow;

class StokampasyellowController extends Controller
{
   
    public function index()
    {
       
        $stokampaskeringyellows = StokAmpasKeringYellow::orderBy('tanggal', 'asc')->orderBy('id', 'asc')->get();
        return view('card_stock.ampas_kering_yellow', compact('stokampaskeringyellows'));
    }
    public function store(Request $request)
    {
        
        $request->validate([
            'id_stok_ampas_kering_putih' => 'nullable|string|max:255',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
            'activity_type' => 'required|string|max:255',
            'stok' => 'required|numeric',
            'kategori' => 'nullable|string|in:fine,medium',
        ]);
    
       
        StokAmpasKeringYellow::create([
            'id_stok_ampas_kering_putih' => $request->id_stok_ampas_kering_putih,
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
    
        return redirect()->route('card_stock.ampas_kering_yellow.index')
            ->with('success', 'Data berhasil ditambahkan dan stok dihitung ulang!');
    }
    private function recalculateStock()
    {
        
        $allEntries = StokAmpasKeringYellow::orderBy('tanggal', 'asc')
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
    }public function update(Request $request, $id)
    {
        
        $request->validate([
            'id_stok_ampas_kering_putih' => 'nullable|string|max:255',
            'tanggal' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'activity_type' => 'required|string|max:255',
            'stok' => 'required|numeric',
            'kategori' => 'nullable|string|in:fine,medium',
        ]);
    
      
        $stokampaskeringyellow = StokAmpasKeringYellow::findOrFail($id);
    
       
        $stokampaskeringyellow->update([
            'id_stok_ampas_kering_putih' => $request-> id_stok_ampas_kering_putih,
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
    
        return redirect()->route('card_stock.ampas_kering_yellow.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    public function edit($id)
    {
        $laporan = StokAmpasKeringYellow::findOrFail($id);

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

   
    $allEntries = StokAmpasKeringYellow::orderBy('id', 'asc')->get();
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

    return redirect()->route('card_stock.ampas_kering_yellow.index')->with('success', 'Data berhasil dihapus dan stok dihitung ulang!');
}
}