<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Perusahaan;
use App\Models\KeteranganGaji;
use App\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class KeteranganGajiController extends Controller
{  
    public function index()
    {
        $showDataKeteranganGaji = KeteranganGaji::get();

        return view('admin.keterangan_gaji.index')->with(['keterangan_gaji'=> $showDataKeteranganGaji]);
    }
    
    public function create()
    {
        return view('admin.keterangan_gaji.create');
    }
    
    public function show($id)
    {
        $showDetailKeteranganGaji = KeteranganGaji::where('no', $id)->first();
        return view('admin.keterangan_gaji.detail')->with(['keterangan_gaji'=> $showDetailKeteranganGaji]);
    }
    
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'keterangan' => 'required|string|max:255',
            'debitkredit' => 'required|in:debit,kredit',
        ]);

        // Simpan data ke database
        KeteranganGaji::create([
            'keterangan' => $request->keterangan,
            'debitkredit' => $request->debitkredit,
        ]);

        flash()->success('Success', 'Keterangan Gaji Berhasil Disimpan!');
        return redirect()->route('admin.keterangan_gaji.index');
    }
 
    public function edit($id)
    {
        $keterangan_gaji = KeteranganGaji::where('no', $id)->first();

        if ($keterangan_gaji) {
            return view('admin.keterangan_gaji.edit', compact('keterangan_gaji'));
        } else {
            flash()->error('error', 'Keterangan Gaji Tidak Ditemukan!');
            return redirect()->route('admin.keterangan_gaji.index');
        }
        
    }

    // Fungsi Update (untuk menyimpan perubahan)
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'keterangan' => 'required|string|max:255',
            'debitkredit' => 'required|in:debit,kredit',
        ]);

        // Update data di database
        KeteranganGaji::where('no', $id)->update([
            'keterangan' => $request->keterangan,
            'debitkredit' => $request->debitkredit,
        ]);

        flash()->success('Success', 'Keterangan Gaji Berhasil Diperbarui!');
        return redirect()->route('admin.keterangan_gaji.index');
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
