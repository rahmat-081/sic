@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-2 bg-light">
    @include('menu')
    
            <div class="card">
                <div class="card-header">{{ $userkaryawan->nama }}</div>
                <div class="card-body">
                    <p>NPK: {{ $userkaryawan->npk }}</p>
                    <p>Jenis Kelamin: {{ $userkaryawan->gender }}</p>
                    <p>Alamat: {{ $userkaryawan->alamat }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Riwayat') }}</div>

                <div class="card-body">
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NPK</th>
                                <th>Nama</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Jenis Cuti</th>
                                <th>Jatah Cuti</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Jumlah Hari</th>
                                <th>Sisa Cuti</th>
                                <th>Alamat Cuti</th>
                                <th>Jenis Approval</th>
                                <th>Alasan</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($histori_pengajuan as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->karyawan->npk }}</td>
                                    <td>{{ $item->karyawan->nama }}</td>
                                    <td>{{ $item->tanggal_pengajuan }}</td>
                                    <td>{{ $item->jeniscuti->nama }}</td>
                                    <td>{{ $item->jatahcuti->jumlah }} Hari ({{ $item->jatahcuti->tahun }})</td>
                                    <td>{{ $item->mulai }}</td>
                                    <td>{{ $item->selesai }}</td>
                                    <td>{{ $item->total_hari }}</td>
                                    <td>{{ $item->sisa_cuti }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->jenis_approval }}</td>
                                    <td>{{ $item->alasan }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
