<?php

namespace App\Http\Controllers;
use App\Models\PengajuanCuti;
use App\Models\Karyawan;
use App\Models\JenisCuti;
use App\Models\JatahCuti;
use App\Models\JenisApproval;
use DB;
use App\Models\RiwayatPengajuan;
use App\Models\RiwayatJabatan;
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

        $biodata = DB::table('karyawan as k')
            ->leftJoin('riwayat_jabatan as rj', 'rj.karyawan_id', '=', 'k.id')
            ->leftJoin('unit_kerja as u', 'u.id', '=', 'rj.unit_kerja_id')
            ->leftJoin('jenis_jabatan as jj', 'jj.id', '=', 'rj.jenis_jabatan_id')
            ->where('k.id', $userkaryawan->id)
            ->select(
                'k.nama as nama_karyawan',
                'k.npk',
                'jj.nama as jabatan',
                'k.gender',
                'k.alamat as alamat_karyawan',
                'u.nama as unitkerja'
            )
            ->orderByDesc('rj.created_at')
            ->first();


        $riwayat = DB::table('pengajuan_cuti as p')
            ->join('jenis_cuti as je', 'je.id', '=', 'p.jenis_cuti_id')
            ->leftJoin('riwayat_pengajuan as rp', 'rp.pengajuan_id', '=', 'p.id')
            ->leftJoin('jenis_approval as j', 'j.id', '=', 'rp.jenis_approval_id')
            ->where('p.karyawan_id', $userkaryawan->id)
            ->select(
                'p.id',
                'p.tanggal_pengajuan',
                'je.nama as jeniscuti',
                'p.mulai',
                'p.selesai',
                'p.total_hari',
                'p.alamat',
                'j.nama as jenis_approval',
                'p.alasan'
            )
            ->orderByDesc('p.tanggal_pengajuan')
            ->get();

        $jeniscuti = JenisCuti::all();
        $jatahcuti = JatahCuti::where('karyawan_id', $userkaryawan->id)->get();
        $pengajuan = PengajuanCuti::where('karyawan_id', $userkaryawan->id)->get();

        $sisacuti = $jatahcuti->sum('jumlah') - $pengajuan->sum('total_hari');

        return view('pengajuan', compact(
            'biodata',
            'riwayat',
            'jeniscuti',
            'jatahcuti',
            'sisacuti',
            'userkaryawan'
        ));
    }

    public function store(Request $request)
    {
        $pengajuan = new PengajuanCuti();
        $pengajuan->karyawan_id = auth()->user()->karyawan->id;
        $pengajuan->tanggal_pengajuan = $request->input('tanggal_pengajuan');
        $pengajuan->jenis_cuti_id = $request->input('jenis_cuti');
        $pengajuan->jatah_cuti_id = $request->input('jatah_cuti');
        $pengajuan->mulai = $request->input('tanggal_mulai');
        $pengajuan->selesai = $request->input('tanggal_selesai');
        $pengajuan->total_hari = $request->input('jumlah_hari');
        $pengajuan->alamat = $request->input('alamat_cuti');
        $pengajuan->alasan = $request->input('alasan');
        $pengajuan->save();

        $riwayat = RiwayatJabatan::find($pengajuan->karyawan_id);
        if ($riwayat->unitKerja->nama == 'SDM' and $riwayat->jabatan->nama == 'Pelaksana') {
            return redirect()->route('sdm.pengajuan')->with('success', 'Pengajuan berhasil dibuat');
        } elseif ($riwayat->jabatan->nama != 'Pelaksana') {
            return redirect()->route('atasan.pengajuan')->with('success', 'Pengajuan berhasil dibuat');
        }

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
