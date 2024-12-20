<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporandkp;

class LaporandkpController extends Controller
{
    public function index()
    {
        $laporandkps = Laporandkp::all()->map(function ($item) {
            $item->sheller_count = Laporandkp::where('nama_sheller', $item->nama_sheller)->count();
            return $item;
        });
        return view('laporan.dkp', compact('laporandkps'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'id_kelapa_bulat' => 'nullable|string|max:255',
            'no' => 'nullable|string|max:255',
            'tanggal' => 'nullable|string|max:255',
            'nama_sheller' => 'nullable|string|max:255',
            'nama_parer' => 'nullable|string|max:255',
            'hasil_kerja_parer' => 'nullable|array',
            'hasil_kerja_parer.*' => 'nullable|numeric',
            'timbangan_hasil_kerja_parer' => 'nullable|numeric',
            'hasil_kerja_sheller' => 'nullable|string|max:255',
            'total_keranjang' => 'nullable|string|max:255',
            'tipe_keranjang' => 'nullable|string|max:255',
            'berat_keranjang' => 'nullable|string|max:255',
            'total_potongan_keranjang' => 'nullable|string|max:255',
        ]);

        // Simpan data ke database
        Laporandkp::create([
            'id_kelapa_bulat' => $request->id_kelapa_bulat,
            'no' => $request->no,
            'tanggal' => $request->tanggal,
            'nama_sheller' => $request->nama_sheller,
            'nama_parer' => $request->nama_parer,
            'hasil_kerja_parer' => json_encode($request->hasil_kerja_parer),
            'timbangan_hasil_kerja_parer' => $request->timbangan_hasil_kerja_parer,
            'hasil_kerja_sheller' => $request->hasil_kerja_sheller,
            'total_keranjang' => $request->total_keranjang,
            'tipe_keranjang' => $request->tipe_keranjang,
            'berat_keranjang' => $request->berat_keranjang,
            'total_potongan_keranjang' => $request->total_potongan_keranjang,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('laporan.dkp.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $laporan = Laporandkp::findOrFail($id);

        return response()->json([
            'id' => $laporan->id,
            'nama_sheller' => $laporan->nama_sheller,
            'tanggal' => $laporan->tanggal,
            'nama_parer' => $laporan->nama_parer,
            'total_keranjang' => $laporan->total_keranjang,
            'tipe_keranjang' => $laporan->tipe_keranjang,
            'hasil_kerja_parer' => json_decode($laporan->hasil_kerja_parer, true), // Pastikan tipe data sesuai
        ]);
    }

    public function destroy($id)
    {
        $laporandkp = Laporandkp::findOrFail($id);
        $laporandkp->delete();

        return redirect()->route('laporan.dkp.index')->with('success', 'Data berhasil dihapus!');
    }
}
