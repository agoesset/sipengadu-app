<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function semuaPengaduan()
    {
        $complaints = Complaint::all();
        return view('dashboard.admin-role.semua-pengaduan',[
            'complaints' => $complaints
        ]);
    }

    public function tanggapiPengaduan(Complaint $id_pengaduan)
    {
        return view('dashboard.admin-role.tanggapi-pengaduan',[
            'complaint' => $id_pengaduan
        ]);
    }
}
