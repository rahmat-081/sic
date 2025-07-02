<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanCuti extends Model
{
    protected $table = 'pengajuan_cuti';

    protected $fillable = [
        'karyawan_id',
        'tanggal_pengajuan',
        'jenis_cuti_id',
        'jatah_cuti_id',
        'mulai',
        'selesai',
        'total_hari',
        'alamat',
        'alasan',
    ];
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }

    public function JenisCuti()
    {
        return $this->belongsTo(JenisCuti::class, 'jenis_cuti_id');
    }

    public function JatahCuti()
    {
        return $this->belongsTo(JatahCuti::class, 'jatah_cuti_id');
    }

}
