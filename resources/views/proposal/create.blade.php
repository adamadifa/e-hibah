@extends('layouts.app')
@section('titlepage', 'Buat Proposal')

@section('content')
@section('navigasi')
    <span class="text-muted fw-light">Proposal</span> / Buat Proposal
@endsection
<form action="#" id="formcreateProposal">
    <div class="row">
        <div class="col-lg-6 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-body">

                    <x-input-with-icon-label icon="ti ti-barcode" label="Auto" name="no_registrasi" readonly="true" />
                    <x-input-with-icon-label icon="ti ti-calendar" label="Tanggal Proposal" name="tanggal_proposal" />
                    <div class="divider text-start">
                        <div class="divider-text fw-bold">
                            <i class="ti ti-user me-1"></i>
                            Data Penerima
                        </div>
                    </div>
                    <x-input-with-icon-label icon="ti ti-barcode" label="Kode Penerima Hibah" name="kode_penerimahibah"
                        readonly="true" value="{{ $penerimahibah->kode_penerimahibah }}" />
                    <x-input-with-icon-label icon="ti ti-user" label="Nama" name="nama"
                        value="{{ $penerimahibah->nama }}" />
                    <x-input-with-icon-label icon="ti ti-map-pin" label="Alamat" name="alamat"
                        value="{{ $penerimahibah->alamat }}" />
                    <x-input-with-icon-label icon="ti ti-barcode" label="No. Izin" name="no_izin"
                        value="{{ $penerimahibah->no_izin }}" />
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <x-input-with-icon-label icon="ti ti-phone" label="No. Telepon" name="no_telepon"
                                value="{{ $penerimahibah->no_telepon }}" />
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <x-input-with-icon-label icon="ti ti-mail" label="Email" name="email"
                                value="{{ $penerimahibah->email }}" />
                        </div>
                    </div>
                    <x-input-with-icon-label icon="ti ti-user" label="Penanggung Jawab" name="penanggung_jawab"
                        value="{{ $penerimahibah->penanggung_jawab }}" />
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <x-input-with-icon-label icon="ti ti-phone" label="No. Telepon Penanggung Jawab"
                                name="no_telepon_penanggung_jawab"
                                value="{{ $penerimahibah->no_telepon_penanggung_jawab }}" />
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <x-input-with-icon-label icon="ti ti-mail" label="Email Penanggung Jawab"
                                name="email_penanggung_jawab" value="{{ $penerimahibah->email_penanggung_jawab }}" />
                        </div>
                    </div>
                    <x-input-file-with-label name="file_ktp" label="File KTP" />
                    <img src="{{ getdocPenerimahibah($penerimahibah->file_ktp) }}" alt="user-avatar"
                        class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">
                    <div class="row">
                        <div class="col-lg-5 col-sm-12">
                            <x-input-with-icon-label icon="ti ti-building" label="Nama Bank" name="nama_bank"
                                value="{{ $penerimahibah->nama_bank }}" />
                        </div>
                        <div class="col-lg-7 col-sm-12">
                            <x-input-with-icon-label icon="ti ti-credit-card" label="No. Rekening" name="no_rekening"
                                value="{{ $penerimahibah->no_rekening }}" />
                        </div>
                    </div>

                    <x-input-with-icon-label icon="ti ti-user" label="Nama Pemilik Rekening"
                        name="nama_pemilik_rekening" value="{{ $penerimahibah->nama_pemilik_rekening }}" />
                    <x-input-file-with-label name="file_rekening" label="File Rekening" />
                    <img src="{{ getdocPenerimahibah($penerimahibah->file_rekening) }}" alt="user-avatar"
                        class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar">

                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-body">
                    <div class="divider text-start">
                        <div class="divider-text fw-bold">
                            <i class="ti ti-file-text me-1"></i>
                            Data Pengajuan
                        </div>
                    </div>
                    <x-input-with-icon-label icon="ti ti-barcode" label="No. Surat" name="no_surat" />
                    <x-input-with-icon-label icon="ti ti-calendar" label="Tanggal. Surat" name="tanggal_surat" />
                    <x-select name="id_jenis_pengajuan_dana" label="Jenis Pengajuan Dana" :data="$jenis_pengajuan_dana"
                        key="id" textShow="jenis_pengajuan_dana" />
                    <x-select name="kode_anggaran" label="Tahun Anggaran" :data="$tahun_anggaran" key="kode_anggaran"
                        textShow="tahun" />
                    <x-input-with-icon-label icon="ti ti-file-text" label="Jumlah Dana Yang Di Ajukan"
                        name="jumlah_dana" align="right" />
                    <x-input-with-icon-label icon="ti ti-file-text" label="Judul Proposal" name="judul_proposal" />
                    <x-input-file-with-label name="lampiran_surat" label="Lampiran Surat" />
                    <div class="form-group">
                        <button class="btn btn-primary w-100" type="submit">
                            <i class="ti ti-send me-1"></i>
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

</form>
@endsection
@push('myscript')
<script src="{{ asset('assets/js/pages/proposal/create.js') }}"></script>
@endpush
