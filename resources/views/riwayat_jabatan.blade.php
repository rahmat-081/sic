@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-2 bg-light">
                @include('menu')
            </div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Formulir Karyawan') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('jabatan.store') }}">
                            @csrf
                            <select class="form-control mt-3" id="karyawan_id" name="karyawan_id" aria-label="Karyawan">
                                    <option value="">Pilih Karyawan</option>
                                    @foreach ($riwayatJabatans as $rj)
                                        <option value="{{ $rj->karyawan->id }}">{{ $rj->karyawan->nama }}</option>
                                    @endforeach
                                </select>
                                <select class="form-control mt-3" id="jenis_jabatan_id" name="jenis_jabatan_id" aria-label="Jenis Jabatan">
                                    <option value="">Pilih Jenis Jabatan</option>
                                    @foreach ($riwayatJabatans as $rj)
                                        <option value="{{ $rj->jabatan->id }}">{{ $rj->jabatan->nama }}</option>
                                    @endforeach
                                </select>
                                <select class="form-control mt-3" id="unit_kerja_id" name="unit_kerja_id" aria-label="unit_kerja_id">
                                    <option value="">Pilih Unit Kerja</option>
                                    @foreach ($riwayatJabatans as $rj)
                                        <option value="{{ $rj->unitKerja->id }}">{{ $rj->unitKerja->nama }}</option>
                                    @endforeach
                                </select>
                            <div class="form-group">
                                <label for="mulai">Mulai</label>
                                <input type="date" class="form-control" id="mulai" name="mulai" required>
                            </div>
                            <div class="form-group">
                                <label for="selesai">Selesai</label>
                                <input type="date" class="form-control" id="selesai" name="selesai" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary mt-3" value="Simpan">
                            </div>

                        </form>
                    </div>

                </div>
                <div class="card">
                    <div class="card-header">{{ __('Database Riwayat Jabatan') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Unit Kerja</th>
                                    <th>Mulai</th>
                                    <th>Selesai</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayatJabatans as $rj)
                                    <tr>
                                        <td>{{ $rj->karyawan->nama }}</td>
                                        <td>{{ $rj->jabatan->nama }}</td>
                                        <td>{{ $rj->unitKerja->nama }}</td>
                                        <td>{{ $rj->mulai }}</td>
                                        <td>{{ $rj->selesai }}</td>
                                        <td>
                                            <a href="{{ route('jabatan.edit', $rj->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        </td>
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