<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatPengajuan; // Assuming you have a model for the history

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
        $history = RiwayatPengajuan::where('pengajuan_id', auth()->id())->get();
        return view('riwayat', ['history' => $history]);}
}
