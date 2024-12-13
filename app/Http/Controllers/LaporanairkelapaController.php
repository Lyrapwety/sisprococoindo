<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanAirKelapa;

class LaporanairkelapaController extends Controller
{
    public function index()
    {
        $laporanairkelapas = LaporanAirKelapa::all();
        return view('laporan.airkelapa', compact('laporanairkelapas'));
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
        'tipe_keranjnag' => 'nullable|string|max:255',
        'berat_keranjang' => 'nullable|string|max:255',
        'total_potongan_keranjang' => 'nullable|string|max:255',
        'hasil_kerja' => 'nullable|string|max:255',
    ]);

    // Simpan data ke database
    LaporanAirKelapa::create([
        'id_kelapa_bulat' => $request->id_kelapa_bulat,
        'tanggal' => $request->tanggal,
        'nama_pegawai' => $request->nama_pegawai,
        'sheller_parer' => $request->sheller_parer,
        'bruto' => $request->bruto,
        'total_keranjang' => $request->total_keranjang,
        'tipe_keranjnag' => $request->tipe_keranjnag,
        'berat_keranjang' => $request->berat_keranjang,
        'total_potongan_keranjang' => $request->total_potongan_keranjang,
        'hasil_kerja' => $request->hasil_kerja,
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('laporan.airkelapa.index')->with('success', 'Data berhasil ditambahkan!');
}

public function destroy($id)
        {
            $laporandkp = LaporanAirKelapa::findOrFail($id);
            $laporandkp->delete();

            return redirect()->route('laporan.airkelapa.index')->with('success', 'Data berhasil dihapus!');
        }

}
