<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Perusahaan;
use App\Models\Karyawan;
use App\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{  
    public function index()
    {
        $showDataKaryawan = Karyawan::get();

        return view('admin.karyawan.index')->with(['karyawan'=> $showDataKaryawan]);
    }
    
    public function create()
    {
        $perusahaan = Perusahaan::all();
        return view('admin.karyawan.create', compact('perusahaan'));
    }
    
    public function show($id)
    {
        $showDetailKaryawan = Karyawan::where('kode_karyawan', $id)->first();
        return view('admin.karyawan.detail')->with(['karyawan'=> $showDetailKaryawan]);
    }
    
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'jabatan' => 'required|string|max:100',
            'no_telp' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'no_rekening' => 'required|string|max:50',
            'rek_bank' => 'required|string|max:100',
            'id_perusahaan' => 'required|exists:perusahaan,id',
        ]);

        // Simpan data ke database
        Karyawan::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jabatan' => $request->jabatan,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'no_rekening' => $request->no_rekening,
            'rek_bank' => $request->rek_bank,
            'id_perusahaan' => $request->id_perusahaan,
        ]);

        flash()->success('Success', 'Karyawan Berhasil Disimpan!');
        return redirect()->route('admin.karyawan.index');
    }
 
    public function edit($id)
    {
        $karyawan = Karyawan::where('kode_karyawan', $id)->first();
        $perusahaan = Perusahaan::all();

        if ($karyawan) {
            return view('admin.karyawan.edit', compact('karyawan', 'perusahaan'));
        } else {
            flash()->error('error', 'Karyawan Tidak Ditemukan!');
            return redirect()->route('admin.karyawan.index');
        }
    }

    // Fungsi Update (untuk menyimpan perubahan)
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'jabatan' => 'required|string|max:100',
            'no_telp' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'no_rekening' => 'required|string|max:50',
            'rek_bank' => 'required|string|max:100',
            'id_perusahaan' => 'required|exists:perusahaan,id',
        ]);

        // Update data langsung menggunakan where dan update
        Karyawan::where('kode_karyawan', $id)->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jabatan' => $request->jabatan,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'no_rekening' => $request->no_rekening,
            'rek_bank' => $request->rek_bank,
            'id_perusahaan' => $request->id_perusahaan,
        ]);

        flash()->success('Success', 'Karyawan Berhasil Diperbarui!');
        return redirect()->route('admin.karyawan.index');
    }

    public function destroy($id)
    {
        Karyawan::where('kode_karyawan', $id)->delete();

        flash()->success('Success', 'Karyawan Berhasil Dihapus!');
        return redirect()->route('admin.karyawan.index');
    }
}
