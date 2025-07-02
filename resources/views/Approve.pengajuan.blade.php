@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Approve Pengajuan</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('pengajuan.approve', $pengajuan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama">NPK</label>
                    <input type="text" name="npk" id="npk" class="form-control" value="{{ $pengajuan->npk }}" disabled>
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" class="form-control" value="{{ $pengajuan->nama }}" disabled>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal Pengajuan Cuti</label>
                    <input type="text" id="tanggal" class="form-control" value="{{ $pengajuan->tanggal }}" disabled>
                </div>
                <div class="form-group
                    <label for="jenis_cuti">Jenis Cuti</label>
                    <input type="text" id="jenis_cuti" class="form-control" value="{{ $pengajuan->jenis_cuti }}" disabled>
                </div>
                <div class="form-group
                    <label for="tanggal_mulai">Tanggal Mulai</label>
                    <input type="text" id="tanggal_mulai" class="form-control" value="{{ $pengajuan->tanggal_mulai }}" disabled>
                </div>
                <div class="form-group
                    <label for="tanggal_selesai">Tanggal Selesai</label>
                    <input type="text" id="tanggal_selesai" class="form-control" value="{{ $pengajuan->tanggal_selesai }}" disabled>
                </div>
                <div class="form-group
                    <label for="jumlah_hari">Jumlah Hari</label>
                    <input type="text" id="jumlah_hari" class="form-control" value="{{ $pengajuan->jumlah_hari }}" disabled>
                </div>
                <div class="form-group
                    <label for="sisa_cuti">Sisa Cuti</label>
                    <input type="text" id="sisa_cuti" class="form-control" value="{{ $pengajuan->sisa_cuti }}" disabled>
                </div>
                <div class="form-group
                    <label for="status">Status</label>
                    <select id="status" class="form-control" name="status" required>
                        <option value="approved">Approve</option>
                        <option value="rejected">Reject</option>
                    </select>
                </div>
                <div class="form-group
                    <label for="alasan">Alasan Penolakan</label>
                    <textarea id="alasan" class="form-control" name="alasan" rows="3" placeholder="Masukkan alasan penolakan jika ada"></textarea>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea id="keterangan" class="form-control" rows="3" disabled>{{ $pengajuan->keterangan }}</textarea>
                </div>
                <button type="submit" class="btn btn-success">Approve</button>
                <a href="{{ route('pengajuan.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection