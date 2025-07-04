<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisApproval extends Model
{
    protected $table = "jenis_approval";

    protected $fillable = [
        'pengajuan_id',
        'jenis_approval_id',
        'alasan'
    ];

    public function riwayat_pengajuan(){
        return $this->hasMany(PengajuanCuti::class);
    }
}