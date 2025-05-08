<?php

namespace App\Http\Controllers;
use App\Models\Karyawan;

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
        // Fetch all employees from the database
        $karyawans = Karyawan::all();
        // Pass the employees to the view
        return view('karyawan', ['karyawans' => $karyawans]);
    }

    public function store(Request $request)
    {
        // Validate the request data
        // $request->validate([
        //     'id' => 'required|integer',
        //     'npk' => 'required|string|max:255',
        //     'nama' => 'required|string|max:255',
        //     'tempatlahir' => 'required|string|max:255',
        //     'tanggallahir' => 'required|date',
        //     'gender' => 'required|string|max:10',
        //     'nik' => 'required|string|max:16',
        //     'alamat' => 'required|string|max:255',
        // ]);
        
        // Create a new employee record
        $karyawan = new Karyawan();
        $karyawan->id = $request->input('id');
        $karyawan->npk = $request->input('npk');
        $karyawan->nama = $request->input('nama');
        $karyawan->tempatlahir = $request->input('tempatlahir');
        $karyawan->tanggallahir = $request->input('tanggallahir');
        $karyawan->gender = $request->input('gender');
        $karyawan->nik = $request->input('nik');
        $karyawan->alamat = $request->input('alamat');
        $karyawan->save();
        // Return a JSON response with the newly created employee data
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Employee added successfully.',
        //     'data' => $karyawan
        // ]);
        // Redirect back to the employee list with a success message
        return redirect()->route('karyawan')->with('success', 'Employee added successfully.');
    }
    public function edit($id)
    {
        // Find the employee by ID
        $karyawan = Karyawan::findOrFail($id);
        // Pass the employee to the view
        return view('edit_karyawan', ['karyawan' => $karyawan]);
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
