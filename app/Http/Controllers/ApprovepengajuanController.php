<?php

namespace App\Http\Controllers;
use App\Models\PengajuanCuti;
use App\Models\Karyawan;
use App\Models\JenisCuti;
use App\Models\JatahCuti;

use Illuminate\Http\Request;


class ApprovePengajuanController extends Controller
{
    /**
     * Approve a leave request.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function approve($id)
    {
        // Find the leave request by ID
        $pengajuanCuti = PengajuanCuti::find($id);

        if (!$pengajuanCuti) {
            return response()->json(['message' => 'Pengajuan cuti tidak ditemukan'], 404);
        }

        // Update the status to approved
        $pengajuanCuti->status = 'approved';
        $pengajuanCuti->approved_at = now();
        $pengajuanCuti->save();

        return response()->json(['message' => 'Pengajuan cuti berhasil disetujui']);
    }
}