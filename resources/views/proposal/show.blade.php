@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
@section('titlepage', 'Detail Proposal')

@section('content')
@section('navigasi')
    <span class="text-muted fw-light">Proposal</span> / Detail
@endsection
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="user-profile-header-banner">
                <img src="{{ asset('assets/img/pages/profile-banner.png') }}" alt="Banner image" class="rounded-top">
            </div>
            <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                    <img src="{{ asset('/assets/img/dokumen.png') }}" alt="user image"
                        class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" style="border: none !important">
                </div>
                <div class="flex-grow-1 mt-3 mt-sm-5">
                    <div
                        class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                        <div class="user-profile-info">
                            <h4>{{ $proposal->judul_proposal }} ({{ $proposal->nama }})</h4>
                            <ul
                                class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                <li class="list-inline-item d-flex gap-1">
                                    <i class="ti ti-barcode"></i> {{ $proposal->no_registrasi }}
                                </li>
                                <li class="list-inline-item d-flex gap-1"><i class="ti ti-mail"></i>
                                    {{ $proposal->email }}
                                </li>
                                <li class="list-inline-item d-flex gap-1">
                                    <i class="ti ti-calendar"></i> {{ DateToIndo($proposal->tanggal_proposal) }}
                                </li>
                            </ul>
                        </div>
                        <div class="btn">

                            <a href="javascript:void(0)" class="btn btn-success waves-effect waves-light">
                                <i class="ti ti-brand-telegram me-1"></i>Kirim Disposisi
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
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <small class="card-text text-uppercase">Data Proposal</small>
                        <ul class="list-unstyled mb-4 mt-3">
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-user text-barcode"></i><span class="fw-medium mx-2 text-heading">No.
                                    Register :</span> <span>{{ $proposal->no_registrasi }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-calendar text-heading"></i><span
                                    class="fw-medium mx-2 text-heading">Tanggal
                                    Proposal :</span> <span>{{ DateToIndo($proposal->tanggal_proposal) }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-barcode text-heading"></i><span class="fw-medium mx-2 text-heading">No.
                                    Surat :</span> <span>{{ $proposal->no_surat }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-calendar text-heading"></i><span
                                    class="fw-medium mx-2 text-heading">Tanggal
                                    Surat :</span> <span>{{ DateToIndo($proposal->tanggal_surat) }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-file-text text-heading"></i><span
                                    class="fw-medium mx-2 text-heading">Judul Proposal</span>
                                <span>{{ $proposal->judul_proposal }}</span>
                            </li>
                        </ul>
                        <a href="{{ getdocLampiransurat($proposal->lampiran_surat) }}" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-type-pdf"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                                <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
                                <path d="M17 18h2" />
                                <path d="M20 15h-3v6" />
                                <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" />
                            </svg>
                            Lampiran Surat / Proposal
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- About User -->
                <div class="card mb-4">
                    <div class="card-body">
                        <small class="card-text text-uppercase">Penerima Hibah</small>
                        <ul class="list-unstyled mb-4 mt-3">
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Nama
                                    Penerima
                                    Hibah :</span> <span>{{ $proposal->nama }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-map-pin text-heading"></i><span
                                    class="fw-medium mx-2 text-heading">Alamat:</span>
                                <span>{{ $proposal->alamat }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-barcode text-heading"></i><span class="fw-medium mx-2 text-heading">No.
                                    Izin:</span>
                                <span>{{ $proposal->no_izin }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-phone text-heading"></i><span class="fw-medium mx-2 text-heading">No.
                                    Telepon:</span>
                                <span>{{ $proposal->no_telepon }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-mail text-heading"></i><span
                                    class="fw-medium mx-2 text-heading">Email:</span>
                                <span>{{ $proposal->email }}</span>
                            </li>
                        </ul>
                        <small class="card-text text-uppercase">Penanggung Jawab</small>
                        <ul class="list-unstyled mb-4 mt-3">
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-user"></i><span class="fw-medium mx-2 text-heading">Penanggung
                                    Jawab:</span>
                                <span>{{ $proposal->penanggung_jawab }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-phone-call"></i><span class="fw-medium mx-2 text-heading">No.
                                    Telepon:</span>
                                <span>{{ $proposal->no_telepon_penanggung_jawab }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-mail"></i><span class="fw-medium mx-2 text-heading">Email:</span>
                                <span>{{ $proposal->email_penanggung_jawab }}</span>
                            </li>
                            <img src="{{ getdocPenerimahibah($proposal->file_ktp) }}" alt="user-avatar"
                                class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
                        </ul>
                        <small class="card-text text-uppercase">Data Rekening</small>
                        <ul class="list-unstyled mb-0 mt-3">
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-building"></i><span class="fw-medium mx-2 text-heading">Nama
                                    Bank:</span>
                                <span>{{ $proposal->nama_bank }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-credit-card"></i><span class="fw-medium mx-2 text-heading">No.
                                    Rekening:</span>
                                <span>{{ $proposal->no_rekening }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-3">
                                <i class="ti ti-user"></i><span class="fw-medium mx-2 text-heading">Nama Pemilik
                                    Rekening:</span>
                                <span>{{ $proposal->nama_pemilik_rekening }}</span>
                            </li>
                            <img src="{{ getdocPenerimahibah($proposal->file_rekening) }}" alt="user-avatar"
                                class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
                        </ul>
                    </div>
                </div>
                <!--/ About User -->
            </div>
        </div>



    </div>
    <div class="col-xl-8 col-lg-7 col-md-7">
        <!-- Activity Timeline -->
        <div class="card card-action mb-4">
            <div class="card-header align-items-center">
                <h5 class="card-action-title mb-0">Status Proposal</h5>

            </div>
            <div class="card-body ">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Waktu Kirim</th>
                            <th>Diterma Oleh</th>
                            <th>Status</th>
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
