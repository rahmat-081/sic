@php

    $route_store = '';


    if ($jenisJabatan !== 'Pelaksana') {
        $route_store = route('atasan.strukturorganisasi.store');
    } else {
        $route_store = route('strukturorganisasi.store');
    }

@endphp
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-2 bg-light">
    @include('menu')

        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Formulir Struktur Organisasi') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ $route_store }}">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required> 
                        </div>

                        <div class="form-group">
                            <label for="jenis_unit_id">Jenis Unit id</label>
                            <select class="form-control" id="jenis_unit_id" name="jenis_unit_id" required>
                                <option value="">Pilih Jenis Unit</option>
                                @foreach ($jenisunits as $jenis_unit)
                                    <option value="{{ $jenis_unit->id }}">{{ $jenis_unit->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajukan</button>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Struktur Organisasi') }}</div>

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
                                <th>Jenis Organisasi</th>
                                <th>Nama</th>
                                <th>Induk</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($unitkerjas as $unitkerja)
                                <tr>
                                    <td>{{ $unitkerja->id }}</td>
                                    <td>{{ $unitkerja->jenisunit->nama}}</td>
                                    <td>{{ $unitkerja->nama }}</td>
                                    <td>{{ $unitkerja->induk ? $unitkerja->induk->nama : 'Tidak ada' }}</td>
                                </tr>
                            @endforeach
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
