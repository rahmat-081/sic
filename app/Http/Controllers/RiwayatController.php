<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatPengajuan;
use App\Models\PengajuanCuti;
use App\Models\JenisApproval;   // Assuming you have a model for the history

class RiwayatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Fetch the user's history from the database
        // For example, you might have a model called 'History'
        // $history = RiwayatPengajuan::where('pengajuan_id', auth()->id())->get();
        $history = RiwayatPengajuan::with(['pengajuan', 'jenis_approval'])->get();
        $pengajuan = PengajuanCuti::with(['karyawan'])->get();
        $jenis_approval = JenisApproval::all();
        return view('approve_pengajuan', ['history' => $history, 'pengajuan' => $pengajuan, 'jenis_approval' => $jenis_approval]);
    }

    public function store(Request $request){
        $riwayat = new RiwayatPengajuan();
        $riwayat->pengajuan_id = $request->input('pengajuan');
        $riwayat->jenis_approval_id = $request->input('jenis_approval');
        $riwayat->alasan = $request->input('alasan');
        $riwayat->save();

        return redirect()->route('approve.pengajuan')->with('success','Approve Pengajuan Berhasil');
    }

    public function edit($id){
        $riwayat = RiwayatPengajuan::with(['pengajuan', 'jenis_approval'])->findOrFail($id);
        $pengajuan = PengajuanCuti::with(['karyawan'])->get();
        $jenis_approval = JenisApproval::all();
        return view('edit_approve',['riwayat' => $riwayat, 'pengajuan' => $pengajuan, 'jenis_approval' => $jenis_approval]);
    }

    public function update(Request $request, $id){
        $riwayat = RiwayatPengajuan::findOrFail($id);
        $riwayat->pengajuan_id = $request->input('pengajuan');
        $riwayat->jenis_approval_id = $request->input('jenis_approval');
        $riwayat->alasan = $request->input('alasan');
        $riwayat->save();

        return redirect()->route('approve.pengajuan')->with('success','Approve Pengajuan Berhasil');
    }
}
