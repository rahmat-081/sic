@if ($jenisJabatan === 'Pelaksana' and $unitKerja !== 'SDM')
    <div class="container">
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('pengajuan') }}">Pengajuan Cuti</a></li>
        </ul>
    </div>
@endif

@if ($jenisJabatan !== 'Pelaksana' and $unitKerja !== 'SDM') 
    <hr>
    <div class="container">
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('approve.pengajuan') }}">Approve Pengajuan Cuti</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('atasan.pengajuan') }}">Pengajuan Cuti</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('atasan.strukturorganisasi') }}">Struktur Organisasi</a>
            </li>
        </ul>
    </div>
@endif

@if ($jenisJabatan === 'Pelaksana' and $unitKerja === 'SDM')
    <hr>
    <div class="container">
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('karyawan') }}">Karyawan</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('sdm.pengajuan') }}">Pengajuan Cuti</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('jatahcuti') }}">Jatah Cuti</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('strukturorganisasi') }}">Struktur Organisasi</a></li>
        </ul>
    </div>
@endif


@if ($jenisJabatan !== 'Pelaksana' and $unitKerja === 'SDM')
    <hr>
    <div class="container">
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('karyawan') }}">Karyawan</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('jatahcuti') }}">Jatah Cuti</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('approve.pengajuan') }}">Approve Pengajuan Cuti</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('atasan.pengajuan') }}">Pengajuan Cuti</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('atasan.strukturorganisasi') }}">Struktur Organisasi</a></li>
        </ul>
    </div>
@endif