@extends('layouts.app')
@section('titlepage', 'Penerima Hibah')

@section('content')
@section('navigasi')
    <span>Penerima Hibah</span>
@endsection
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                <a href="#" class="btn btn-primary" id="btncreatePenerimahibah"><i class="fa fa-plus me-2"></i> Tambah
                    Penerima Hibah</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('penerimahibah.index') }}">
                            <div class="row">
                                <div class="col-lg-10 col-sm-12 col-md-12">
                                    <x-input-with-icon label="Cari Nama Penerima Hibah" value="{{ Request('nama') }}"
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
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>No. Telepon</th>
                                        <th>No. Izin</th>
                                        <th>Penanggung Jawab</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (empty($penerimahibah))
                                    @else
                                        @foreach ($penerimahibah as $d)
                                            <tr>
                                                <td>{{ $loop->iteration + $penerimahibah->firstItem() - 1 }}</td>
                                                <td>{{ $d->kode_penerimahibah }}</td>
                                                <td>{{ $d->nama }}</td>
                                                <td>{{ $d->alamat }}</td>
                                                <td>{{ $d->no_telepon }}</td>
                                                <td>{{ $d->no_izin }}</td>
                                                <td>{{ $d->penanggung_jawab }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div>
                                                            <a href="#" class="me-2 editPenerimahibah"
                                                                id="{{ Crypt::encrypt($d->kode_penerimahibah) }}">
                                                                <i class="ti ti-edit text-success"></i>
                                                            </a>
                                                        </div>
                                                        <div>
                                                            <a href="{{ route('penerimahibah.show', Crypt::encrypt($d->kode_penerimahibah)) }}"
                                                                class="me-2">
                                                                <i class="ti ti-file-text text-info"></i>
                                                            </a>
                                                        </div>
                                                        <div>
                                                            <form method="POST" name="deleteform" class="deleteform"
                                                                action="{{ route('penerimahibah.delete', Crypt::encrypt($d->kode_penerimahibah)) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a href="#" class="delete-confirm ml-1">
                                                                    <i class="ti ti-trash text-danger"></i>
                                                                </a>
                                                            </form>
                                                        </div>
                                                        <div>
                                                            <a href="{{ route('proposal.create', Crypt::encrypt($d->kode_penerimahibah)) }}"
                                                                class="btn btn-xs btn-primary ms-2">
                                                                <i class="ti ti-file-text me-2"></i>
                                                                Daftarkan Proposal
                                                            </a>
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
                            {{ $penerimahibah->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-modal-form id="mdlcreatePenerimahibah" size="" show="loadcreatePenerimahibah" title="Tambah Penerima Hibah" />
<x-modal-form id="mdleditPenerimahibah" size="" show="loadeditpenerimaHibah" title="Edit Penerima Hibah" />
@endsection
@push('myscript')
{{-- <script src="{{ asset('assets/js/pages/roles/create.js') }}"></script> --}}
<script>
    $(function() {
        $("#btncreatePenerimahibah").click(function(e) {
            $('#mdlcreatePenerimahibah').modal("show");
            $("#loadcreatePenerimahibah").load('/penerimahibah/create');
        });

        $(".editPenerimahibah").click(function(e) {
            var id = $(this).attr("id");
            e.preventDefault();
            $('#mdleditPenerimahibah').modal("show");
            $("#loadeditpenerimaHibah").load('/penerimahibah/' + id + '/edit');
        });
    });
</script>
@endpush
