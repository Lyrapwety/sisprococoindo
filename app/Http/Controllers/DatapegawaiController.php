<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;

class DatapegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::all();
        return view('data_pegawai', compact('pegawais'));
    }

    public function tambah_data_pegawai()
    {
        return view('tambah_data_pegawai');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tgl_join' => 'required|date',
            'tgl_out' => 'nullable|date',
            'posisi' => 'required|string|max:255',
            'id_pegawai' => 'required|string|unique:pegawais,id_pegawai|max:255',
            'departemen' => 'required|string|max:255',
            'kepagawaian' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'email' => 'nullable|email|unique:pegawais,email|max:255',
        ]);

        Pegawai::create([
            'nama' => $request->nama,
            'tgl_join' => $request->tgl_join,
            'tgl_out' => $request->tgl_out,
            'posisi' => $request->posisi,
            'id_pegawai' => $request->id_pegawai,
            'departemen' => $request->departemen,
            'kepagawaian' => $request->kepagawaian,
            'status' => $request->status,
            'email' => $request->email,
        ]);

        return redirect()->route('data_pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan!');
    }


    public function edit_data_pegawai()
    {
        return view('edit_data_pegawai');
    }

}
