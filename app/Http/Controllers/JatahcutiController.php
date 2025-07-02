<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Jatahcuti;
use App\Models\Karyawan;
use App\Models\User;
use App\Models\JenisCuti;



class JatahcutiController extends Controller
{
    public function index()
    {
        $jatahcuti = Jatahcuti::with(['karyawan', 'jenisCuti'])->get();
        $karyawan = Karyawan::all();
        $jeniscuti = JenisCuti::all();
        $authuser = auth()->user();
        $userkaryawan = Karyawan::where('user_id', $authuser->id)->first();
        
        $data = [
            'jatahcuti' => $jatahcuti,
            'karyawans' => $karyawan,
            'jeniscuti' => $jeniscuti,
            'userkaryawan' => $userkaryawan,
        ];
        return view('jatahcuti', $data);
    }

    public function create()
    {
        return view('jatahcuti.create');
    }

    public function store(Request $request)
    {
        $jatahcuti = new Jatahcuti();
        $jatahcuti->karyawan_id = $request->input('karyawan');
        $jatahcuti->jenis_cuti_id = $request->input('jenis_cuti');
        $jatahcuti->tahun = $request->input('tahun');
        $jatahcuti->jumlah = $request->input('jumlah');
        $jatahcuti->save();
        return redirect()->route('jatahcuti')->with('success', 'Data cuti berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jatahcuti = Jatahcuti::findOrFail($id);
        return view('jatahcuti.edit', compact('jatahcuti'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jumlah_cuti' => 'required|integer',
        ]);

        $jatahcuti = Jatahcuti::findOrFail($id);
        $jatahcuti->update($request->all());
        return redirect()->route('jatahcuti.index')->with('success', 'Data cuti berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jatahcuti = Jatahcuti::findOrFail($id);
        $jatahcuti->delete();
        return redirect()->route('jatahcuti.index')->with('success', 'Data cuti berhasil dihapus.');
    }
}