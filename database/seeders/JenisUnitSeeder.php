<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisUnit;
use Illuminate\Support\Facades\DB;

class JenisUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_unit')->insert([
            [
                'nama' => 'regu',
            ],
            [
                'nama' => 'seksi',
            ],
            [
                'nama' => 'departemen',
            ],
            [
                'nama' => 'direktorat',
            ],
            [
                'nama' => 'bidang',
            ],
            
        ]);
        
    }
}
