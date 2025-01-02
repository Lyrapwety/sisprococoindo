<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanDkpRejectBasah;

class LaporandkprejectController extends Controller
{
    public function index()
    {
        $laporandkprejects = LaporanDkpRejectBasah::orderBy('tanggal', 'asc')->orderBy('id', 'asc')->get();
        foreach ($laporandkprejects as $laporan) {
            $laporan->timbangan_netto = $laporan->bruto - $laporan->total_potongan_keranjang;
        }
        return view('laporan.dkp_reject', compact('laporandkprejects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kelapa_bulat' => 'nullable|string|max:255',
            'tanggal' => 'required|date',
            'nama_pegawai' => 'required|string|max:255',
            'sheller_parer' => 'nullable|string|max:255',
            'bruto' => 'required|numeric',
            'total_keranjang' => 'required|numeric',
            'tipe_keranjang' => 'required|string|max:255',
            'berat_keranjang' => 'required|numeric',
            'hasil_kerja_netto' => 'nullable|array',
            'hasil_kerja_netto.*' => 'nullable|numeric',
        ]);

        $nilaiPotongan = 0;
        if ($request->tipe_keranjang === 'Keranjang Besar') {
            $nilaiPotongan = 3.8;
        } elseif ($request->tipe_keranjang === 'Keranjang Kecil') {
            $nilaiPotongan = 1.3;
        }

        $potonganKeranjang = $nilaiPotongan * $request->total_keranjang;
        $timbangan_netto = $request->bruto - $potonganKeranjang;

        LaporanDkpRejectBasah::create([
            'id_kelapa_bulat' => $request->id_kelapa_bulat,
            'tanggal' => $request->tanggal,
            'nama_pegawai' => $request->nama_pegawai,
            'sheller_parer' => $request->sheller_parer,
            'bruto' => $request->bruto,
            'total_keranjang' => $request->total_keranjang,
            'tipe_keranjang' => $request->tipe_keranjang,
            'berat_keranjang' => $request->berat_keranjang,
            'total_potongan_keranjang' => $potonganKeranjang,
            'hasil_kerja_netto' => json_encode($request->hasil_kerja_netto),
            'timbangan_netto' => $timbangan_netto,
        ]);

        return redirect()->route('laporan.dkp_reject.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kelapa_bulat' => 'nullable|string|max:255',
            'tanggal' => 'required|date',
            'nama_pegawai' => 'required|string|max:255',
            'sheller_parer' => 'nullable|string|max:255',
            'bruto' => 'required|numeric',
            'total_keranjang' => 'required|numeric',
            'tipe_keranjang' => 'required|string|max:255',
            'berat_keranjang' => 'required|numeric',
            'hasil_kerja_netto' => 'nullable|array',
            'hasil_kerja_netto.*' => 'nullable|numeric',
        ]);

        $laporan = LaporanDkpRejectBasah::findOrFail($id);

        $nilaiPotongan = 0;
        if ($request->tipe_keranjang === 'Keranjang Besar') {
            $nilaiPotongan = 3.8;
        } elseif ($request->tipe_keranjang === 'Keranjang Kecil') {
            $nilaiPotongan = 1.3;
        }

        $potonganKeranjang = $nilaiPotongan * $request->total_keranjang;
        $timbangan_netto = $request->bruto - $potonganKeranjang;

        $laporan->update([
            'id_kelapa_bulat' => $request->id_kelapa_bulat,
            'tanggal' => $request->tanggal,
            'nama_pegawai' => $request->nama_pegawai,
            'sheller_parer' => $request->sheller_parer,
            'bruto' => $request->bruto,
            'total_keranjang' => $request->total_keranjang,
            'tipe_keranjang' => $request->tipe_keranjang,
            'berat_keranjang' => $request->berat_keranjang,
            'total_potongan_keranjang' => $potonganKeranjang,
            'hasil_kerja_netto' => json_encode($request->hasil_kerja_netto),
            'timbangan_netto' => $timbangan_netto,
        ]);

        return redirect()->route('laporan.dkp_reject.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function edit($id)
    {
        $laporan = LaporanDkpRejectBasah::findOrFail($id);

        $nilaiPotongan = ($laporan->tipe_keranjang === 'Keranjang Besar') ? 3.8 : 1.3;
        $potonganKeranjang = $nilaiPotongan * $laporan->total_keranjang;
        $timbangan_netto = $laporan->bruto - $potonganKeranjang;

        return response()->json([
            'id' => $laporan->id,
            'nama_pegawai' => $laporan->nama_pegawai,
            'sheller_parer' => $laporan->sheller_parer,
            'tanggal' => $laporan->tanggal,
            'bruto' => $laporan->bruto,
            'total_keranjang' => $laporan->total_keranjang,
            'total_potongan_keranjang' => $potonganKeranjang,
            'tipe_keranjang' => $laporan->tipe_keranjang,
            'hasil_kerja_netto' => json_decode($laporan->hasil_kerja_netto, true),
            'timbangan_netto' => $timbangan_netto,
        ]);
    }

    public function destroy($id)
    {
        $laporandkpreject = LaporanDkpRejectBasah::findOrFail($id);
        $laporandkpreject->delete();

        return redirect()->route('laporan.dkp_reject.index')->with('success', 'Data berhasil dihapus!');
    }
}
