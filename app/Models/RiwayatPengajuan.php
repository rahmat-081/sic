<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPengajuan extends Model
{
    protected $table = 'riwayat_pengajuan';

    protected $fillable = [
        'pengajuan_id',
        'jenis_approval_id',
        'alasan'
    ];

    public function pengajuan()
    {
        return $this->belongsTo(PengajuanCuti::class);
    }

    public function jenis_approval()
    {
        return $this->belongsTo(JenisApproval::class);
    }
}
