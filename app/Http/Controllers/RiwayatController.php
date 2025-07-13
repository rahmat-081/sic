<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatPengajuan;
use App\Models\PengajuanCuti;
use App\Models\JenisApproval;   // Assuming you have a model for the history
use DB;
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
        $user = auth()->user();
        $karyawan = $user->karyawan;

        // ambil riwayat jabatan aktif user
        $riwayatJabatan = $karyawan->riwayat_jabatan()
            ->whereDate('mulai', '<=', today())
            ->whereDate('selesai', '>=', today())
            ->with('jabatan')
            ->first();

        if (!$riwayatJabatan) {
            abort(403, 'Tidak memiliki jabatan aktif.');
        }

        $currentJabatanNama = strtolower($riwayatJabatan->jabatan->nama);
        $unitKerjaId = $riwayatJabatan->unit_kerja_id;

        // menentukan bawahan
        $targetJabatanNama = match ($currentJabatanNama) {
            'direktur' => 'manager',
            'manager' => 'kepala seksi',
            'kepala seksi' => 'kepala regu',
            'kepala regu' => 'pelaksana',
            default => null,
        };

        if (!$targetJabatanNama) {
            return view('approve_pengajuan', [
                'history' => collect(),
                'pengajuan' => collect(),
                'jenis_approval' => JenisApproval::all(),
            ]);
        }

        $pengajuan = PengajuanCuti::whereHas('karyawan.riwayat_jabatan', function ($q) use ($targetJabatanNama, $unitKerjaId, $currentJabatanNama) {
            $q->whereHas('jabatan', function ($q2) use ($targetJabatanNama) {
                $q2->whereRaw('LOWER(nama) = ?', [strtolower($targetJabatanNama)]);
            });

            if ($currentJabatanNama !== 'direktur') {
                $q->where('unit_kerja_id', $unitKerjaId);
            }

            $q->whereDate('mulai', '<=', today())
              ->whereDate('selesai', '>=', today());
        })
        ->whereDoesntHave('RiwayatPengajuan')
        ->with(['karyawan', 'karyawan.riwayat_jabatan.jabatan'])
        ->get();

        $history = RiwayatPengajuan::whereHas('pengajuan.karyawan.riwayat_jabatan', function ($q) use ($targetJabatanNama, $unitKerjaId, $currentJabatanNama) {
            $q->whereHas('jabatan', function ($q2) use ($targetJabatanNama) {
                $q2->whereRaw('LOWER(nama) = ?', [strtolower($targetJabatanNama)]);
            });

            if ($currentJabatanNama !== 'direktur') {
                $q->where('unit_kerja_id', $unitKerjaId);
            }

            $q->whereDate('mulai', '<=', today())
              ->whereDate('selesai', '>=', today());
        })
        ->with(['pengajuan.karyawan', 'pengajuan.karyawan.riwayat_jabatan.jabatan'])
        ->get();

        $jenis_approval = JenisApproval::all();

        return view('approve_pengajuan', [
            'history' => $history,
            'pengajuan' => $pengajuan,
            'jenis_approval' => $jenis_approval,
        ]);
    }

    public function show()
    {
        $riwayat = DB::table('pengajuan_cuti as p')
            ->join('karyawan as k', 'k.id', '=', 'p.karyawan_id')
            ->join('jenis_cuti as je', 'je.id', '=', 'p.jenis_cuti_id')
            ->leftJoin('riwayat_pengajuan as rp', 'rp.pengajuan_id', '=', 'p.id')
            ->leftJoin('jenis_approval as j', 'j.id', '=', 'rp.jenis_approval_id')
            ->join('riwayat_jabatan as rj','k.id','=','rj.karyawan_id')
            ->join('unit_kerja as u', 'u.id','=','rj.unit_kerja_id')
            ->join('jenis_jabatan as jj', 'jj.id', '=', 'rj.jenis_jabatan_id')
            ->select(
                'p.id',
                'p.tanggal_pengajuan',
                'k.nama as karyawan',
                'u.nama as unit_kerja',
                'je.nama as jeniscuti',
                'jj.nama as jenis_jabatan',
                'p.mulai',
                'p.selesai',
                'p.total_hari',
                'p.alamat',
                'j.nama as jenis_approval',
                'p.alasan'
            )
            ->orderByDesc('p.tanggal_pengajuan')
            ->get();
        return view('riwayat', compact('riwayat'));
    }

    public function show_atasan()
    {
        $user = auth()->user();
        $karyawan = $user->karyawan;

        $riwayatJabatan = $karyawan->riwayat_jabatan()
            ->whereDate('mulai', '<=', today())
            ->whereDate('selesai', '>=', today())
            ->with('jabatan')
            ->first();

        if (!$riwayatJabatan) {
            abort(403, 'Tidak memiliki jabatan aktif.');
        }

        $currentJabatanNama = strtolower($riwayatJabatan->jabatan->nama);
        $unitKerjaId = $riwayatJabatan->unit_kerja_id;

        $targetJabatanNama = match ($currentJabatanNama) {
            'direktur' => 'manager',
            'manager' => 'kepala seksi',
            'kepala seksi' => 'kepala regu',
            'kepala regu' => 'pelaksana',
            default => null,
        };

        if (!$targetJabatanNama) {
            return view('approve_pengajuan', [
                'history' => collect(),
                'pengajuan' => collect(),
                'jenis_approval' => JenisApproval::all(),
            ]);
        }
        
        $pengajuan = DB::table('pengajuan_cuti as p')
            ->join('karyawan as k', 'k.id', '=', 'p.karyawan_id')
            ->join('riwayat_jabatan as rj', function ($join) {
                $join->on('rj.karyawan_id', '=', 'k.id')
                    ->whereDate('rj.mulai', '<=', now())
                    ->whereDate('rj.selesai', '>=', now());
            })
            ->join('jenis_jabatan as jj', 'jj.id', '=', 'rj.jenis_jabatan_id')
            ->join('jenis_cuti as je', 'je.id', '=', 'p.jenis_cuti_id')
            ->join('unit_kerja as u', 'u.id','=','rj.unit_kerja_id')
            ->leftJoin('riwayat_pengajuan as rp', 'rp.pengajuan_id', '=', 'p.id')
            ->leftJoin('jenis_approval as j', 'j.id', '=', 'rp.jenis_approval_id')
            ->whereRaw('LOWER(jj.nama) = ?', [strtolower($targetJabatanNama)]);
        
        if ($currentJabatanNama !== 'direktur') {
            $pengajuan = $pengajuan->where('rj.unit_kerja_id', $unitKerjaId);
        }

        $pengajuan = $pengajuan->select(
                'p.id',
                'p.tanggal_pengajuan',
                'k.nama as karyawan',
                'u.nama as unit_kerja',
                'jj.nama as jenis_jabatan',
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

        return view('riwayat', [
            'riwayat' => $pengajuan,
        ]);
    }

    public function store(Request $request)
    {
        $pengajuanId = $request->input('pengajuan');
        $existing = RiwayatPengajuan::where('pengajuan_id', $pengajuanId)->exists();

        if ($existing) {
            return redirect()->back()->withErrors(['Pengajuan ini sudah pernah disetujui.']);
        }
        $riwayat = new RiwayatPengajuan();
        $riwayat->pengajuan_id = $pengajuanId;
        $riwayat->jenis_approval_id = $request->input('jenis_approval');
        $riwayat->alasan = $request->input('alasan');
        $riwayat->save();

        return redirect()->route('approve.pengajuan')->with('success', 'Approve Pengajuan Berhasil');
    }


    public function edit($id)
    {
        $riwayat = RiwayatPengajuan::with(['pengajuan', 'jenis_approval'])->findOrFail($id);
        $user = auth()->user();
        $karyawan = $user->karyawan;

        $riwayatJabatan = $karyawan->riwayat_jabatan()
            ->whereDate('mulai', '<=', today())
            ->whereDate('selesai', '>=', today())
            ->with('jabatan')
            ->first();

        if (!$riwayatJabatan) {
            abort(403, 'Tidak memiliki jabatan aktif.');
        }

        $currentJabatanNama = strtolower($riwayatJabatan->jabatan->nama);
        $unitKerjaId = $riwayatJabatan->unit_kerja_id;

        $targetJabatanNama = match ($currentJabatanNama) {
            'direktur' => 'manager',
            'manager' => 'kepala seksi',
            'kepala seksi' => 'kepala regu',
            'kepala regu' => 'pelaksana',
            default => null,
        };

        if (!$targetJabatanNama) {
            return view('approve_pengajuan', [
                'history' => collect(),
                'pengajuan' => collect(),
                'jenis_approval' => JenisApproval::all(),
            ]);
        }

        $pengajuan = PengajuanCuti::whereHas('karyawan.riwayat_jabatan', function ($q) use ($targetJabatanNama, $unitKerjaId, $currentJabatanNama) {
            $q->whereHas('jabatan', function ($q2) use ($targetJabatanNama) {
                $q2->whereRaw('LOWER(nama) = ?', [strtolower($targetJabatanNama)]);
            });

            if ($currentJabatanNama !== 'direktur') {
                $q->where('unit_kerja_id', $unitKerjaId);
            }

            $q->whereDate('mulai', '<=', today())
              ->whereDate('selesai', '>=', today());
        })
        ->whereDoesntHave('RiwayatPengajuan')
        ->with(['karyawan', 'karyawan.riwayat_jabatan.jabatan'])
        ->get();
        $jenis_approval = JenisApproval::all();
        return view('edit_approve', ['riwayat' => $riwayat, 'pengajuan' => $pengajuan, 'jenis_approval' => $jenis_approval]);
    }

    public function update(Request $request, $id)
    {
        $riwayat = RiwayatPengajuan::findOrFail($id);
        $riwayat->pengajuan_id = $request->input('pengajuan');
        $riwayat->jenis_approval_id = $request->input('jenis_approval');
        $riwayat->alasan = $request->input('alasan');
        $riwayat->save();

        return redirect()->route('approve.pengajuan')->with('success', 'Approve Pengajuan Berhasil');
    }
}
