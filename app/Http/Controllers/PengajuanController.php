<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengajuanController extends Controller
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
        // Fetch the list of pengajuan cuti from the database
        // Assuming you have a model called PengajuanCuti
        $pengajuan = \App\Models\PengajuanCuti::where('karyawan_id', auth()->id())->get();
        // Pass the data to the view
        return view('pengajuan', ['histori_pengajuan' => $pengajuan]);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'jenis_cuti' => 'required|string|max:255',
            'tanggal_pengajuan' => 'required|date',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string|max:255',
        ]);

        // Store the pengajuan in the database
        // Assuming you have a model called PengajuanCuti
        $pengajuan = new \App\Models\PengajuanCuti();
        $pengajuan->jenis_cuti = $request->input('jenis_cuti');
        $pengajuan->tanggal_mulai = $request->input('tanggal_mulai');
        $pengajuan->tanggal_selesai = $request->input('tanggal_selesai');
        $pengajuan->alasan = $request->input('alasan');
        $pengajuan->user_id = auth()->id(); // Assuming you have a user_id field
        $pengajuan->save();

        return redirect()->route('pengajuan')->with('success', 'Pengajuan berhasil dibuat.');
    }
}
