<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokKulitAriKering;

class StokarikeringController extends Controller
{
    public function index()
    {
        $stokarikerings = StokKulitAriKering::orderBy('tanggal', 'asc')->orderBy('id', 'asc')->get();
        return view('card_stock.kulit_ari_kering', compact('stokarikerings'));
    }

    public function store(Request $request)
{
    
    $request->validate([
        'id_laporan_kulit_ari_basah' => 'nullable|string|max:255',
        'tanggal' => 'nullable|string|max:255',
        'remark' => 'nullable|string|max:255',
        'activity_type' => 'required|string|max:255',
        'stok' => 'required|numeric', 
    ]);
    $newEntry = StokKulitAriKering::create($request->only([
        'id_laporan_kulit_ari_basah',
        'tanggal',
        'remark',
        'activity_type',
        'stok',
    ]));
    
      
      $this->recalculateRemains();

      return redirect()->route('card_stock.kulit_ari_kering.index')->with('success', 'Data berhasil ditambahkan!');
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

      $stokarikering = StokKulitAriKering::findOrFail($id);

    
      $stokarikering->update($request->only([
          'id_laporan_kulit_ari_basah',
          'tanggal',
          'remark',
          'activity_type',
          'stok',
      ]));

     
      $this->recalculateRemains();

      return redirect()->route('card_stock.kulit_ari_kering.index')->with('success', 'Data berhasil diperbarui!');
  }

  protected function recalculateRemains()
  {
      
      $entries = StokKulitAriKering::orderBy('tanggal', 'asc')->orderBy('id', 'asc')->get();

      $lastRemain = 0;

      foreach ($entries as $entry) {
       
          $begin = $lastRemain;
          $in = $entry->activity_type === 'produksi' ? $entry->stok : 0;
          $out = in_array($entry->activity_type, [ 'penjualan' ]) ? $entry->stok : 0;
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
      
      $laporan = StokKulitAriKering::findOrFail($id);

     
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
      $stokarikering = StokKulitAriKering::findOrFail($id);
      $stokarikering->delete();

      
      $this->recalculateRemains();

      return redirect()->route('card_stock.kulit_ari_kering.index')->with('success', 'Data berhasil dihapus!');
  }
}