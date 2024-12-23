<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelapabulat;
use Carbon\Carbon;

class KelapabulatController extends Controller
{
    public function index(Request $request)
{
    $tanggal = $request->query('tanggal'); // Ambil parameter tanggal
    $stokkelapabulats = Kelapabulat::query();

    if ($tanggal) {
        $stokkelapabulats->where('tanggal', $tanggal); // Filter berdasarkan tanggal
    }

    // Ambil data stok
    $stokkelapabulats = $stokkelapabulats->get();

    // Hitung jumlah qty untuk tanggal hari ini menggunakan string
    $totalQtyToday = Kelapabulat::where('tanggal', Carbon::today()->toDateString())->sum('qty');

    return view('card_stock.kelapa_bulat', compact('stokkelapabulats', 'totalQtyToday'));
}



    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'nullable|date',
            'keterangan' => 'nullable|string|max:255',
            'shift' => 'nullable|string|max:255',
            'stop' => 'nullable|string|max:255',
            'keranjang' => 'nullable|string|max:255',
            'kbtanggalsupplier' => 'nullable|string|max:255',
            'jam' => 'nullable|string|max:255',
            'qty' => 'nullable|string|max:255',
            'begin' => 'nullable|string|max:255',
            'in' => 'nullable|string|max:255',
            'out' => 'nullable|string|max:255',
            'remain' => 'nullable|string|max:255',
        ]);

        // Simpan ke database
        Kelapabulat::create([
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'shift' => $request->shift,
            'stop' => $request->stop,
            'keranjang' => $request->keranjang,
            'kbtanggalsupplier' => $request->kbtanggalsupplier,
            'jam' => $request->jam,
            'qty' => $request->qty,
            'begin' => $request->begin,
            'in' => $request->in,
            'out' => $request->out,
            'remain' => $request->remain,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('card_stock.kelapa_bulat.index')->with('success', 'Data berhasil ditambahkan.');
    }
}
