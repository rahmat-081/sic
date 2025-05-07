<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisCuti;
use Illuminate\Support\Facades\DB;

class JenisCutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_cuti')->insert([
            [
                'nama' => 'Tahunan',
            ],
            [
                'nama' => 'Sakit',
            ],
            [
                'nama' => 'Melahirkan',
            ],
            [
                'nama' => 'Cuti Besar',
            ],
        ]);
        
    }
}
