<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    protected $table = 'unit_kerja';
    protected $fillable = ['nama', 'jenis_unit_id'];

    /**
     * Get the jenis unit that owns the unit kerja.
     */
    public function JenisUnit()
    {
        return $this->belongsTo(JenisUnit::class, 'jenis_unit_id');
    }

    /**
     * Get the parent unit kerja (induk).
     */
    public function induk()
    {
        return $this->belongsTo(UnitKerja::class, 'induk_id');
    }
    public $timestamps = false;

}
