<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatJabatan extends Model
{
    protected $table = 'riwayat_jabatan';
    protected $fillable = [
        'karyawan_id',
        'jabatan_id',
        'unit_kerja_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'unit_kerja_id');
    }
}
