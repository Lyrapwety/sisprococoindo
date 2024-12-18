<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanKulitAriBasah;

class LaporankulitariController extends Controller
{
    public function index()
    {
        $laporankulitaris = LaporanKulitAriBasah::all();
        return view('laporan.kulitari', compact('laporankulitaris'));
    }

    public function store(Request $request)
        {
            // Validasi data
            $request->validate([
                'id_kelapa_bulat' => 'nullable|string|max:255',
                'no' => 'nullable|string|max:255',
                'tanggal' => 'nullable|string|max:255',
                'nama_pegawai' => 'nullable|string|max:255',
                'sheller_parer' => 'nullable|string|max:255',
                'bruto' => 'nullable|string|max:255',
                'total_keranjang' => 'nullable|string|max:255',
                'tipe_keranjang' => 'nullable|string|max:255',
                'berat_keranjang' => 'nullable|string|max:255',
                'total_potongan_keranjang' => 'nullable|string|max:255',
                'hasil_kerja' => 'nullable|array',
                'hasil_kerja.*' => 'nullable|numeric',
                'timbangan_hasil' => 'nullable|numeric',
            ]);

            // Simpan data ke database
            LaporanKulitAriBasah::create([
                'id_kelapa_bulat' => $request->id_kelapa_bulat,
                'no' => $request->no,
                'tanggal' => $request->tanggal,
                'nama_pegawai' => $request->nama_pegawai,
                'sheller_parer' => $request->sheller_parer,
                'bruto' => $request->bruto,
                'total_keranjang' => $request->total_keranjang,
                'tipe_keranjang' => $request->tipe_keranjang,
                'berat_keranjang' => $request->berat_keranjang,
                'total_potongan_keranjang' => $request->total_potongan_keranjang,
                'hasil_kerja' => json_encode($request->hasil_kerja),
                'timbangan_hasil' => $request->timbangan_hasil,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('laporan.kulitari.index')->with('success', 'Data berhasil ditambahkan!');
        }



        public function destroy($id)
        {
            $laporandkp = LaporanKulitAriBasah::findOrFail($id);
            $laporandkp->delete();

            return redirect()->route('laporan.kulitari.index')->with('success', 'Data berhasil dihapus!');
        }
}
