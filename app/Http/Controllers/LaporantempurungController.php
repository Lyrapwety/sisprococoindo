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
    // Validasi data
    $request->validate([
        'id_kelapa_bulat' => 'nullable|string|max:255',
        'no' => 'nullable|string|max:255',
        'tanggal' => 'nullable|string|max:255',
        'bruto' => 'nullable|string|max:255',
        'tipe_keranjang' => 'nullable|string|max:255',
        'total_keranjang' => 'nullable|string|max:255',
        'total_potongan_keranjang' => 'nullable|string|max:255',
        'netto' => 'nullable|array',
        'netto.*' => 'nullable|numeric',
        'timbangan_netto' => 'nullable|numeric',
    ]);

    // Simpan data ke database
    LaporanTempurungBasah::create([
        'id_kelapa_bulat' => $request->id_kelapa_bulat,
        'no' => $request->no,
        'tanggal' => $request->tanggal,
        'bruto' => $request->bruto,
        'tipe_keranjang' => $request->tipe_keranjang,
        'total_keranjang' => $request->total_keranjang,
        'total_potongan_keranjang' => $request->total_potongan_keranjang,
        'netto' => json_encode($request->netto),
        'timbangan_netto' => $request->timbangan_netto,
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('laporan.tempurung.index')->with('success', 'Data berhasil ditambahkan!');
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
            'netto' => json_decode($laporan->netto, true), // Decode JSON field
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
