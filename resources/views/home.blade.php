@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="col-md-2 bg-light">
        @include('menu')
        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('SISTEM INFORMASI CUTI') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Selamat datang di Sistem Informasi Cuti Karyawan!') }}
                    <br>
                    {{ __('Sistem ini dirancang untuk memudahkan pengelolaan cuti karyawan di perusahaan Anda.') }}
                    <br>
                    {{ __('Dengan sistem ini, Anda dapat mengajukan cuti secara online, memantau status pengajuan, dan mengelola riwayat cuti dengan lebih efisien.') }}
                    <br>
                    {{ __('Berikut adalah beberapa fitur utama dari sistem ini:') }}
                    <ul>
                        <li>{{ __('Pengajuan cuti online yang mudah dan cepat.') }}</li>
                        <li>{{ __('Pemberitahuan otomatis untuk status pengajuan cuti.') }}</li>
                        <li>{{ __('Riwayat cuti yang terorganisir dan mudah diakses.') }}</li>
                        <li>{{ __('Laporan dan analisis data cuti untuk pengambilan keputusan.') }}</li>
                        <li>{{ __('Integrasi dengan sistem HR yang ada.') }}</li>
                    </ul>
                    {{ __('Kami berharap sistem ini dapat membantu Anda dalam mengelola cuti karyawan dengan lebih baik.') }}
                    <br>
                    {{ __('Jika Anda memiliki pertanyaan atau membutuhkan bantuan, silakan hubungi tim dukungan kami.') }}
                    <br>
                    {{ __('Terima kasih telah menggunakan Sistem Informasi Cuti Karyawan!') }}
                    
                    <br>
                    {{ __('Salam,') }}
                    <br>
                    {{ __('Tim Pengembang Sistem Informasi Cuti Karyawan') }}
                    <br>
                    {{ __('Waktu: ') }}{{ date('H:i:s') }}
                    <br>
                    {{ __('Versi: ') }}{{ config('app.version') }}
                    <br>
                    {{ __('Dikembangkan oleh: ') }}{{ config('app.developer') }}
                    <br>
                    {{ __('Email: ') }}{{ config('app.developer_email') }}
                    <br>
                    {{ __('Telepon: ') }}{{ config('app.developer_phone') }}
                    <br>
                    {{ __('Alamat: ') }}{{ config('app.developer_address') }}
                    <br>
                    {{ __('Website: ') }}{{ config('app.developer_website') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
