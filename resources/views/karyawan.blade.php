@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-2 bg-light">
            <div class="container">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="{{ route("home") }}" >Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route("karyawan") }}" >Karyawan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{  route('pengajuan') }}">Pengajuan Cuti</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{  route('riwayat')}}">Riwayat Pengajuan</a></li>
                </ul>
            </div>
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
                    <form method="POST" action="{{ route('karyawan.store') }}">
                        @csrf
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="NPK" id="npk" name="npk" aria-label="NPK">
                                <span class="input-group-text"></span>
                                <input type="text" class="form-control" placeholder="Nama" id="nama" name="nama" aria-label="Nama">
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Tempat Lahir" id="tempatlahir" name="tempatlahir" aria-label="Tempat Lahir">
                                <span class="input-group-text"></span>
                                <input type="date" class="form-control" placeholder="Tanggal Lahir" id="tanggallahir" name="tanggallahir" aria-label="Tanggal Lahir">
                            </div>
                            <div class="input-group mb-3">
                                <select class="form-control" placeholder="gender" id="gender" name="gender" aria-label="Gender"> 
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                
                                <span class="input-group-text"></span>
                                <input type="number" class="form-control" placeholder="NIK" id="nik" name="nik" aria-label="NIK" maxlength="16" oninput="if(this.value.length > 16) this.value = this.value.slice(0, 16);">
                            </div>
                            <input type="text" class="form-control" placeholder="Alamat" id="alamat" name="alamat" required>
                            <input type="submit" class="btn btn-primary mt-3" value="Simpan">
                        </div>

                    </form>
                </div>

            </div>
            <div class="card">
                <div class="card-header">{{ __('Formulir Karyawan') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>NPK</th>
                                <th>Nama</th>
                                <th>TempatLahir</th>
                                <th>TanggalLahir</th>
                                <th>Gender</th>
                                <th>NIK</th>
                                <th>Alamat</th>
                                <th>Action</th>
                                </tr>
                        </thead>
                        <tbody>
                            @foreach ($karyawans as $k)
                            <tr>
                                <td>
                                    <a href="{{ route('karyawan.edit', $k->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                </td>
                                <td>{{ $k->npk }}</td>
                                <td>{{ $k->nama }}</td>
                                <td>{{ $k->tempatlahir }}</td>
                                <td>{{ $k->tanggallahir }}</td>
                                <td>{{ $k->gender }}</td>
                                <td>{{ $k->nik }}</td>
                                <td>{{ $k->alamat }}</td>
                                <td>{{ $k->action }}</td>
                                <td>
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
