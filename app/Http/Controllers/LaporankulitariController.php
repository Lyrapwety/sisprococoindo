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

            $bruto = $request->total_keranjang * 1.1;

            $potonganKeranjang = $request->total_keranjang - $request->timbangan_netto;

            // Simpan data ke database
            LaporanKulitAriBasah::create([
                'id_kelapa_bulat' => $request->id_kelapa_bulat,
                'no' => $request->no,
                'tanggal' => $request->tanggal,
                'nama_pegawai' => $request->nama_pegawai,
                'sheller_parer' => $request->sheller_parer,
                'bruto' => $bruto,
                'total_keranjang' => $request->total_keranjang,
                'tipe_keranjang' => $request->tipe_keranjang,
                'berat_keranjang' => $request->berat_keranjang,
                'total_potongan_keranjang' => $potonganKeranjang,
                'hasil_kerja' => json_encode($request->hasil_kerja),
                'timbangan_hasil' => $request->timbangan_hasil,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('laporan.kulitari.index')->with('success', 'Data berhasil ditambahkan!');
        }

        public function edit($id)
        {
            $laporan = LaporanKulitAriBasah::findOrFail($id);

            return response()->json([
                'id' => $laporan->id,
                'id_kelapa_bulat' => $laporan->id_kelapa_bulat,
                'no' => $laporan->no,
                'tanggal' => $laporan->tanggal,
                'nama_pegawai' => $laporan->nama_pegawai,
                'sheller_parer' => $laporan->sheller_parer,
                'bruto' => $laporan->bruto,
                'total_keranjang' => $laporan->total_keranjang,
                'tipe_keranjang' => $laporan->tipe_keranjang,
                'berat_keranjang' => $laporan->berat_keranjang,
                'total_potongan_keranjang' => $laporan->total_potongan_keranjang,
                'hasil_kerja' => json_decode($laporan->hasil_kerja, true), // Decode JSON field
                'timbangan_hasil' => $laporan->timbangan_hasil,
            ]);
        }




        public function destroy($id)
        {
            $laporandkp = LaporanKulitAriBasah::findOrFail($id);
            $laporandkp->delete();

            return redirect()->route('laporan.kulitari.index')->with('success', 'Data berhasil dihapus!');
        }
}
