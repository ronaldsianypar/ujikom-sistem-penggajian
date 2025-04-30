<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Perusahaan;
use App\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class PerusahaanController extends Controller
{  
    public function index()
    {
        $showDataPerusahaan = Perusahaan::get();

        return view('admin.perusahaan.index')->with(['perusahaan'=> $showDataPerusahaan]);
    }
    
    public function create()
    {
        return view('admin.perusahaan.create');
    }
    
    public function show($id)
    {
        $showDetailPerusahaan = Perusahaan::where('id', $id)->first();
        return view('admin.perusahaan.detail')->with(['perusahaan'=> $showDetailPerusahaan]);
    }
    
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telpon' => 'required|string|max:15',
            'email' => 'required|email|max:255',
        ]);

        // Simpan data ke database
        Perusahaan::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telpon' => $request->no_telpon,
            'email' => $request->email,
        ]);

        flash()->success('Success', 'Perusahaan Berhasil Disimpan!');
        return redirect()->route('admin.perusahaan.index');
    }
 
    public function edit($id)
    {
        $perusahaan = Perusahaan::where('id', $id)->first();

        if ($perusahaan) {
            return view('admin.perusahaan.edit', compact('perusahaan'));
        } else {
            flash()->error('error', 'Perusahaan Tidak Ditemukan!');
            return redirect()->route('admin.perusahaan.index');
        }
        
    }

    // Fungsi Update (untuk menyimpan perubahan)
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telpon' => 'required|string|max:15',
            'email' => 'required|email|max:255',
        ]);

        $perusahaan = Perusahaan::findOrFail($id);

        // Update data
        $perusahaan->nama = $request->nama;
        $perusahaan->alamat = $request->alamat;
        $perusahaan->no_telpon = $request->no_telpon;
        $perusahaan->email = $request->email;
        $perusahaan->save();
        
        flash()->success('Success', 'Perusahaan Berhasil Diperbarui!');
        return redirect()->route('admin.perusahaan.index');
    }


    public function destroy($id)
    {
        $perusahaan = Perusahaan::findOrFail($id);

        // Hapus data
        $perusahaan->delete();

        flash()->success('Success', 'Perusahaan Berhasil Dihapus!');
        return redirect()->route('admin.perusahaan.index');
    }
}
