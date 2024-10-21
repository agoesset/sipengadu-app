<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UpdateStatusComplaintHelper;
use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\ComplaintResponse;
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

    public function storePengaduan(Request $request)
    {

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/complaint_responses', $image->hashName());
        }

        UpdateStatusComplaintHelper::updateStatus($request->complaint_id);

        ComplaintResponse::create([
            'complaint_id'  => $request->complaint_id,
            'user_id'       => Auth::user()->id,
            'response'      => $request->response,
            'image'         => $image->hashName(),
        ]);

        return redirect()->route('admin.semua.pengaduan')->with('msg', 'Pengaduan ditanggapi dan sedang diproses!');
    }

    public function semuaPendingPengaduan()
    {
        $complaints = Complaint::where('status','pending')->get();
        return view('dashboard.admin-role.pending-pengaduan',[
            'complaints' => $complaints
        ]);
    }

    public function semuaProsesPengaduan()
    {
        $complaints = Complaint::where('status','proses')->get();
        return view('dashboard.admin-role.proses-pengaduan',[
            'complaints' => $complaints
        ]);
    }

    public function semuaSelesaiPengaduan()
    {
        $complaints = Complaint::where('status','selesai')->get();
        return view('dashboard.admin-role.selesai-pengaduan',[
            'complaints' => $complaints
        ]);
    }
}
