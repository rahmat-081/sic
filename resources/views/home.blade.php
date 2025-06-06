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
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    sembarang
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
