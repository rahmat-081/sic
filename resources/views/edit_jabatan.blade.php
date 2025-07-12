@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Riwayat Jabatan</h2>
        <form action="{{ route('jabatan.update', $jabatan->id) }}" method="POST">
            @csrf
            @method('POST')

            <div class="form-group mt-3">
                <label for="karyawan_id">Karyawan</label>
                <select class="form-control" id="karyawan_id" name="karyawan_id">
                    @foreach ($karyawans as $k)
                        <option value="{{ $k->id }}">
                            {{ $k->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-3">
                <label for="jenis_jabatan_id">Jenis Jabatan</label>
                <select class="form-control" id="jenis_jabatan_id" name="jenis_jabatan_id">
                    @foreach ($jabatans as $j)
                        <option value="{{ $j->id }}">
                            {{ $j->nama }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="form-group mt-3">
                <label for="mulai">Mulai</label>
                <input type="date" class="form-control" id="mulai" name="mulai"
                    value="{{ $jabatan->mulai }}">
            </div>

            <div class="form-group mt-3">
                <label for="selesai">Selesai</label>
                <input type="date" class="form-control" id="selesai" name="selesai"
                    value="{{ $jabatan->selesai }}">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        </form>
    </div>
@endsection