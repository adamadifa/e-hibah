@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
@section('titlepage', 'Detail Penerima Hibah')

@section('content')
@section('navigasi')
    <span class="text-muted fw-light">Penerima Hibah</span> / Detail
@endsection
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="user-profile-header-banner">
                <img src="../../assets/img/pages/profile-banner.png" alt="Banner image" class="rounded-top">
            </div>
            <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                    <img src="../../assets/img/avatars/14.png" alt="user image"
                        class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
                </div>
                <div class="flex-grow-1 mt-3 mt-sm-5">
                    <div
                        class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                        <div class="user-profile-info">
                            <h4>{{ $penerimahibah->nama }}</h4>
                            <ul
                                class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                <li class="list-inline-item d-flex gap-1">
                                    <i class="ti ti-phone"></i> {{ $penerimahibah->no_telepon }}
                                </li>
                                <li class="list-inline-item d-flex gap-1"><i class="ti ti-mail"></i>
                                    {{ $penerimahibah->email }}
                                </li>
                                <li class="list-inline-item d-flex gap-1">
                                    <i class="ti ti-map-pin"></i> {{ $penerimahibah->alamat }}
                                </li>
                            </ul>
                        </div>
                        <div class="btn">
                            <a href="javascript:void(0)" class="btn btn-primary waves-effect waves-light me-1">
                                <i class="ti ti-file-text me-1"></i>Daftarkan Proposal
                            </a>
                            <a href="javascript:void(0)" class="btn btn-success waves-effect waves-light">
                                <i class="ti ti-user-plus me-1"></i>Buatkan Akun
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-4 col-lg-5 col-md-5">
        <!-- About User -->
        <div class="card mb-4">
            <div class="card-body">
                <small class="card-text text-uppercase">Penerima Hibah</small>
                <ul class="list-unstyled mb-4 mt-3">
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Nama Penerima
                            Hibah :</span> <span>{{ $penerimahibah->nama }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-map-pin text-heading"></i><span
                            class="fw-medium mx-2 text-heading">Alamat:</span>
                        <span>{{ $penerimahibah->alamat }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-barcode text-heading"></i><span class="fw-medium mx-2 text-heading">No.
                            Izin:</span>
                        <span>{{ $penerimahibah->no_izin }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-phone text-heading"></i><span class="fw-medium mx-2 text-heading">No.
                            Telepon:</span>
                        <span>{{ $penerimahibah->no_telepon }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-mail text-heading"></i><span class="fw-medium mx-2 text-heading">Email:</span>
                        <span>{{ $penerimahibah->email }}</span>
                    </li>
                </ul>
                <small class="card-text text-uppercase">Penanggung Jawab</small>
                <ul class="list-unstyled mb-4 mt-3">
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-user"></i><span class="fw-medium mx-2 text-heading">Penanggung
                            Jawab:</span>
                        <span>{{ $penerimahibah->penanggung_jawab }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-phone-call"></i><span class="fw-medium mx-2 text-heading">No. Telepon:</span>
                        <span>{{ $penerimahibah->no_telepon_penanggung_jawab }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-mail"></i><span class="fw-medium mx-2 text-heading">Email:</span>
                        <span>{{ $penerimahibah->email_penanggung_jawab }}</span>
                    </li>
                </ul>
                <small class="card-text text-uppercase">Data Rekening</small>
                <ul class="list-unstyled mb-0 mt-3">
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-building"></i><span class="fw-medium mx-2 text-heading">Nama Bank:</span>
                        <span>{{ $penerimahibah->nama_bank }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-credit-card"></i><span class="fw-medium mx-2 text-heading">No. Rekening:</span>
                        <span>{{ $penerimahibah->no_rekening }}</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="ti ti-user"></i><span class="fw-medium mx-2 text-heading">Nama Pemilik
                            Rekening:</span>
                        <span>{{ $penerimahibah->nama_pemilik_rekening }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <!--/ About User -->


    </div>
    <div class="col-xl-8 col-lg-7 col-md-7">
        <!-- Activity Timeline -->
        <div class="card card-action mb-4">
            <div class="card-header align-items-center">
                <h5 class="card-action-title mb-0">Riwayat Penerimaan Dana Hibah</h5>

            </div>
            <div class="card-body ">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Proposal</th>
                            <th>Tanggal</th>
                            <th>Perihal</th>
                            <th>Tahun Anggaran</th>
                            <th>Total Ajuan</th>
                            <th>Total Diterima</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
        <!--/ Activity Timeline -->
    </div>
</div>
@endsection
