<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisStatus;
use Illuminate\Support\Facades\DB;

class JenisStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_status')->insert([
            [
                'nama' => 'Tetap',
            ],
            [
                'nama' => 'Kontrak',
            ],
            [
                'nama' => 'Magang',
            ],
            [
                'nama' => 'Outsourcing',
            ],
            [
                'nama' => 'Pensiun',
            ],
            [
                'nama' => 'Resign',
            ],
        ]);
        
    }
}
