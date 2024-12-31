<?php

namespace App\Http\Controllers;

use App\Models\StokAmpasKeringPutih;
use Illuminate\Http\Request;


class StokampasputihController extends Controller
{
    // Menampilkan daftar stok
    public function index()
    {
        // Ambil semua data, urutkan berdasarkan tanggal
        $stokampaskeringputihs = StokAmpasKeringPutih::orderBy('tanggal', 'asc')->orderBy('id', 'asc')->get();
        return view('card_stock.ampas_kering_putih', compact('stokampaskeringputihs'));
    }
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'id_laporan_santan' => 'nullable|string|max:255',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
            'activity_type' => 'required|string|max:255',
            'stok' => 'required|numeric',
            'kategori' => 'nullable|string|in:fine,medium',
        ]);
    
        // Tambahkan entri baru ke database
        StokAmpasKeringPutih::create([
           'id_laporan_santan' => $request->id_laporan_santan,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'activity_type' => $request->activity_type,
            'stok' => $request->stok,
            'kategori' => $request->kategori,
            'begin' => 0, // Akan dihitung ulang
            'in_fine' => $request->kategori === 'fine' ? $request->stok : 0,
            'in_medium' => $request->kategori === 'medium' ? $request->stok : 0,
            'out' => in_array($request->activity_type, ['ekspor', 'penjualan']) ? $request->stok : 0,
            'remain' => 0, // Akan dihitung ulang
        ]);
    
        // Panggil metode untuk menghitung ulang stok
        $this->recalculateStock();
    
        return redirect()->route('card_stock.ampas_kering_putih.index')
            ->with('success', 'Data berhasil ditambahkan');
    }
    private function recalculateStock()
    {
        // Ambil semua entri yang diurutkan berdasarkan tanggal
        $allEntries = StokAmpasKeringPutih::orderBy('tanggal', 'asc')
            ->orderBy('id', 'asc')
            ->get();
    
        $current_remain = 0; // Inisialisasi remain awal
    
        // Hitung ulang begin dan remain untuk setiap entri
        foreach ($allEntries as $row) {
            $begin = $current_remain; // Begin adalah remain dari entri sebelumnya
            $in_fine = $row->in_fine;
            $in_medium = $row->in_medium;
            $out = $row->out;
    
            // Hitung remain baru
            $remain = $begin + $in_fine + $in_medium - $out;
    
            // Perbarui entri
            $row->update([
                'begin' => $begin,
                'remain' => $remain,
            ]);
    
            // Perbarui nilai remain untuk entri berikutnya
            $current_remain = $remain;
        }
    }public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'id_laporan_santan' => 'nullable|string|max:255',
            'tanggal' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'activity_type' => 'required|string|max:255',
            'stok' => 'required|numeric',
            'kategori' => 'nullable|string|in:fine,medium',
        ]);
    
        // Temukan stok berdasarkan ID
        $stokampaskeringputih = StokAmpasKeringPutih::findOrFail($id);
    
        // Perbarui data entri ini
        $stokampaskeringputih->update([
            'id_laporan_santan' => $request->id_laporan_santan,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'activity_type' => $request->activity_type,
            'stok' => $request->stok,
            'kategori' => $request->kategori,
            'in_fine' => $request->kategori === 'fine' ? $request->stok : 0,
            'in_medium' => $request->kategori === 'medium' ? $request->stok : 0,
            'out' => in_array($request->activity_type, ['ekspor', 'penjualan']) ? $request->stok : 0,
        ]);
    
        // Panggil metode untuk menghitung ulang stok dari awal
        $this->recalculateStock();
    
        return redirect()->route('card_stock.ampas_kering_putih.index')
            ->with('success', 'Data berhasil diperbarui ');
    }

    public function edit($id)
    {
        $laporan = StokAmpasKeringPutih::findOrFail($id);

        return response()->json([
            'id_laporan_santan' => $laporan->id_laporan_santan,
            'tanggal' => $laporan->tanggal,
            'keterangan' => $laporan->keterangan,
            'activity_type' => $laporan->activity_type,
            'stok' => $laporan->stok,
            'begin' => $laporan->begin,
            'kategori' => $laporan->kategori,
            'in_fine' => $laporan->in_fine,
            'in_medium' => $laporan->in_medium,
            'out' => $laporan->out,
            'remain' => $laporan->remain,
        ]);
    }

    // Menghapus data stok// Menghapus data stok
public function destroy($id)
{
    // Temukan stok berdasarkan ID
    $stokampaskeringputih = StokAmpasKeringPutih::findOrFail($id);

    // Hapus entri stok
    $stokampaskeringputih->delete();

    // Ambil semua entri yang ada saat ini
    $allEntries = StokAmpasKeringPutih::orderBy('id', 'asc')->get();
    $current_remain = 0; // Inisialisasi remain awal

    // Hitung ulang begin dan remain untuk setiap entri
    foreach ($allEntries as $row) {
        $begin = $current_remain; // Begin adalah remain dari entri sebelumnya
        $in_fine = $row->in_fine;
        $in_medium = $row->in_medium;
        $out = $row->out;

        // Hitung remain baru
        $remain = $begin + $in_fine + $in_medium - $out;

        // Perbarui entri
        $row->update([
            'begin' => $begin,
            'remain' => $remain,
        ]);

        // Update nilai remain terbaru
        $current_remain = $remain;
    }

    return redirect()->route('card_stock.ampas_kering_putih.index')->with('success', 'Data berhasil dihapus');
}
}