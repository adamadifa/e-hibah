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
@endsection
