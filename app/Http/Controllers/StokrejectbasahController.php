<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokDkpRejectBasah;

class StokrejectbasahController extends Controller
{
    public function index()
    {
        $stokrejectbasahs = StokDkpRejectBasah::all();
        return view('card_stock.dkp_reject_basah', compact('stokrejectbasahs'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'id_laporan_dkp_reject_basah' => 'nullable|string|max:255',
            'tanggal' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'activity_type' => 'required|string|max:255',
            'stok' => 'required|numeric',
        ]);

        $stok = $request->stok;
        $activity_type = $request->activity_type;

        $last_remain = StokDkpRejectBasah::latest()->value('remain') ?? 0;

        $begin = $last_remain;
        $in = 0;
        $out = 0;
        $remain = $begin;

        switch ($activity_type) {
            case 'reject':
                $in = $stok;
                $remain = $begin + $in;
                break;

            case 'produksi':
            case 'penjualan':
                $out = $stok;
                $remain = $begin - $out;

                // Validasi jika remain negatif
                if ($remain < 0) {
                    return redirect()->back()->withErrors(['stok' => 'Stok tidak mencukupi untuk aktivitas ini!']);
                }
                break;

            default:
                // Aktivitas tidak valid
                return redirect()->back()->withErrors(['activity_type' => 'Tipe aktivitas tidak valid!']);
        }

        // Simpan data ke database
        StokDkpRejectBasah::create([
            'id_laporan_dkp_reject_basah' => $request->id_laporan_dkp_reject_basah,
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
        return redirect()->route('card_stock.dkp_reject_basah.index')->with('success', 'Data berhasil ditambahkan!');
    }


    public function edit($id)
    {
        // Find the record by its ID
        $laporan = StokDkpRejectBasah::findOrFail($id);

        // Return the data in JSON format
        return response()->json([
            'id_laporan_dkp_reject_basah' => $laporan->id_laporan_dkp_reject_basah,
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

    public function update(Request $request, $id)
{
    // Validasi data
    $request->validate([
        'id_laporan_dkp_reject_basah' => 'nullable|string|max:255',
        'tanggal' => 'nullable|string|max:255',
        'keterangan' => 'nullable|string|max:255',
        'activity_type' => 'required|string|max:255',
        'stok' => 'required|numeric',
    ]);

    // Temukan stok berdasarkan ID
    $stokrejectbasah = StokDkpRejectBasah::findOrFail($id);

    // Ambil data stok dan tipe aktivitas
    $stok = $request->stok;
    $activity_type = $request->activity_type;

    // Ambil sisa stok terakhir (remain) dari record yang akan diupdate
    $last_remain = $stokrejectbasah->remain;

    // Inisialisasi nilai awal
    $begin = $last_remain; // Nilai awal adalah stok terakhir
    $in = 0;
    $out = 0;
    $remain = $begin; // Default remain sama dengan begin

    // Logika berdasarkan tipe aktivitas
    switch ($activity_type) {
        case 'reject':
            // Aktivitas menambah stok
            $in = $stok;
            $remain = $begin + $in; // Tambah stok ke remain
            break;

        case 'produksi':
        case 'penjualan':
            // Aktivitas mengurangi stok
            $out = $stok;
            $remain = $begin - $out; // Kurangi stok dari remain

            // Validasi jika remain negatif
            if ($remain < 0) {
                return redirect()->back()->withErrors(['stok' => 'Stok tidak mencukupi untuk aktivitas ini!']);
            }
            break;

        default:
            // Aktivitas tidak valid
            return redirect()->back()->withErrors(['activity_type' => 'Tipe aktivitas tidak valid!']);
    }

    // Perbarui data stok
    $stokrejectbasah->update([
        'id_laporan_dkp_reject_basah' => $request->id_laporan_dkp_reject_basah,
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
    return redirect()->route('card_stock.dkp_reject_basah.index')->with('success', 'Data berhasil diperbarui!');
}

    public function destroy($id)
    {
        $stokrejectbasah = StokDkpRejectBasah::findOrFail($id);
        $stokrejectbasah->delete();

        return redirect()->route('card_stock.dkp_reject_basah.index')->with('success', 'Data berhasil dihapus!');
    }
}
