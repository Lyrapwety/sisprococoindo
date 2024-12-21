<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokTempurungBasah;

class StoktempurungbasahController extends Controller
{
    public function index()
    {
        $stoktempurungs = StokTempurungBasah::all();
        return view('card_stock.tempurung_basah', compact('stoktempurungs'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'id_laporan_tempurung_basah' => 'nullable|string|max:255',
            'tanggal' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'activity_type' => 'required|string|max:255', // Aktivitas wajib dipilih
            'stok' => 'required|numeric', // Stok wajib dan harus numerik
        ]);

        // Ambil jumlah stok dan tipe aktivitas
        $stok = $request->stok;
        $activity_type = $request->activity_type;

        // Inisialisasi nilai begin, in, out, dan remain
        $begin = 0;
        $in = 0;
        $out = 0;
        $remain = 0;

        // Logika berdasarkan tipe aktivitas
        switch ($activity_type) {
            case 'hasil_produksi':
                // Stok bertambah, hanya mengisi 'in', 'out' kosong
                $in = $stok;
                $begin = $in;
                $remain = $begin; // Sisa adalah stok awal
                break;

            case 'pengambilan':
                // Stok bertambah dari PT lain, hanya mengisi 'in', 'out' kosong
                $in = $stok;
                $begin = $in;
                $remain = $begin; // Sama seperti hasil produksi
                break;

            case 'pemakaian_produksi':
                // Stok berkurang, hanya mengisi 'out', 'in' kosong
                $out = $stok;
                $begin = StokTempurungBasah::latest()->value('remain') ?? 0; // Ambil sisa stok terakhir
                $remain = $begin - $out; // Sisa stok setelah dikurangi pemakaian
                break;

            case 'reject':
                // Stok berkurang karena reject, hanya mengisi 'out', 'in' kosong
                $out = $stok;
                $begin = StokTempurungBasah::latest()->value('remain') ?? 0; // Ambil sisa stok terakhir
                $remain = $begin - $out; // Sisa stok setelah dikurangi reject
                break;

            default:
                return redirect()->back()->withErrors(['activity_type' => 'Tipe aktivitas tidak valid!']);
        }

        // Simpan data ke database
        StokTempurungBasah::create([
            'id_laporan_tempurung_basah' => $request->id_laporan_tempurung_basah,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'activity_type' => $activity_type,
            'stok' => $stok,
            'begin' => $begin,
            'in' => $in,
            'out' => $out,
            'remain' => $remain,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('card_stock.tempurung_basah.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // Find the record by its ID
        $laporan = StokTempurungBasah::findOrFail($id);

        // Return the data in JSON format
        return response()->json([
            'id_laporan_tempurung_basah' => $laporan->id_laporan_dkp,
            'tanggal' => $laporan->tanggal,
            'keterangan' => $laporan->keterangan,
            'activity_type' => $laporan->activity_type,
            'stok' => $laporan->stok,
            'begin' => $laporan->begin,
            'in' => $laporan->in,
            'out' => $laporan->out,
            'remain' => $laporan->remain,
        ]);
    }


    public function destroy($id)
    {
        $stoktempurung = StokTempurungBasah::findOrFail($id);
        $stoktempurung->delete();

        return redirect()->route('card_stock.tempurung_basah.index')->with('success', 'Data berhasil dihapus!');
    }
}
