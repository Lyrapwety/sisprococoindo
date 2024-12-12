<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporandkp;

class LaporandkpController extends Controller
{
    public function index()
    {
        $laporandkps = Laporandkp::all();

        return view('laporan.dkp', compact('laporandkps'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nama_sheller' => 'required|string',
            'nama_parer' => 'required|string',
            'total_keranjang' => 'required|string',
            'tipe_keranjang' => 'required|string',
            'hasil_kerja_parer' => 'required|string',
        ]);

        Laporandkp::create($request->all());

        return redirect()->route('laporan.dkp.index')->with('success', 'Record created successfully!');
    }

    public function edit($id)
    {
        $laporandkp = Laporandkp::findOrFail($id);

        return response()->json($laporandkp);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nama_sheller' => 'required|string',
            'nama_parer' => 'required|string',
            'total_keranjang' => 'required|string',
            'tipe_keranjang' => 'required|string',
            'hasil_kerja_parer' => 'required|string',
        ]);

        $laporandkp = Laporandkp::findOrFail($id);
        $laporandkp->update($request->all());

        return redirect()->route('laporan.dkp.index')->with('success', 'Record updated successfully!');
    }

    public function destroy($id)
    {
        Laporandkp::findOrFail($id)->delete();

        return redirect()->route('laporan.dkp.index')->with('success', 'Record deleted successfully!');
    }
}
