<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanDkpRejectBasah;

class LaporandkprejectController extends Controller
{
    public function index()
    {
        $laporandkprejects = LaporanDkpRejectBasah::all();
        return view('laporan.dkp_reject', compact('laporandkprejects'));
    }

    public function store(Request $request)
{
    // Validasi data
    $request->validate([
        'id_kelapa_bulat' => 'nullable|string|max:255',
        'tanggal' => 'nullable|string|max:255',
        'nama_pegawai' => 'nullable|string|max:255',
        'sheller_parer' => 'nullable|string|max:255',
        'bruto' => 'nullable|string|max:255', // Tidak perlu diisi karena dihitung otomatis
        'total_keranjang' => 'nullable|string|max:255',
        'tipe_keranjang' => 'nullable|string|max:255',
        'berat_keranjang' => 'nullable|string|max:255',
        'total_potongan_keranjang' => 'nullable|string|max:255', // Tidak perlu diisi karena dihitung otomatis
        'hasil_kerja_netto' => 'nullable|array',
        'hasil_kerja_netto.*' => 'nullable|numeric',
        'timbangan_netto' => 'nullable|numeric',
    ]);

    $bruto = $request->total_keranjang * 1.1;

    $potonganKeranjang = $request->total_keranjang - $request->timbangan_netto; 

    // Simpan data ke database
    LaporanDkpRejectBasah::create([
        'id_kelapa_bulat' => $request->id_kelapa_bulat,
        'tanggal' => $request->tanggal,
        'nama_pegawai' => $request->nama_pegawai,
        'sheller_parer' => $request->sheller_parer,
        'bruto' => $bruto,
        'total_keranjang' => $request->total_keranjang,
        'tipe_keranjang' => $request->tipe_keranjang,
        'berat_keranjang' => $request->berat_keranjang,
        'total_potongan_keranjang' => $potonganKeranjang,
        'hasil_kerja_netto' => json_encode($request->hasil_kerja_netto),
        'timbangan_netto' => $request->timbangan_netto,
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('laporan.dkp_reject.index')->with('success', 'Data berhasil ditambahkan!');
}


    public function edit($id)
    {
        $laporan = LaporanDkpRejectBasah::findOrFail($id);

        return response()->json([
            'id' => $laporan->id,
            'nama_pegawai' => $laporan->nama_pegawai,
            'sheller_parer' => $laporan->sheller_parer,
            'tanggal' => $laporan->tanggal,
            'total_keranjang' => $laporan->total_keranjang,
            'tipe_keranjang' => $laporan->tipe_keranjang,
            'hasil_kerja_netto' => json_decode($laporan->hasil_kerja_netto, true), // Pastikan tipe data sesuai
        ]);
    }


    public function destroy($id)
    {
        $laporandkpreject = LaporanDkpRejectBasah::findOrFail($id);
        $laporandkpreject->delete();

        return redirect()->route('laporan.dkp_reject.index')->with('success', 'Data berhasil dihapus!');
    }
}
