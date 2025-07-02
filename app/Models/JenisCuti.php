<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisCuti extends Model
{
    protected $table = 'jenis_cuti';

    protected $fillable = [
        'nama_cuti',
        'keterangan',
        'status',
    ];

    public function pengajuanCuti()
    {
        return $this->hasMany(PengajuanCuti::class, 'jenis_cuti', 'id');
    }
}
