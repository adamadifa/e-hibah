@extends('layouts.app')
@section('titlepage', 'Data Proposal')

@section('content')
@section('navigasi')
    <span>Proposal</span>
@endsection
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('proposal.index') }}">
                            <div class="row">
                                <div class="col-lg-2 col-sm-12 col-md-12">
                                    <x-input-with-icon label="Dari" value="{{ Request('dari') }}" name="dari"
                                        icon="ti ti-calendar" datepicker="flatpickr-date" />
                                </div>
                                <div class="col-lg-2 col-sm-12 col-md-12">
                                    <x-input-with-icon label="Sampai" value="{{ Request('sampai') }}" name="sampai"
                                        icon="ti ti-calendar" datepicker="flatpickr-date" />
                                </div>
                                <div class="col-lg-2 col-sm-12 col-md-12">
                                    <x-select name="kode_anggaran" label="Tahun Anggaran" :data="$tahun_anggaran"
                                        key="kode_anggaran" textShow="tahun" />
                                </div>
                                <div class="col-lg-4 col-sm-12 col-md-12">
                                    <x-input-with-icon label="Penerima Hibah" value="{{ Request('nama') }}"
                                        name="nama" icon="ti ti-user" />
                                </div>
                                <div class="col-lg-2 col-sm-12 col-md-12">
                                    <button class="btn btn-primary">Cari</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive mb-2">
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No. Register</th>
                                        <th>Tanggal</th>
                                        <th>Penerima Hibah</th>
                                        <th>Judul Proposal</th>
                                        <th>Jenis Proposal</th>
                                        <th>Tahun Anggaran</th>
                                        <th>Jumlah Ajuan</th>
                                        <th>Dok</th>
                                        <th>Status</th>
                                        <th>#</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if ($proposal->total() == 0)
                                        <tr>
                                            <th colspan="10" class="text-center">
                                                <i class="ti ti-search me-1"></i>Data Tidak Ditemukan
                                            </th>
                                        </tr>
                                    @else
                                        @foreach ($proposal as $d)
                                            <tr>
                                                <td>{{ $d->no_registrasi }}</td>
                                                <td>{{ date('d-m-Y', strtotime($d->tanggal_proposal)) }}</td>
                                                <td>{{ camelCase($d->nama) }}</td>
                                                <td>{{ camelCase($d->judul_proposal) }}</td>
                                                <td>
                                                    @if ($d->id_jenis_proposal == 1)
                                                        <span class="badge bg-info">Pengajuan</span>
                                                    @elseif ($d->id_jenis_proposal == 2)
                                                        <span class="badge bg-success">Pencairan</span>
                                                    @endif
                                                </td>
                                                <td>{{ $d->tahun }}</td>
                                                <td>{{ rupiah($d->jumlah_dana) }}</td>
                                                <td>
                                                    <a href="#">
                                                        <ion-icon name="document-outline" class="text-info"></ion-icon>
                                                    </a>
                                                </td>
                                                <td></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div>
                                                            <a href="#" class="me-2"
                                                                id="{{ Crypt::encrypt($d->no_registrasi) }}">
                                                                <i class="ti ti-edit text-success"></i>
                                                            </a>
                                                        </div>
                                                        <div>
                                                            <a href="{{ route('proposal.show', Crypt::encrypt($d->no_registrasi)) }}"
                                                                class="me-2">
                                                                <i class="ti ti-file-text text-info"></i>
                                                            </a>
                                                        </div>
                                                        <div>
                                                            <form method="POST" name="deleteform" class="deleteform"
                                                                action="{{ route('proposal.delete', Crypt::encrypt($d->no_registrasi)) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a href="#" class="delete-confirm ml-1">
                                                                    <i class="ti ti-trash text-danger"></i>
                                                                </a>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                        <div style="float: right;">
                            {{-- {{ $penerimahibah->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
