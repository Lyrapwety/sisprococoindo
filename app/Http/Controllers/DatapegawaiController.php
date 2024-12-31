<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Storage;

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
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi foto
        ]);

        $foto = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto')->store('foto_pegawai', 'public'); // Simpan file foto di storage
        }
    
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
            'foto' => $foto,
        ]);

        return redirect()->route('data_pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('data_pegawai.index')->with('success', 'Data berhasil dihapus!');
    }


    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('edit_data_pegawai', compact('pegawai'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tgl_join' => 'required|date',
            'tgl_out' => 'nullable|date',
            'posisi' => 'required|string|max:255',
            'id_pegawai' => 'required|string|max:255|unique:pegawais,id_pegawai,' . $id,
            'departemen' => 'required|string|max:255',
            'kepagawaian' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'email' => 'nullable|email|unique:pegawais,email,' . $id,
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi foto
        ]);
    
        $pegawai = Pegawai::findOrFail($id);
    
        // Ambil foto lama
        $foto = $pegawai->foto;
    
        // Cek jika ada file foto baru
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            if ($foto) {
                Storage::disk('public')->delete($foto); // Hapus foto lama jika ada
            }
            $foto = $request->file('foto')->store('foto_pegawai', 'public'); // Simpan foto baru
        }
    
        // Update data pegawai
        $pegawai->update([
            'nama' => $request->nama,
            'tgl_join' => $request->tgl_join,
            'tgl_out' => $request->tgl_out,
            'posisi' => $request->posisi,
            'id_pegawai' => $request->id_pegawai,
            'departemen' => $request->departemen,
            'kepagawaian' => $request->kepagawaian,
            'status' => $request->status,
            'email' => $request->email,
            'foto' => $foto, // Simpan foto baru atau gunakan foto lama
        ]);
    
        return redirect()->route('data_pegawai.index')->with('success', 'Data pegawai berhasil diperbarui!');
    }


}
