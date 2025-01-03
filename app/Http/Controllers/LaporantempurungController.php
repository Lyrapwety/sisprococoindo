<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanTempurungBasah;

class LaporantempurungController extends Controller
{
    public function index()
    {
        $laporantempurungs = LaporanTempurungBasah::all();
        return view('laporan.tempurung', compact('laporantempurungs'));
    }

    public function store(Request $request)
    {
     
        $request->validate([
            'id_kelapa_bulat' => 'nullable|string|max:255',
            'no' => 'nullable|string|max:255',
            'tanggal' => 'nullable|string|max:255',
            'bruto' => 'nullable|numeric',
            'tipe_keranjang' => 'nullable|string|max:255',
            'total_keranjang' => 'nullable|numeric',
            'timbangan_netto' => 'nullable|numeric',
        ]);

        $nilaiPotongan = 0;
        if ($request->tipe_keranjang === 'Keranjang Besar') {
            $nilaiPotongan = 3.8;
        } elseif ($request->tipe_keranjang === 'Keranjang Kecil') {
            $nilaiPotongan = 1.3;
        }

        $bruto = $request->timbangan_netto;
        $potonganKeranjang = $nilaiPotongan * $request->total_keranjang;
        $netto = $bruto - $potonganKeranjang;


        LaporanTempurungBasah::create([
            'id_kelapa_bulat' => $request->id_kelapa_bulat,
            'no' => $request->no,
            'tanggal' => $request->tanggal,
            'bruto' => $bruto,
            'tipe_keranjang' => $request->tipe_keranjang,
            'total_keranjang' => $request->total_keranjang,
            'total_potongan_keranjang' => $potonganKeranjang,
            'netto' => $netto,
            'timbangan_netto' => $request->timbangan_netto,
        ]);

    
        return redirect()->route('laporan.tempurung.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
{
   
    $request->validate([
        'id_kelapa_bulat' => 'nullable|string|max:255',
        'no' => 'nullable|string|max:255',
        'tanggal' => 'nullable|string|max:255',
        'bruto' => 'nullable|numeric',
        'tipe_keranjang' => 'nullable|string|max:255',
        'total_keranjang' => 'nullable|numeric',
        'timbangan_netto' => 'nullable|numeric',
    ]);


    $laporan = LaporanTempurungBasah::findOrFail($id);


    $nilaiPotongan = 0;
    if ($request->tipe_keranjang === 'Keranjang Besar') {
        $nilaiPotongan = 3.8;
    } elseif ($request->tipe_keranjang === 'Keranjang Kecil') {
        $nilaiPotongan = 1.3;
    }

    $bruto = $request->timbangan_netto;
    $potonganKeranjang = $nilaiPotongan * $request->total_keranjang;
    $netto = $bruto - $potonganKeranjang;

    $laporan->update([
        'id_kelapa_bulat' => $request->id_kelapa_bulat,
        'no' => $request->no,
        'tanggal' => $request->tanggal,
        'bruto' => $bruto,
        'tipe_keranjang' => $request->tipe_keranjang,
        'total_keranjang' => $request->total_keranjang,
        'total_potongan_keranjang' => $potonganKeranjang,
        'netto' => $netto,
        'timbangan_netto' => $request->timbangan_netto,
    ]);

 
    return redirect()->route('laporan.tempurung.index')->with('success', 'Data berhasil diperbarui!');
}

    public function edit($id)
    {
        $laporan = LaporanTempurungBasah::findOrFail($id);

        return response()->json([
            'id' => $laporan->id,
            'id_kelapa_bulat' => $laporan->id_kelapa_bulat,
            'no' => $laporan->no,
            'tanggal' => $laporan->tanggal,
            'bruto' => $laporan->bruto,
            'tipe_keranjang' => $laporan->tipe_keranjang,
            'total_keranjang' => $laporan->total_keranjang,
            'total_potongan_keranjang' => $laporan->total_potongan_keranjang,
            'netto' => json_decode($laporan->netto, true), 
            'timbangan_netto' => $laporan->timbangan_netto,
        ]);
    }

    public function destroy($id)
        {
            $laporandkp = LaporanTempurungBasah::findOrFail($id);
            $laporandkp->delete();

            return redirect()->route('laporan.tempurung.index')->with('success', 'Data berhasil dihapus!');
        }
}
