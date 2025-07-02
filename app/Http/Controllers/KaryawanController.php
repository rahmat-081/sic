<?php

namespace App\Http\Controllers;
use App\Models\Karyawan;
use App\Models\User;

use Illuminate\Http\Request;

class KaryawanController extends Controller
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
        $authuser = auth()->user();
        $userkaryawan = Karyawan::where('user_id', $authuser->id)->first();
        $karyawans = Karyawan::with('user')->get();
        $user = User::all();
        $data=[
            'userkaryawan' => $userkaryawan, 
            'karyawans' => $karyawans,
            'users' => $user,
        ];

        // Pass the employees to the view
        return view('karyawan', $data);
    }

    public function store(Request $request)
    {
        
        $karyawan = new Karyawan();
        $karyawan->id = $request->input('id');
        $karyawan->npk = $request->input('npk');
        $karyawan->nama = $request->input('nama');
        $karyawan->tempatlahir = $request->input('tempatlahir');
        $karyawan->tanggallahir = $request->input('tanggallahir');
        $karyawan->gender = $request->input('gender');
        $karyawan->nik = $request->input('nik');
        $karyawan->alamat = $request->input('alamat');
        $karyawan->user_id = $request->input('user'); 
        $karyawan->save();

        return redirect()->route('karyawan')->with('success', 'Employee added successfully.');
    }
    public function edit(Request $request, $id)    
    {
        // Find the employee by ID
        $karyawan = Karyawan::findOrFail($id);
        $user = User::all();
        // Pass the employee to the view
        return view('edit_karyawan', ['karyawan' => $karyawan, 'users' => $user]);
    }
    public function update(Request $request, $id)
    {

        // Find the employee by ID and update their information
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->npk = $request->input('npk');
        $karyawan->nama = $request->input('nama');
        $karyawan->tempatlahir = $request->input('tempatlahir');
        $karyawan->tanggallahir = $request->input('tanggallahir');
        $karyawan->gender = $request->input('gender');
        $karyawan->nik = $request->input('nik');
        $karyawan->alamat = $request->input('alamat');
        $karyawan->user_id = $request->input('user'); 
        $karyawan->save();
        // Redirect back to the employee list with a success message
        return redirect()->route('karyawan')->with('success', 'Employee updated successfully.');
    }
    public function destroy($id)
    {
        // Find the employee by ID and delete them
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();

        // Redirect back to the employee list with a success message
        return redirect()->route('karyawan')->with('success', 'Employee deleted successfully.');
    }
    public function show($id)
    {
        // Find the employee by ID
        $karyawan = Karyawan::findOrFail($id);
        // Pass the employee to the view
        return view('show_karyawan', ['karyawan' => $karyawan]);
    }
}
