<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokKulitAriKering;

class StokarikeringController extends Controller
{
    public function index()
    {
        $stokarikerings = StokKulitAriKering::all();
        return view('card_stock.kulit_ari_kering', compact('stokarikerings'));
    }

    public function store(Request $request)
{
    // Validasi data
    $request->validate([
        'id_laporan_kulit_ari_basah' => 'nullable|string|max:255',
        'tanggal' => 'nullable|string|max:255',
        'remark' => 'nullable|string|max:255',
        'activity_type' => 'required|string|max:255',
        'stok' => 'required|numeric', // Stok wajib dan harus numerik
    ]);

    // Ambil jumlah stok dan tipe aktivitas
    $stok = $request->stok;
    $activity_type = $request->activity_type;

    // Ambil sisa stok terakhir (remain) atau default ke 0 jika tidak ada data sebelumnya
    $last_remain = StokKulitAriKering::latest()->value('remain') ?? 0;

    $begin = $last_remain;
    $in = 0;
    $out = 0;
    $remain = $begin;

    switch ($activity_type) {
        case 'hasil_produksi':
        case 'pengambilan':
            $in = $stok;
            $remain = $begin + $in;
            break;

        case 'pemakaian_produksi':
        case 'reject':
            $out = $stok;
            $remain = $begin - $out;

            if ($remain < 0) {
                return redirect()->back()->withErrors(['stok' => 'Stok tidak mencukupi untuk aktivitas ini!']);
            }
            break;

        default:
            return redirect()->back()->withErrors(['activity_type' => 'Tipe aktivitas tidak valid!']);
    }

    // Simpan data ke database
    StokKulitAriKering::create([
        'id_laporan_kulit_ari_basah' => $request->id_laporan_kulit_ari_basah,
        'tanggal' => $request->tanggal,
        'remark' => $request->remark,
        'activity_type' => $activity_type,
        'stok' => $stok,
        'begin' => $begin,
        'in' => $in,
        'out' => $out,
        'remain' => $remain,
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('card_stock.kulit_ari_kering.index')->with('success', 'Data berhasil ditambahkan!');
}

public function update(Request $request, $id)
{
    // Validasi data
    $request->validate([
        'id_laporan_kulit_ari_basah' => 'nullable|string|max:255',
        'tanggal' => 'nullable|string|max:255',
        'remark' => 'nullable|string|max:255',
        'activity_type' => 'required|string|max:255',
        'stok' => 'required|numeric', // Stok wajib dan harus numerik
    ]);

    // Temukan stok berdasarkan ID
    $stokarikering = StokKulitAriKering::findOrFail($id);

    // Ambil jumlah stok dan tipe aktivitas
    $stok = $request->stok;
    $activity_type = $request->activity_type;

    // Ambil sisa stok terakhir (remain) dari record yang akan diupdate
    $last_remain = $stokarikering->remain;

    // Inisialisasi nilai begin, in, out, dan remain
    $begin = $last_remain; // Begin adalah stok terakhir sebelumnya
    $in = 0;
    $out = 0;
    $remain = $begin; // Default remain sama dengan begin

    // Logika berdasarkan tipe aktivitas
    switch ($activity_type) {
        case 'hasil_produksi':
        case 'pengambilan':
            // Aktivitas menambah stok
            $in = $stok;
            $remain = $begin + $in; // Tambah stok ke remain
            break;

        case 'pemakaian_produksi':
        case 'reject':
            // Aktivitas mengurangi stok
            $out = $stok;
            $remain = $begin - $out; // Kurangi stok dari remain

            // Validasi jika remain negatif
            if ($remain < 0) {
                return redirect()->back()->withErrors(['stok' => 'Stok tidak mencukupi untuk aktivitas ini!']);
            }
            break;

        default:
            return redirect()->back()->withErrors(['activity_type' => 'Tipe aktivitas tidak valid!']);
    }

    // Perbarui data stok
    $stokarikering->update([
        'id_laporan_kulit_ari_basah' => $request->id_laporan_kulit_ari_basah,
        'tanggal' => $request->tanggal,
        'remark' => $request->remark,
        'activity_type' => $activity_type,
        'stok' => $stok,
        'begin' => $begin,
        'in' => $in,
        'out' => $out,
        'remain' => $remain,
    ]);

    // Redirect dengan pesan sukses
    return redirect()->route('card_stock.kulit_ari_kering.index')->with('success', 'Data berhasil diperbarui!');
}

    public function edit($id)
    {
        // Find the record by its ID
        $laporan = StokKulitAriKering::findOrFail($id);

        // Return the data in JSON format
        return response()->json([
            'id_laporan_kulit_ari_basah' => $laporan->id_laporan_kulit_ari_basah,
            'tanggal' => $laporan->tanggal,
            'remark' => $laporan->remark,
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
        $stokarikering = StokKulitAriKering::findOrFail($id);
        $stokarikering->delete();

        return redirect()->route('card_stock.kulit_ari_kering.index')->with('success', 'Data berhasil dihapus!');
    }
}
