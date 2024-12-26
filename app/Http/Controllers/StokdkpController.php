<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokDkp;

class StokdkpController extends Controller
{
    public function index()
    {
        $stokdkps = StokDkp::all();
        return view('card_stock.dkp', compact('stokdkps'));
    }

    public function store(Request $request)
{
    // Validasi data
    $request->validate([
        'id_laporan_dkp' => 'nullable|string|max:255',
        'tanggal' => 'nullable|string|max:255',
        'keterangan' => 'nullable|string|max:255',
        'activity_type' => 'required|string|max:255', // Aktivitas wajib dipilih
        'stok' => 'required|numeric', // Stok wajib dan harus numerik
    ]);

    // Ambil jumlah stok dan tipe aktivitas
    $stok = $request->stok;
    $activity_type = $request->activity_type;

    // Ambil sisa stok terakhir (remain) atau default ke 0 jika tidak ada data sebelumnya
    $last_remain = StokDkp::latest()->value('remain') ?? 0;

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

    // Simpan data ke database
    StokDkp::create([
        'id_laporan_dkp' => $request->id_laporan_dkp,
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
    return redirect()->route('card_stock.dkp.index')->with('success', 'Data berhasil ditambahkan!');
}

public function update(Request $request, $id)
{
    // Validasi data
    $request->validate([
        'id_laporan_dkp' => 'nullable|string|max:255',
        'tanggal' => 'nullable|string|max:255',
        'keterangan' => 'nullable|string|max:255',
        'activity_type' => 'required|string|max:255', // Aktivitas wajib dipilih
        'stok' => 'required|numeric', // Stok wajib dan harus numerik
    ]);

    // Temukan stok berdasarkan ID
    $stokdkp = StokDkp::findOrFail($id);

    // Ambil jumlah stok dan tipe aktivitas
    $stok = $request->stok;
    $activity_type = $request->activity_type;

    // Ambil sisa stok terakhir (remain) dari record yang akan diupdate
    $last_remain = $stokdkp->remain;

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
    $stokdkp->update([
        'id_laporan_dkp' => $request->id_laporan_dkp,
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
    return redirect()->route('card_stock.dkp.index')->with('success', 'Data berhasil diperbarui!');
}

    public function edit($id)
    {
        // Find the record by its ID
        $laporan = StokDkp::findOrFail($id);

        // Return the data in JSON format
        return response()->json([
            'id_laporan_dkp' => $laporan->id_laporan_dkp,
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
        $stokdkp = StokDkp::findOrFail($id);
        $stokdkp->delete();

        return redirect()->route('card_stock.dkp.index')->with('success', 'Data berhasil dihapus!');
    }
}
