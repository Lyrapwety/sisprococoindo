<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProduksiAirKelapa;

class ProduksiairkelapaController extends Controller
{
    public function index()
    {
        $produksiairkelapas = ProduksiAirKelapa::orderBy('tanggal', 'asc')->orderBy('id', 'asc')->get();
        return view('produksi.air_kelapa', compact('produksiairkelapas'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'id_air_kelapa' => 'nullable|string|max:255',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
            'activity_type' => 'required|string|max:255',
            'sn' => 'nullable|string|max:255', // steril atau nonsteril
            'bags' => 'required|numeric', // Wajib input angka
        ]);

        $activity_type = $request->activity_type;
        $sn = $request->sn;
        $bags = $request->bags;
        $bags_calculated = $bags * 5;

        // Inisialisasi variabel
        $begin = ProduksiAirKelapa::latest()->value('remain') ?? 0; // Sisa stok terakhir
        $in_steril = 0;
        $in_nonsteril = 0;
        $out_rep = 0;
        $out_eks = 0;
        $out_adj = 0;
        $remain = $begin;

        // Logika berdasarkan tipe aktivitas
        switch ($activity_type) {
            case 'produksi':
                if ($sn === 'steril') {
                    $in_steril = $bags_calculated;
                } elseif ($sn === 'nonsteril') {
                    $in_nonsteril = $bags_calculated;
                }
                $remain += $bags_calculated;
                break;

            case 'adjust':
                $out_adj = $bags_calculated;
                $remain -= $bags_calculated;
                break;

            case 'ekspor':
                $out_eks = $bags_calculated;
                $remain -= $bags_calculated;
                break;

            case 'reproses':
                $out_rep = $bags_calculated;
                $remain -= $bags_calculated;
                break;

            default:
                return redirect()->back()->withErrors(['activity_type' => 'Tipe aktivitas tidak valid!']);
            
        }

        // Simpan data ke database
        ProduksiAirKelapa::create([
            'id_air_kelapa' => $request->id_air_kelapa,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'activity_type' => $activity_type,
            'fat' => $request->fat,
            'ph' => $request->ph,
            'sn' => $sn,
            'briz' => $request->briz,
            'bags' => $bags,
            'in_steril' => $in_steril,
            'in_nonsteril' => $in_nonsteril,
            'begin' => $begin,
            'out_rep' => $out_rep,
            'out_eks' => $out_eks,
            'out_adj' => $out_adj,
            'remain' => $remain,
        ]);

        $this->recalculateRemains();

        // Redirect dengan pesan sukses
        return redirect()->route('produksi.air_kelapa.index')->with('success', 'Data berhasil ditambahkan!');
    }

    protected function recalculateRemains()
    {
        // Ambil semua data yang diurutkan berdasarkan tanggal dan ID
        $entries = ProduksiAirKelapa::orderBy('tanggal', 'asc')->orderBy('id', 'asc')->get();

        $remain = 0;

        foreach ($entries as $entry) {
            // Set nilai awal begin sebagai remain sebelumnya
            $entry->begin = $remain;

            // Perhitungan stok berdasarkan aktivitas
            $in_steril = $entry->in_steril ?? 0;
            $in_nonsteril = $entry->in_nonsteril ?? 0;
            $out_total = ($entry->out_rep ?? 0) + ($entry->out_eks ?? 0) + ($entry->out_adj ?? 0);

            // Tambahkan atau kurangi remain berdasarkan data
            $remain += $in_steril + $in_nonsteril - $out_total;

            // Update nilai remain
            $entry->update([
                'remain' => $remain,
                'begin' => $entry->begin,
            ]);
        }
    }

    public function destroy($id)
    {
        $produksiairkelapa = ProduksiAirKelapa::findOrFail($id);
        $produksiairkelapa->delete();

        // Panggil ulang recalculateRemains
        $this->recalculateRemains();

        return redirect()->route('produksi.air_kelapa.index')->with('success', 'Data berhasil dihapus!');
    }
}
