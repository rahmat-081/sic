@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Karyawan</h2>
        <form action="{{ route('approve.update', $riwayat->id) }}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="user"></label>
                <select name="pengajuan" id="user" class="form-control" required>
                    @foreach ($pengajuan as $user)
                        <option value="{{ $user->id }}">{{ $user->karyawan->nama }}</option>
                    @endforeach
                </select>
                <select name="jenis_approval" id="jenis_approval" class="form-control" required>
                    @foreach ($jenis_approval as $user)
                        <option value="{{ $user->id }}">{{ $user->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="alasan">Alasan</label>
                <input type="text" name="alasan" id="alasan" class="form-control"
                    value="{{ old('alasan', $riwayat->alasan) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection