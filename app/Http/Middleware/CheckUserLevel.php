<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserLevel
{
    public function handle($request, Closure $next, ...$allowedPairs)
    {
        $user = Auth::user();
        $karyawan = $user->karyawan;

        if (!$karyawan) {
            abort(403, 'Akun belum terhubung ke data karyawan.');
        }

        $riwayat = $karyawan->riwayat_jabatan()->latest('created_at')->first();

        if (!$riwayat || !$riwayat->jabatan) {
            abort(403, 'Data jabatan belum tersedia.');
        }

        $jenisJabatan = $riwayat->jabatan->nama;
        $unit = $riwayat->unitKerja->nama;

        foreach ($allowedPairs as $pair) {
            $pair = trim($pair);
            if (str_starts_with($pair, 'unit:')) {
                $allowedUnit = trim(substr($pair, 5));
                if ($allowedUnit === $unit) {
                    return $next($request);
                }
                continue;
            }
            if (str_contains($pair, '-')) {
                [$allowedJabatan, $allowedUnit] = array_map('trim', explode('-', $pair, 2));
                if ($allowedJabatan === $jenisJabatan && $allowedUnit === $unit) {
                    return $next($request);
                }
                continue;
            }
            if ($pair === $jenisJabatan) {
                return $next($request);
            }
        }
        abort(403, 'Akses ditolak: Anda tidak memiliki izin.');
    }
}
