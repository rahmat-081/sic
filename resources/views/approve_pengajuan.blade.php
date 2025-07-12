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
                        <form method="POST" action="{{ route('approve.store') }}">
                            @csrf
                            <div class="form-group">
                                <select class="form-control mt-3" id="pengajuan" name="pengajuan" aria-label="Pengajuan">
                                    <option value="">Pilih Pengajuan Karyawan</option>
                                    @foreach ($pengajuan as $user)
                                        @if ($user->karyawan)
                                            <option value="{{ $user->id }}">
                                                {{ $user->id }} - {{ $user->karyawan->nama }}
                                            </option>
                                        @endif
                                    @endforeach

                                </select>
                                <select class="form-control mt-3" id="jenis_approval" name="jenis_approval"
                                    aria-label="Pengajuan">
                                    <option value="">Jenis Approval</option>
                                    @foreach ($jenis_approval as $user)
                                        <option value="{{ $user->id }}">
                                            {{ $user->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="alasan" id="alasan" name="alasan"
                                        aria-label="Alasan">
                                </div>
                                <input type="submit" class="btn btn-primary mt-3" value="Simpan">
                            </div>

                        </form>
                    </div>

                </div>
                <div class="card">
                    <div class="card-header">{{ __('Riwayat') }}</div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Jenis Approval</th>
                                    <th>Alasan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($history as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->pengajuan->karyawan->nama }}</td>
                                        <td>{{ $item->jenis_approval->nama }}</td>
                                        <td>{{ $item->alasan }}</td>
                                        <td><a href="{{ route('approve.edit', $item->id) }}" class="btn btn-warning">Edit</a>
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