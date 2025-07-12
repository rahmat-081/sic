<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Auth;
use App\Models\PengajuanCuti;
class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $user = Auth::user();
            $jenisJabatan = null;
            $unitKerja = null;

            if ($user && $user->karyawan) {
                $riwayat = $user->karyawan->riwayat_jabatan()->latest('created_at')->first();

                $jenisJabatan = optional($riwayat?->jabatan)->nama;
                $unitKerja = optional($riwayat?->unitKerja)->nama;
            }

            $view->with([
                'jenisJabatan' => $jenisJabatan,
                'unitKerja' => $unitKerja,
            ]);
        });

        View::composer('*', function ($view) {
            if (auth()->check()) {
                $user = auth()->user();
                $karyawan = $user->karyawan;

                $riwayatJabatan = $karyawan->riwayat_jabatan()
                    ->whereDate('mulai', '<=', today())
                    ->whereDate('selesai', '>=', today())
                    ->with('jabatan')
                    ->first();

                $currentJabatanNama = strtolower($riwayatJabatan->jabatan->nama ?? '');
                $unitKerjaId = $riwayatJabatan->unit_kerja_id ?? null;

                $targetJabatanNama = match ($currentJabatanNama) {
                    'direktur' => 'manager',
                    'manager' => 'kepala seksi',
                    'kepala seksi' => 'kepala regu',
                    'kepala regu' => 'pelaksana',
                    default => null,
                };

                $jumlahPengajuanBaru = 0;

                if ($targetJabatanNama && $unitKerjaId) {
                    $jumlahPengajuanBaru = PengajuanCuti::whereHas('karyawan.riwayat_jabatan', function ($q) use ($targetJabatanNama, $unitKerjaId, $currentJabatanNama) {
                        $q->whereHas('jabatan', function ($q2) use ($targetJabatanNama) {
                            $q2->whereRaw('LOWER(nama) = ?', [strtolower($targetJabatanNama)]);
                        });
                    
                        if ($currentJabatanNama !== 'direktur') {
                            $q->where('unit_kerja_id', $unitKerjaId);
                        }
                    
                        $q->whereDate('mulai', '<=', today())
                          ->whereDate('selesai', '>=', today());
                    })
                        ->whereDoesntHave('riwayatPengajuan')
                        ->count();
                }

                $view->with('jumlahPengajuanBaru', $jumlahPengajuanBaru);
            }
        });
    }
}
