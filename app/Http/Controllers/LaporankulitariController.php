<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanKulitAriBasah;

class LaporankulitariController extends Controller
{
    public function index()
    {
        $laporankulitaris = LaporanKulitAriBasah::orderBy('tanggal', 'asc')->orderBy('id', 'asc')->get();
    

        foreach ($laporankulitaris as $laporan) {
            $laporan->timbangan_hasil = $laporan->bruto - $laporan->total_potongan_keranjang;
        }
    
        return view('laporan.kulitari', compact('laporankulitaris'));
    }
    public function store(Request $request)
        {
          
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

            $nilaiPotongan = 0;
            if ($request->tipe_keranjang === 'Keranjang Besar') {
                $nilaiPotongan = 3.8;
            } elseif ($request->tipe_keranjang === 'Keranjang Kecil') {
                $nilaiPotongan = 1.3;
            }
    
            $bruto = $request->timbangan_hasil;
            $potonganKeranjang = $nilaiPotongan * $request->total_keranjang;
            $timbangan_hasil = $bruto - $potonganKeranjang;
           
       
            LaporanKulitAriBasah::create([
                'id_kelapa_bulat' => $request->id_kelapa_bulat,
                'no' => $request->no,
                'tanggal' => $request->tanggal,
                'nama_pegawai' => $request->nama_pegawai,
                'sheller_parer' => $request->sheller_parer,
                'bruto' => $bruto,
                'total_keranjang' => $request->total_keranjang,
                'tipe_keranjang' => $request->tipe_keranjang,
                'berat_keranjang' => $request->berat_keranjang,
                'total_potongan_keranjang' => $potonganKeranjang,
                'hasil_kerja' => json_encode($request->hasil_kerja),
                'timbangan_hasil' => $timbangan_hasil,
            ]);

       
            return redirect()->route('laporan.kulitari.index')->with('success', 'Data berhasil ditambahkan!');
        }

        public function update(Request $request, $id)
{

    $request->validate([
        'id_kelapa_bulat' => 'nullable|string|max:255',
        'no' => 'nullable|string|max:255',
        'tanggal' => 'nullable|string|max:255',
        'nama_pegawai' => 'nullable|string|max:255',
        'sheller_parer' => 'nullable|string|max:255',
        'total_keranjang' => 'nullable|string|max:255',
        'tipe_keranjang' => 'nullable|string|max:255',
        'berat_keranjang' => 'nullable|string|max:255',
        'hasil_kerja' => 'nullable|array',
        'hasil_kerja.*' => 'nullable|numeric',
        'timbangan_hasil' => 'nullable|numeric',
    ]);

 
    $laporan = LaporanKulitAriBasah::findOrFail($id);

   $nilaiPotongan = 0;
   if ($request->tipe_keranjang === 'Keranjang Besar') {
       $nilaiPotongan = 3.8;
   } elseif ($request->tipe_keranjang === 'Keranjang Kecil') {
       $nilaiPotongan = 1.3;
   }
   $bruto = $request->timbangan_hasil;
   $potonganKeranjang = $nilaiPotongan * $request->total_keranjang;
   $timbangan_hasil = $bruto - $potonganKeranjang;
 
   
    $laporan->update([
        'id_kelapa_bulat' => $request->id_kelapa_bulat,
        'no' => $request->no,
        'tanggal' => $request->tanggal,
        'nama_pegawai' => $request->nama_pegawai,
        'sheller_parer' => $request->sheller_parer,
        'bruto' => $bruto,
        'total_keranjang' => $request->total_keranjang,
        'tipe_keranjang' => $request->tipe_keranjang,
        'berat_keranjang' => $request->berat_keranjang,
        'total_potongan_keranjang' => $potonganKeranjang,
        'hasil_kerja' => json_encode($request->hasil_kerja),
        'timbangan_hasil' => $timbangan_hasil,
    ]);

 
    return redirect()->route('laporan.kulitari.index')->with('success', 'Data berhasil diperbarui!');
}

        public function edit($id)
        {
            $laporan = LaporanKulitAriBasah::findOrFail($id);

            return response()->json([
                'id' => $laporan->id,
                'id_kelapa_bulat' => $laporan->id_kelapa_bulat,
                'no' => $laporan->no,
                'tanggal' => $laporan->tanggal,
                'nama_pegawai' => $laporan->nama_pegawai,
                'sheller_parer' => $laporan->sheller_parer,
                'bruto' => $laporan->bruto,
                'total_keranjang' => $laporan->total_keranjang,
                'tipe_keranjang' => $laporan->tipe_keranjang,
                'berat_keranjang' => $laporan->berat_keranjang,
                'total_potongan_keranjang' => $laporan->total_potongan_keranjang,
                'hasil_kerja' => json_decode($laporan->hasil_kerja, true), 
                'timbangan_hasil' => $laporan->timbangan_hasil,
            ]);
        }

        public function destroy($id)
        {
            $laporandkp = LaporanKulitAriBasah::findOrFail($id);
            $laporandkp->delete();

            return redirect()->route('laporan.kulitari.index')->with('success', 'Data berhasil dihapus!');
        }
}
