<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisJabatan;
use Illuminate\Support\Facades\DB;

class JenisJabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_jabatan')->insert([
            [
                'nama' => 'Pelaksana',
            ],
            [
                'nama' => 'Kepala Regu',
            ],
            [
                'nama' => 'Kepala Seksi',
            ],
            [
                'nama' => 'Manager',
            ],
            [
                'nama' => 'Direktur',
            ],
            
        ]);
        
    }
}
