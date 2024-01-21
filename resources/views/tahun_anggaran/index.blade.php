@extends('layouts.app')
@section('titlepage', 'Anggaran')

@section('content')
@section('navigasi')
    <span>Anggaran</span>
@endsection
<div class="row">
    <div class="col-lg-6 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                <a href="#" class="btn btn-primary" id="btncreateAnggaran"><i class="fa fa-plus me-2"></i> Tambah
                    Anggaran</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('tahunanggaran.index') }}">
                            <div class="row">
                                <div class="col-lg-10 col-sm-12 col-md-12">
                                    <x-input-with-icon label="Cari Nama Anggaran" value="{{ Request('nama') }}"
                                        name="nama" icon="ti ti-search" />
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
                                        <th>No.</th>
                                        <th>Kode</th>
                                        <th>Tahun</th>
                                        <th class="text-center">Jumlah Anggaran</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tahun_anggaran as $d)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $d->kode_anggaran }}</td>
                                            <td>{{ $d->tahun }}</td>
                                            <td class="text-end">{{ rupiah($d->jumlah_anggaran) }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div>
                                                        <a href="#" class="me-2 editAnggaran"
                                                            kode_anggaran="{{ Crypt::encrypt($d->kode_anggaran) }}">
                                                            <i class="ti ti-edit text-success"></i>
                                                        </a>
                                                    </div>

                                                    <div>
                                                        <form method="POST" name="deleteform" class="deleteform"
                                                            action="{{ route('tahunanggaran.delete', Crypt::encrypt($d->kode_anggaran)) }}">
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
                                </tbody>
                            </table>
                        </div>
                        <div style="float: right;">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-modal-form id="mdlcreateAnggaran" size="" show="loadcreateAnggaran" title="Tambah Anggaran" />
<x-modal-form id="mdleditAnggaran" size="" show="loadeditAnggaran" title="Edit Anggaran" />
@endsection
@push('myscript')
{{-- <script src="{{ asset('assets/js/pages/roles/create.js') }}"></script> --}}
<script>
    $(function() {
        $("#btncreateAnggaran").click(function(e) {
            $('#mdlcreateAnggaran').modal("show");
            $("#loadcreateAnggaran").load('/tahunanggaran/create');
        });

        $(".editAnggaran").click(function(e) {
            var kode_anggaran = $(this).attr("kode_anggaran");
            //alert(kode_anggaran);
            e.preventDefault();
            $('#mdleditAnggaran').modal("show");
            $("#loadeditAnggaran").load('/tahunanggaran/' + kode_anggaran + '/edit');
        });
    });
</script>
@endpush
