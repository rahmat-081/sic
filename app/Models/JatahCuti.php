<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JatahCuti extends Model
{
    protected $table = 'jatah_cuti';

    protected $fillable = [
        'karyawan_id',
        'jumlah_cuti',
        'sisa_cuti',
        'tahun',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function pengajuanCuti()
    {
        return $this->hasMany(PengajuanCuti::class);
    }
    public function jenisCuti()
    {
        return $this->belongsTo(JenisCuti::class);
    }
}
