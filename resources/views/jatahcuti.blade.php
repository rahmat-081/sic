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
                    <p>Unit Kerja: {{$userkaryawan->unitkerja}}</p>
                    <p>Jabatan: {{ $userkaryawan->jabatan }}</p>
                    <p>Jenis Kelamin: {{ $userkaryawan->gender }}</p>
                    <p>Alamat: {{ $userkaryawan->alamat }}</p>
                </div>
            </div>


        </div>  
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Jatah Cuti') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('jatahcuti.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="karyawan">Karyawan</label>
                            <select class="form-control" id="karyawan" name="karyawan" required>
                                <option value="" disabled selected>Pilih Karyawan</option>
                                @foreach($karyawans as $karyawan)
                                    <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jenis_cuti">Jenis Cuti</label>
                            <select class="form-control" id="jenis_cuti" name="jenis_cuti" required>
                                <option value="" disabled selected>Pilih Jenis Cuti</option>
                                @foreach($jeniscuti as $cuti)
                                    <option value="{{ $cuti->id }}">{{ $cuti->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <input type="number" class="form-control" id="tahun" name="tahun" required>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Sisa Cuti') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Karyawan</th>
                                <th>Jenis Cuti</th>
                                <th>Tahun</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jatahcuti as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->karyawan->nama }}</td>
                                    <td>{{ $item->jenisCuti->nama }}</td>
                                    <td>{{ $item->tahun }}</td>
                                    <td>{{ $item->jumlah }}</td>
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
