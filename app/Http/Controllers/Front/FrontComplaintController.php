<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class FrontComplaintController extends Controller
{
    public function storePengaduan(Request $request)
    {
        $image = $request->file('image');
        $image->storeAs('public/complaints', $image->hashName());

        $complaint = new Complaint();

        $complaint->title       = $request->title;
        $complaint->guest_name  = $request->name;
        $complaint->guest_email = $request->title;
        $complaint->guest_telp  = $request->telp;
        $complaint->description = $request->description;        
        $complaint->image       = $image->hashName();

        $complaint->save();

        return redirect()->back()->with('msg','Pengaduan anda berhasil dikirim!');
    }
}
