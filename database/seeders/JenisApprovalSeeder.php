<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisApproval;
use Illuminate\Support\Facades\DB;

class JenisApprovalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_approval')->insert([
            [
                'nama' => 'Disetujui',
            ],
            [
                'nama' => 'Ditolak',
            ],
            [
                'nama' => 'Dibatalkan',
            ],
            [
                'nama' => 'Ditangguhkan',
            ],
            
        ]);
        
    }
}
