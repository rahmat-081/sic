<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Auth;

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
    }
}
