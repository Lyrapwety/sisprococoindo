<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanKulitAriBasah;

class RekapkulitariController extends Controller
{
    public function index()
    {
        // Ambil semua data dan proses kategori timbangan
        $rekapkulitaris = LaporanKulitAriBasah::all()->map(function ($item) {
            $categories = $this->calculateCategories($item->timbangan_hasil);
            $totalPendapatan = $this->calculateTotalPendapatan($categories);

            return [
                'id_kelapa_bulat' => $item->id_kelapa_bulat,
                'no' => $item->no,
                'tanggal' => $item->tanggal,
                'nama_pegawai' => $item->nama_pegawai,
                'sheller_parer' => $item->sheller_parer,
                'bruto' => $item->bruto,
                'total_keranjang' => $item->total_keranjang,
                'tipe_keranjang' => $item->tipe_keranjang,
                'berat_keranjang' => $item->berat_keranjang,
                'total_potongan_keranjang' => $item->total_potongan_keranjang,
                'hasil_kerja' => json_decode($item->hasil_kerja, true),
                'timbangan_hasil' => $item->timbangan_hasil,
                'lessThan300' => $categories['lessThan300'],
                'between300And350' => $categories['between300And350'],
                'greaterThan350' => $categories['greaterThan350'],
                'totalPendapatan' => $totalPendapatan, // Pendapatan total
            ];
        });

        // Kirim data ke view
        return view('rekap_laporan.pembukaan_kulit_ari', compact('rekapkulitaris'));
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

        // Simpan data ke database
        LaporanKulitAriBasah::create([
            'id_kelapa_bulat' => $request->id_kelapa_bulat,
            'no' => $request->no,
            'tanggal' => $request->tanggal,
            'nama_pegawai' => $request->nama_pegawai,
            'sheller_parer' => $request->sheller_parer,
            'bruto' => $request->bruto,
            'total_keranjang' => $request->total_keranjang,
            'tipe_keranjang' => $request->tipe_keranjang,
            'berat_keranjang' => $request->berat_keranjang,
            'total_potongan_keranjang' => $request->total_potongan_keranjang,
            'hasil_kerja' => json_encode($request->hasil_kerja),
            'timbangan_hasil' => $request->timbangan_hasil,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('rekap_laporan.pembukaan_kulit_ari.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Hitung kategori berdasarkan nilai timbangan hasil.
     */
    private function calculateCategories($value)
    {
        $lessThan300 = 0;
        $between300And350 = 0;
        $greaterThan350 = 0;

        if ($value <= 300) {
            $lessThan300 = $value;
        } elseif ($value > 300 && $value <= 350) {
            $lessThan300 = 300;
            $between300And350 = $value - 300;
        } else {
            $lessThan300 = 300;
            $between300And350 = 50;
            $greaterThan350 = $value - 350;
        }

        return [
            'lessThan300' => $lessThan300,
            'between300And350' => $between300And350,
            'greaterThan350' => $greaterThan350,
        ];
    }

    /**
     * Hitung total pendapatan.
     */
    private function calculateTotalPendapatan($categories)
    {
        $lessThan300Pendapatan = $categories['lessThan300'] * 400;
        $between300And350Pendapatan = $categories['between300And350'] * 500;
        $greaterThan350Pendapatan = $categories['greaterThan350'] * 600;

        // Total pendapatan dengan tambahan 3
        $totalPendapatan = $lessThan300Pendapatan + $between300And350Pendapatan + $greaterThan350Pendapatan + 3;

        return number_format($totalPendapatan, 2, ',', '.'); // Format ke Rp.xxx.xxx,xx
    }
}
