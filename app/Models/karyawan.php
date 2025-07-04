<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class karyawan extends Model
{
    protected $table = 'karyawan';
    protected $fillable = [
        'user_id',
        'nama',
        'nip',
        'jabatan',
        'departemen',
        'tanggal_masuk',
        'alamat',
        'telepon',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function riwayat_jabatan()
    {
        return $this->hasMany(\App\Models\RiwayatJabatan::class, 'karyawan_id');
    }


}
