<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporandkp;

class LaporandkpController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $laporandkps = Laporandkp::query();

        if ($search) {
            $laporandkps->where(function ($query) use ($search) {
                $query->where('tanggal', 'like', '%' . $search . '%')
                    ->orWhere('nama_sheller', 'like', '%' . $search . '%')
                    ->orWhere('nama_parer', 'like', '%' . $search . '%');
            });
        }

        $laporandkps = $laporandkps->get()->map(function ($item) {
            $item->sheller_count = Laporandkp::where('nama_sheller', $item->nama_sheller)->count();
            return $item;
        });

        if ($request->ajax()) {
            return response()->json(['data' => $laporandkps]);
        }

        return view('laporan.dkp', compact('laporandkps'));
    }



    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'id_kelapa_bulat' => 'nullable|string|max:255',
            'no' => 'nullable|string|max:255',
            'tanggal' => 'nullable|string|max:255',
            'nama_sheller' => 'nullable|string|max:255',
            'nama_parer' => 'nullable|string|max:255',
            'hasil_kerja_parer' => 'nullable|array',
            'hasil_kerja_parer.*' => 'nullable|numeric',
            'timbangan_hasil_kerja_parer' => 'nullable|numeric',
            'hasil_kerja_sheller' => 'nullable|string|max:255',
            'total_keranjang' => 'nullable|string|max:255',
            'tipe_keranjang' => 'nullable|string|max:255',
            'berat_keranjang' => 'nullable|string|max:255',
            'total_potongan_keranjang' => 'nullable|string|max:255',
        ]);

        $berat_per_keranjang = 0;
        if ($request->tipe_keranjang == 'Keranjang Besar') {
            $berat_per_keranjang = 3.8;
        } elseif ($request->tipe_keranjang == 'Keranjang Kecil') {
            $berat_per_keranjang = 1.3;
        }

        $total_potongan_keranjang = $request->total_keranjang * $berat_per_keranjang;

        // Here is where you might need to loop through a certain array (for example, if you're processing `hasil_kerja_parer`)
        $i = 0; // Initialize $i before the loop
        foreach ($request->hasil_kerja_parer as $value) {
            // Perform any necessary logic using $i as the index
            // For example, you could store something or do further calculations
            $i++;
        }

        Laporandkp::create([
            'id_kelapa_bulat' => $request->id_kelapa_bulat,
            'no' => $request->no,
            'tanggal' => $request->tanggal,
            'nama_sheller' => $request->nama_sheller,
            'nama_parer' => $request->nama_parer,
            'hasil_kerja_parer' => json_encode($request->hasil_kerja_parer),
            'timbangan_hasil_kerja_parer' => $request->timbangan_hasil_kerja_parer,
            'hasil_kerja_sheller' => $request->hasil_kerja_sheller,
            'total_keranjang' => $request->total_keranjang,
            'tipe_keranjang' => $request->tipe_keranjang,
            'berat_keranjang' => $berat_per_keranjang,
            'total_potongan_keranjang' => $total_potongan_keranjang,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('laporan.dkp.index')->with('success', 'Data berhasil ditambahkan!');
    }
    




    public function show($id)
    {
        $laporan = Laporandkp::findOrFail($id);

        return response()->json([
            'id' => $laporan->id,
            'nama_parer' => $laporan->nama_parer,
            'potongan_keranjang' => [
                [
                    'jumlah' => 1,
                    'berat' => 2,
                    'total' => 3,
                ],
            ],
        ]);
    }


    public function edit($id)
    {
        $laporan = Laporandkp::findOrFail($id);

        $berat_per_keranjang = 0;
        if ($laporan->tipe_keranjang == 'Keranjang Besar') {
            $berat_per_keranjang = 3.8;
        } elseif ($laporan->tipe_keranjang == 'Keranjang Kecil') {
            $berat_per_keranjang = 1.3;
        }

        return response()->json([
            'id' => $laporan->id,
            'nama_sheller' => $laporan->nama_sheller,
            'nama_parer' => $laporan->nama_parer,
            'tanggal' => $laporan->tanggal,
            'total_keranjang' => $laporan->total_keranjang,
            'berat_keranjang' => $berat_per_keranjang,
            'total_potongan_keranjang' => $laporan->total_potongan_keranjang,
            'tipe_keranjang' => $laporan->tipe_keranjang,
            'hasil_kerja_parer' => json_decode($laporan->hasil_kerja_parer, true),
            'timbangan_hasil_kerja_parer' => $laporan->timbangan_hasil_kerja_parer,
        ]);
    }




    public function destroy($id)
    {
        $laporandkp = Laporandkp::findOrFail($id);
        $laporandkp->delete();

        return redirect()->route('laporan.dkp.index')->with('success', 'Data berhasil dihapus!');
    }
}
