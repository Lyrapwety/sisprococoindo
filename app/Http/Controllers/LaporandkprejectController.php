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
            'bruto' => 'nullable|string|max:255',
            'total_keranjang' => 'nullable|string|max:255',
            'tipe_keranjang' => 'nullable|string|max:255',
            'berat_keranjang' => 'nullable|string|max:255',
            'total_potongan_keranjang' => 'nullable|string|max:255',
            'hasil_kerja_netto' => 'nullable|string|max:255',
        ]);

        // Simpan data ke database
        LaporanDkpRejectBasah::create([
            'id_kelapa_bulat' => $request->id_kelapa_bulat,
            'tanggal' => $request->tanggal,
            'nama_pegawai' => $request->nama_pegawai,
            'sheller_parer' => $request->sheller_parer,
            'bruto' => $request->bruto,
            'total_keranjang' => $request->total_keranjang,
            'tipe_keranjang' => $request->tipe_keranjang,
            'berat_keranjang' => $request->berat_keranjang,
            'total_potongan_keranjang' => $request->total_potongan_keranjang,
            'hasil_kerja_netto' => $request->hasil_kerja_netto,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('laporan.dkp_reject.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $laporandkpreject = LaporanDkpRejectBasah::findOrFail($id);
        $laporandkpreject->delete();

        return redirect()->route('laporan.dkp_reject.index')->with('success', 'Data berhasil dihapus!');
    }
}
