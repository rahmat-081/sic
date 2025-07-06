@php

    $route_store = '';

    if ($jenisJabatan !== 'Pelaksana') {
        $route_store = route('atasan.pengajuan.store');
    } elseif ($unitKerja == 'SDM') {
        $route_store = route('sdm.pengajuan.store');
    } else {
        $route_store = route('pengajuan.store');
    }
@endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-2 bg-light">
                @include('menu')
                <div class="card">
                    <div class="card-header">{{ $biodata->nama_karyawan }}</div>
                    <div class="card-body">
                        <p>NPK: {{ $biodata->npk }}</p>
                        <p>Unit Kerja: {{ $biodata->unitkerja }}</p>
                        <p>Jabatan: {{ $biodata->jabatan }}</p>
                        <p>Jenis Kelamin: {{ $biodata->gender }}</p>
                        <p>Alamat: {{ $biodata->alamat_karyawan }}</p>

                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Formulir Pengajuan') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ $route_store }}">
                            @csrf
                            <input type="hidden" name="karyawan" value="{{ $userkaryawan->id }}">
                            <div class="form-group">
                                <label for="tanggal_pengajuan">Tanggal Pengajuan</label>
                                <input type="date" class="form-control" id="tanggal_pengajuan" name="tanggal_pengajuan"
                                    value="{{ date('Y-m-d') }}" required>
                            </div>

                            <div class="input-group mb-3">
                                <label for="jenis_cuti"></label>
                                <select class="form-control" id="jenis_cuti" name="jenis_cuti" required>
                                    <option value="" disabled selected>Pilih Jenis Cuti</option>
                                    @foreach($jeniscuti as $cuti)
                                        <option value="{{ $cuti->id }}">{{ $cuti->nama }}</option>
                                    @endforeach
                                </select>
                                <label for="jatah_cuti"></label>
                                <select class="form-control" id="jatah_cuti" name="jatah_cuti" required>
                                    <option value="" disabled selected>Pilih Jatah Cuti</option>
                                    @foreach($jatahcuti as $jatah)
                                        <option value="{{ $jatah->id }}">
                                            {{ $jatah->jenisCuti->nama }} - {{ $jatah->jumlah }} Hari ({{ $jatah->tahun }})
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="input-group mb-2">
                                <label for="tanggal_mulai">Tanggal Mulai</label>
                                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>

                                <label for="tanggal_selesai">Tanggal Selesai</label>
                                <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai"
                                    required>
                            </div>

                            <!-- <div class="form-group">
                                                                    <label for="tanggal_mulai">Tanggal Mulai</label>
                                                                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="tanggal_selesai">Tanggal Selesai</label>
                                                                    <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required>
                                                                </div> -->
                            <div class="form-group">
                                <label for="jumlah_hari">Jumlah Hari</label>
                                <input type="number" class="form-control" id="jumlah_hari" name="jumlah_hari" required>
                            </div>

                            <div class="form-group">
                                <label for="alamat_cuti">Alamat Cuti</label>
                                <textarea class="form-control" id="alamat_cuti" name="alamat_cuti" rows="1"
                                    required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="alasan">Alasan</label>
                                <textarea class="form-control" id="alasan" name="alasan" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Ajukan</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">{{ __('Riwayat') }}</div>

                    <div class="card-body">
                        @if($jatahcuti->isNotEmpty())
                            <p>Jatah Cuti: {{ $jatahcuti->first()->jumlah }}, sisa: {{ $sisacuti }}</p>
                        @else
                            <p class="text-warning">Belum ada data jatah cuti.</p>
                        @endif
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Jenis Cuti</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Jumlah Hari</th>
                                    <th>Alamat Cuti</th>
                                    <th>Jenis Approval</th>
                                    <th>Alasan</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($riwayat as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->tanggal_pengajuan }}</td>
                                        <td>{{ $item->jeniscuti }}</td>
                                        <td>{{ $item->mulai }}</td>
                                        <td>{{ $item->selesai }}</td>
                                        <td>{{ $item->total_hari }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->jenis_approval ?? 'Belum Diproses' }}</td>
                                        <td>{{ $item->alasan }}</td>
                                        <td>{{ $item->keterangan ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10">Belum ada pengajuan cuti.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection