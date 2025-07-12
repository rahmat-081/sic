<?php

namespace App\Http\Controllers;
use App\Models\RiwayatJabatan;
use App\Models\UnitKerja;
use App\Models\JenisJabatan;
use App\Models\karyawan;
use Illuminate\Http\Request;
class RiwayatJabatanController extends Controller
{
    public function index()
    {
        $authuser = auth()->User();
        $riwayatJabatans = RiwayatJabatan::with(['karyawan', 'jabatan', 'unitKerja'])->get();

        return view('riwayat_jabatan', [
            'riwayatJabatans' => $riwayatJabatans
        ]);
    }

    public function store(Request $request)
    {
        $jabatan = new RiwayatJabatan();
        $jabatan->karyawan_id = $request->karyawan_id;
        $jabatan->jenis_jabatan_id = $request->jenis_jabatan_id;
        $jabatan->unit_kerja_id = $request->unit_kerja_id;
        $jabatan->mulai = $request->mulai;
        $jabatan->selesai = $request->selesai;
        $jabatan->save();
        return redirect()->route("riwayat_jabatan")->with("success", "");
    }

    public function edit(Request $request, $id)
    {
        $jabatan = RiwayatJabatan::with(['karyawan', 'jabatan', 'unitKerja'])->findOrFail($id);
        $karyawans = Karyawan::all();
        $jabatans = JenisJabatan::all();
        $unitKerja = UnitKerja::all();

        return view("edit_jabatan", compact("jabatan", "karyawans", "jabatans", "unitKerja"));
    }


    public function update(Request $request, $id)
    {
        $jabatan = RiwayatJabatan::find($id);
        $jabatan->karyawan_id = $request->karyawan_id;
        $jabatan->jenis_jabatan_id = $request->jenis_jabatan_id;
        $jabatan->unit_kerja_id = $request->unit_kerja_id;
        $jabatan->mulai = $request->mulai;
        $jabatan->selesai = $request->selesai;
        $jabatan->save();
        return redirect()->route("riwayat_jabatan")->with("success", "");
    }

    public function destroy(Request $request, $id)
    {
        $jabatan = RiwayatJabatan::find($id);
        $jabatan->delete();
        return redirect()->route("riwayat_jabatan")->with("success", "");
    }
}
