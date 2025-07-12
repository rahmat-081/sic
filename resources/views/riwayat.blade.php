@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-2 bg-light">
                @include('menu')
            </div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Riwayat') }}</div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Nama</th>
                                    <th>Unit Kerja</th>
                                    <th>Jenis Jabatan</th>
                                    <th>Jenis Cuti</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Jumlah Hari</th>
                                    <th>Alamat Cuti</th>
                                    <th>Jenis Approval</th>
                                    <th>Alasan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($riwayat as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->tanggal_pengajuan }}</td>
                                        <td>{{ $item->karyawan }}</td>
                                        <td>{{ $item->unit_kerja  }}</td>
                                        <td>{{ $item->jenis_jabatan }}</td>
                                        <td>{{ $item->jeniscuti }}</td>
                                        <td>{{ $item->mulai }}</td>
                                        <td>{{ $item->selesai }}</td>
                                        <td>{{ $item->total_hari }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->jenis_approval ?? 'Belum Diproses' }}</td>
                                        <td>{{ $item->alasan }}</td>
                                        
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