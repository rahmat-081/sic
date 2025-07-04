<?php

namespace App\Http\Controllers;
use App\Models\PengajuanCuti;
use App\Models\Karyawan;
use App\Models\JenisCuti;
use App\Models\JatahCuti;
use App\Models\JenisApproval;

use App\Models\RiwayatPengajuan;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // halaman utama pengajuan cuti
    public function index()
    {
        $authuser = auth()->user();
        $userkaryawan = Karyawan::where('user_id', $authuser->id)->first();
        $pengajuan = PengajuanCuti::with(['karyawan', 'JenisCuti'])
            ->where('karyawan_id', $userkaryawan->id)
            ->get();

        $riwayat = RiwayatPengajuan::with(['pengajuan.karyawan', 'jenis_approval', 'pengajuan.JenisCuti'])
            ->whereHas('pengajuan.karyawan', function ($query) use ($userkaryawan) {
                $query->where('id', $userkaryawan->id);
            })
            ->get();

        $jeniscuti = JenisCuti::all();
        $jatahcuti = JatahCuti::where('karyawan_id', $userkaryawan->id)->get();
        $data = [
            'histori_pengajuan' => $riwayat,
            'userkaryawan' => $userkaryawan,
            'jeniscuti' => $jeniscuti,
            'jatahcuti' => $jatahcuti,
            'sisacuti' => $jatahcuti->sum('jumlah') - $pengajuan->sum('total_hari'),
        ];

        return view('pengajuan', $data);
    }
    public function indexsdm()
    {
        $authuser = auth()->user();
        $userkaryawan = Karyawan::where('user_id', $authuser->id)->first();
        $pengajuan = PengajuanCuti::with(['karyawan', 'JenisCuti', 'JatahCuti'])
            ->get();
        $jeniscuti = JenisCuti::all();
        $data = [
            'histori_pengajuan' => $pengajuan,
            'userkaryawan' => $userkaryawan,
            'jeniscuti' => $jeniscuti,

        ];

        return view('pengajuansdm', $data);
    }

    public function store(Request $request)
    {
        $pengajuan = new PengajuanCuti();
        $pengajuan->karyawan_id = $request->input('karyawan');
        $pengajuan->tanggal_pengajuan = $request->input('tanggal_pengajuan');
        $pengajuan->jenis_cuti_id = $request->input('jenis_cuti');
        $pengajuan->jatah_cuti_id = $request->input('jatah_cuti');
        $pengajuan->mulai = $request->input('tanggal_mulai');
        $pengajuan->selesai = $request->input('tanggal_selesai');
        $pengajuan->total_hari = $request->input('jumlah_hari');
        $pengajuan->alamat = $request->input('alamat_cuti');
        $pengajuan->alasan = $request->input('alasan');
        $pengajuan->save();

        return redirect()->route('pengajuan')->with('success', 'Pengajuan berhasil dibuat.');
    }

    public function edit($id)
    {

        $pengajuan = PengajuanCuti::findOrFail($id);

        return view('edit_pengajuan', ['pengajuan' => $pengajuan]);
    }

    public function update(Request $request, $id)
    {

        $pengajuan = \App\Models\PengajuanCuti::findOrFail($id);
        $pengajuan->jenis_cuti = $request->input('jenis_cuti');
        $pengajuan->tanggal_pengajuan = $request->input('tanggal_pengajuan');
        $pengajuan->tanggal_mulai = $request->input('tanggal_mulai');
        $pengajuan->tanggal_selesai = $request->input('tanggal_selesai');
        $pengajuan->alamat = $request->input('kota_tujuan');
        $pengajuan->alasan = $request->input('alasan');
        $pengajuan->save();

        return redirect()->route('pengajuan')->with('success', 'Pengajuan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengajuan = PengajuanCuti::findOrFail($id);
        $pengajuan->delete();

        return redirect()->route('pengajuan')->with('success', 'Pengajuan berhasil dihapus.');
    }


    public function show($id)
    {
        // Find the pengajuan by ID
        $pengajuan = PengajuanCuti::findOrFail($id);
        // Pass the pengajuan data to the view
        return view('show_pengajuan', ['pengajuan' => $pengajuan]);
    }
    public function approve($id)
    {
        // Find the pengajuan by ID and approve it
        $pengajuan = PengajuanCuti::findOrFail($id);
        $pengajuan->status = 'approved'; // Assuming you have a status field
        $pengajuan->save();

        return redirect()->route('pengajuan')->with('success', 'Pengajuan berhasil disetujui.');
    }
    public function reject($id)
    {
        // Find the pengajuan by ID and reject it
        $pengajuan = PengajuanCuti::findOrFail($id);
        $pengajuan->status = 'rejected'; // Assuming you have a status field
        $pengajuan->save();

        return redirect()->route('pengajuan')->with('success', 'Pengajuan berhasil ditolak.');
    }
    public function history()
    {
        // Fetch the history of pengajuan cuti from the database
        $pengajuan = \App\Models\PengajuanCuti::where('user_id', auth()->id())->get();
        // Pass the data to the view
        return view('history_pengajuan', ['histori_pengajuan' => $pengajuan]);
    }
}
