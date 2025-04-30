<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\SlipGaji;
use App\Models\DetailGaji;
use App\Models\Karyawan;
use App\Models\KeteranganGaji;
use App\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class SlipGajiController extends Controller
{  
    public function index()
    {
        // Ambil data slip gaji beserta relasi karyawan
        $showDataSlipGaji = SlipGaji::with('karyawan')->get();

        return view('admin.slip_gaji.index')->with(['slip_gaji' => $showDataSlipGaji]);
    }
    
    public function create()
    {
        $karyawan = Karyawan::all();
        $keterangan_gaji = KeteranganGaji::all();
        return view('admin.slip_gaji.create', compact('karyawan', 'keterangan_gaji'));
    }
    
    public function show($id)
    {
        $showDetailSlipGaji = SlipGaji::with(['karyawan', 'detailGaji.keteranganGaji'])->where('no_ref', $id)->firstOrFail();
        return view('admin.slip_gaji.detail')->with(['slip_gaji'=> $showDetailSlipGaji]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'tgl' => 'required|date',
            'kode_karyawan' => 'required|exists:karyawan,kode_karyawan',
            'total_gaji' => 'required|numeric|min:0',
            'keterangan_gaji' => 'required|array',
            'keterangan_gaji.*' => 'exists:keterangan_gaji,no',
            'nominal' => 'required|array',
            'nominal.*' => 'numeric|min:0',
        ]);

        // Simpan Slip Gaji dan dapatkan no_ref
        $noRef = SlipGaji::insertGetId([
            'tgl' => $request->tgl,
            'kode_karyawan' => $request->kode_karyawan,
            'total_gaji' => $request->total_gaji,
        ]);

        // Simpan Detail Gaji
        foreach ($request->keterangan_gaji as $index => $keterangan) {
            DetailGaji::create([
                'no_ref' => $noRef, // Gunakan no_ref yang baru saja didapatkan
                'no' => $keterangan,
                'nominal' => $request->nominal[$index],
            ]);
        }

        flash()->success('Success', 'Slip Gaji Berhasil Disimpan!');
        return redirect()->route('admin.slip_gaji.index');
    }
 
    public function edit($id)
    {
        // Ambil data slip gaji beserta detail gaji dan keterangan gaji
        $slip_gaji = SlipGaji::with(['detailGaji.keteranganGaji', 'karyawan'])->where('no_ref', $id)->firstOrFail();

        // Data karyawan untuk dropdown
        $karyawan = Karyawan::all();
        // Data keterangan gaji untuk dropdown
        $keterangan_gaji = KeteranganGaji::all();

        return view('admin.slip_gaji.edit', compact('slip_gaji', 'karyawan', 'keterangan_gaji'));
    }

    // Fungsi Update (untuk menyimpan perubahan)
    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl' => 'required|date',
            'total_gaji' => 'required|numeric|min:0',
            'keterangan_gaji' => 'required|array',
            'keterangan_gaji.*' => 'exists:keterangan_gaji,no',
            'nominal' => 'required|array',
            'nominal.*' => 'numeric|min:0',
        ]);

        // Update Slip Gaji menggunakan where
        SlipGaji::where('no_ref', $id)->update([
            'tgl' => $request->tgl,
            'total_gaji' => $request->total_gaji,
        ]);

        // Hapus semua detail gaji lama
        DetailGaji::where('no_ref', $id)->delete();

        // Simpan detail gaji baru
        foreach ($request->keterangan_gaji as $index => $keterangan) {
            DetailGaji::create([
                'no_ref' => $id,
                'no' => $keterangan,
                'nominal' => $request->nominal[$index],
            ]);
        }

        flash()->success('Success', 'Slip Gaji Berhasil Diperbarui!');
        return redirect()->route('admin.slip_gaji.index');
    }

    public function destroy($id)
    {
        DetailGaji::where('no_ref', $id)->delete();
        SlipGaji::where('no_ref', $id)->delete();
        
        flash()->success('Success', 'Slip Gaji Berhasil Dihapus!');
        return redirect()->route('admin.slip_gaji.index');
    }
}
