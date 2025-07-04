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
                <div class="card-header">{{ __('Formulir Pengajuan') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('pengajuan.store') }}">
                        @csrf
                        <input type="hidden" name="karyawan" value="{{ $userkaryawan->id }}">
                        <div class="form-group
                            <label for="tanggal_pengajuan">Tanggal Pengajuan</label>
                            <input type="date" class="form-control" id="tanggal_pengajuan" name="tanggal_pengajuan" value="{{ date('Y-m-d') }}" required>
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
                                @foreach($jatahcuti as $cuti)
                                    <option value="{{ $cuti->id }}">{{ $cuti->jumlah }} Hari ({{ $cuti->tahun }})</option>
                                @endforeach
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
                        <div class="form-group
                            <label for="jumlah_hari">Jumlah Hari</label>
                            <input type="number" class="form-control" id="jumlah_hari" name="jumlah_hari" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="alamat_cuti">Alamat Cuti</label>
                            <textarea class="form-control" id="alamat_cuti" name="alamat_cuti" rows="1" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="alasan">Alasan</label>
                            <textarea class="form-control" id="alasan" name="alasan" rows="3" required></textarea>
                        </div>

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
                <p>Jatah Cuti: {{  $jatahcuti[0]->jumlah }}, sisa: {{ $sisacuti }}</p>
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
                            @foreach($histori_pengajuan as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->pengajuan->tanggal_pengajuan }}</td>
                                    <td>{{ $item->pengajuan->jeniscuti->nama }}</td>
                                    <td>{{ $item->pengajuan->mulai }}</td>
                                    <td>{{ $item->pengajuan->selesai }}</td>
                                    <td>{{ $item->pengajuan->total_hari }}</td>
                                    <td>{{ $item->pengajuan->alamat }}</td>
                                    <td>{{ $item->jenis_approval->nama }}</td>
                                    <td>{{ $item->pengajuan->alasan }}</td>
                                    <td>{{ $item->pengajuan->keterangan }}</td>
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
