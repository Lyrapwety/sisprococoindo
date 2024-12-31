<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokSantan;

class StoksantanController extends Controller
{
    public function index()
    {
        // Mengurutkan berdasarkan tanggal dan ID
        $stoksantans = StokSantan::orderBy('tanggal', 'asc')->orderBy('id', 'asc')->get();
        return view('card_stock.santan', compact('stoksantans'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'id_laporan_dkp' => 'nullable|string|max:255',
            'tanggal' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'activity_type' => 'required|string|max:255',
            'making_product' => 'nullable|numeric',
            'jumlah' => 'nullable|numeric',
            'jenis_berat' => 'nullable|string|max:255',
            'fat' => 'nullable|numeric',
            'ph' => 'nullable|numeric',
        ]);

        $activity_type = $request->activity_type;
        $making_product = $request->making_product;
        $jumlah = $request->jumlah;  // Jumlah box
        $in_bags = 0;
        $in_box = 0;
        $remain = 0;
        $out = 0;
        $begin = StokSantan::latest()->value('remain') ?? 0;

        // Logika berdasarkan tipe aktivitas
        if ($activity_type === 'produksi') {
            $in_box = $jumlah;
            $remain = $begin + $in_box; // perhitungan untuk produksi
        } elseif ($activity_type === 'ekspor') {
            $out = $jumlah;
            $remain = $begin - $out; // perhitungan untuk ekspor
        } else {
            return redirect()->back()->withErrors(['activity_type' => 'Tipe aktivitas tidak valid!']);
        }

        $jenisBerat = $request->jenis_berat;

        // Kalkulasi berat berdasarkan jenis berat yang dipilih
        $remain_kg = 0;
        $calculated_bags = 0;

        if ($jenisBerat == "5KG") {
            $remain_kg = $in_box * 20;  
            $calculated_bags = $remain_kg / 5;
        } elseif ($jenisBerat == "4KG") {
            $remain_kg = $in_box * 20;
            $calculated_bags = $remain_kg / 4;
        } elseif ($jenisBerat == "3KG") {
            $remain_kg = $in_box * 20;
            $calculated_bags = $remain_kg / 3;
        } elseif ($jenisBerat == "2KG") {
            $remain_kg = $in_box * 20;
            $calculated_bags = $remain_kg / 2;
        } elseif ($jenisBerat == "1KG") {
            $remain_kg = $in_box * 18;
            $calculated_bags = $remain_kg / 1;
        }

        // Kalkulasi in_bags yang sesuai dengan jenis berat yang dipilih
        $in_bags = $calculated_bags;

        // Simpan data ke database
        StokSantan::create([
            'id_laporan_dkp' => $request->id_laporan_dkp,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'activity_type' => $activity_type,
            'making_product' => $making_product,
            'jenis_berat' => $jenisBerat,
            'jumlah' => $jumlah,
            'fat' => $request->fat,
            'ph' => $request->ph,
            'begin' => $begin,
            'in_bags' => $in_bags,
            'in_box' => $in_box,
            'remain' => $remain,
            'out' => $out,
            'catatan' => $request->catatan,
            'remain_kg' => $remain_kg,
            'calculated_bags' => $calculated_bags,
        ]);

        // Recalculate semua stok setelah penambahan
        $this->recalculateRemains();

        return redirect()->route('card_stock.santan.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'id_laporan_dkp' => 'nullable|string|max:255',
            'tanggal' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'activity_type' => 'required|string|max:255',
            'making_product' => 'nullable|numeric',
            'jumlah' => 'nullable|numeric',
            'jenis_berat' => 'nullable|string|max:255',
            'fat' => 'nullable|numeric',
            'ph' => 'nullable|numeric',
        ]);

        // Temukan data yang sedang diedit
        $laporan = StokSantan::findOrFail($id);
        $old_remain = $laporan->remain;  // Menyimpan nilai remain lama sebelum diubah

        // Perbarui data berdasarkan inputan pengguna
        $activity_type = $request->activity_type;
        $jumlah = $request->jumlah;
        $remain = $old_remain; // Tetap menggunakan remain lama sebelum perubahan

        if ($activity_type === 'produksi') {
            $remain += $jumlah; // Tambah stok jika produksi
        } elseif ($activity_type === 'ekspor') {
            $remain -= $jumlah; // Kurangi stok jika ekspor
        }

        // Kalkulasi jenis berat yang dipilih
        $jenisBerat = $request->jenis_berat;
        $remain_kg = 0;
        $calculated_bags = 0;

        if ($jenisBerat == "5KG") {
            $remain_kg = $jumlah * 20;  
            $calculated_bags = $remain_kg / 5;
        } elseif ($jenisBerat == "4KG") {
            $remain_kg = $jumlah * 20;
            $calculated_bags = $remain_kg / 4;
        } elseif ($jenisBerat == "3KG") {
            $remain_kg = $jumlah * 20;
            $calculated_bags = $remain_kg / 3;
        } elseif ($jenisBerat == "2KG") {
            $remain_kg = $jumlah * 20;
            $calculated_bags = $remain_kg / 2;
        } elseif ($jenisBerat == "1KG") {
            $remain_kg = $jumlah * 18;
            $calculated_bags = $remain_kg / 1;
        }

        // Perbarui data di database
        $laporan->update($request->only([
            'id_laporan_dkp', 
            'tanggal' ,
            'keterangan' ,
            'activity_type' ,
            'making_product' ,
            'jenis_berat' ,
            'jumlah',
            'fat',
            'ph' ,
            'remain' ,
            'remain_kg' ,
            'calculated_bags',
           ]));

        // Recalculate semua stok setelah pembaruan
        $this->recalculateRemains();

        return redirect()->route('card_stock.santan.index')->with('success', 'Data berhasil diperbarui!');
    }

    protected function recalculateRemains()
{
    // Ambil semua data yang diurutkan berdasarkan tanggal dan ID
    $entries = StokSantan::orderBy('tanggal', 'asc')->orderBy('id', 'asc')->get();

    $remain = 0;

    foreach ($entries as $entry) {
        // Set nilai awal begin sebagai remain sebelumnya
        $entry->begin = $remain;

        // Perhitungan stok berdasarkan aktivitas
        if ($entry->activity_type === 'produksi') {
            $remain += $entry->in_box;  // Tambahkan in_box untuk produksi
        } elseif ($entry->activity_type === 'ekspor') {
            $remain -= $entry->out;  // Kurangi out untuk ekspor
        }

        // Update nilai remain
        $entry->update([
            'remain' => $remain,
            'begin' => $entry->begin,
        ]);
    }
}

    public function edit($id)
    {
        // Temukan data berdasarkan ID
        $laporan = StokSantan::findOrFail($id);

        // Kembalikan data dalam format JSON
        return response()->json([
            'id_laporan_dkp' => $laporan->id_laporan_dkp,
            'tanggal' => $laporan->tanggal,
            'keterangan' => $laporan->keterangan,
            'activity_type' => $laporan->activity_type,
            'making_product' => $laporan->making_product,
            'jumlah' => $laporan->jumlah,
            'jenis_berat' => $laporan->jenis_berat,
            'fat' => $laporan->fat,
            'ph' => $laporan->ph,
        ]);
    }
public function destroy($id)
    {
        // Hapus entri berdasarkan ID
        $stoksantan = StokSantan::findOrFail($id);
        $stoksantan->delete();
    
        // Recalculate remain dan begin
        $this->recalculateRemains();
    
        return redirect()->route('card_stock.santan.index')->with('success', 'Data berhasil dihapus!');
    }
}