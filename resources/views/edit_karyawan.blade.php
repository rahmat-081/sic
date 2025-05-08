@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Karyawan</h2>
    <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST">
        @csrf
        @method('POST')

        <div class="form-group">
            <label for="npk">NPK</label>
            <input type="text" name="npk" id="npk" class="form-control" value="{{ old('npk', $karyawan->npk) }}" required>
        </div>

<div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $karyawan->nama) }}" required>
        </div>

        <div class="form-group">
            <label for="tempatlahir">TempatLahir</label>
            <input type="tempatlahir" name="tempatlahir" id="tempatlahir" class="form-control" value="{{ old('tempatlahir', $karyawan->tempatlahir) }}" required>
        </div>

        <div class="form-group">
            <label for="tanggallahir">TanggalLahir</label>
            <input type="text" name="tanggallahir" id="tanggallahir" class="form-control" value="{{ old('tanggallahir', $karyawan->tanggallahir) }}" required>
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <input type="text" name="gender" id="gender" class="form-control" value="{{ old('gender', $karyawan->gender) }}" required>
        </div>

        <div class="form-group">
            <label for="nik">NIK</label>
            <input type="text" name="nik" id="nik" class="form-control" value="{{ old('nik', $karyawan->nik) }}" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" id="alamat" class="form-control" value="{{ old('alamat', $karyawan->alamat) }}" required>
        </div>

<button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection