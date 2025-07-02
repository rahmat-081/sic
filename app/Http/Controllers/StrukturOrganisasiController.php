<?php

namespace App\Http\Controllers;
use App\Models\UnitKerja;
use App\Models\JenisUnit;

use Illuminate\Http\Request;

class StrukturOrganisasiController extends Controller
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
        $jenisunits = JenisUnit::all();
        $unitkerjas = UnitKerja::with('jenisUnit')
        ->orderBy('induk_id')
        ->orderBy('nama')
        ->get();
        return view('strukturorganisasi', compact('jenisunits', 'unitkerjas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'jenis_unit_id' => 'required|exists:jenis_unit,id',
        ]);

        $unitkerja = new \App\Models\UnitKerja();
        $unitkerja->nama = $request->input('nama');
        $unitkerja->jenis_unit_id = $request->input('jenis_unit_id');
        $unitkerja->save();
        return redirect()->back()->with('success', 'Data unit kerja berhasil ditambahkan.');
    }
}
