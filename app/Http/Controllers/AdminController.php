<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Karyawan;

class AdminController extends Controller
{
    public function index()
    {
        //! Dashboard statistics 
        $totalKaryawan =  count(Karyawan::get());
        
        $data = [$totalKaryawan];
        
        return view('admin.index')->with(['data' => $data]);
    }

}
