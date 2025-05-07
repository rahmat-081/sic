<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisLibur;
use Illuminate\Support\Facades\DB;

class JenisLiburSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_libur')->insert([
            [
                'nama' => 'Nasional',
            ],
            [
                'nama' => 'lokal',
            ],
            
        ]);
        
    }
}
