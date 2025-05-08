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
                <div class="card-header">{{ __('Formulir Pengajuan') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('pengajuan.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="jenis_cuti">Jenis Cuti</label>
                            <select class="form-control" id="jenis_cuti" name="jenis_cuti" required>
                                <option value="Tahunan">Cuti Tahunan</option>
                                <option value="Sakit">Cuti Sakit</option>
                                <option value="Melahirkan">Cuti Melahirkan</option>
                                <option value="Penting">Cuti Besar</option>
                            </select>
                        </div>
                        <div class="input-group mb-2">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                            
                            <label for="tanggal_selesai">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required>
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
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajukan</button>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Riwayat') }}</div>

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
                                <th>Tanggal Pengajuan</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Jumlah Hari</th>
                                <th>Sisa Cuti</th>
                                <th>Jenis Approval</th>
                                <th>Alasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($histori_pengajuan as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->status }}</td>
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
