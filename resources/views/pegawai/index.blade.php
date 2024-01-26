@extends('layouts.app')
@section('titlepage', 'Pegawai')

@section('content')
@section('navigasi')
    <span>Pegawai</span>
@endsection
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="card-header">
                <a href="#" class="btn btn-primary" id="btncreatePegawai"><i class="fa fa-plus me-2"></i> Tambah
                    Pegawai</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('pegawai.index') }}">
                            <div class="row">
                                <div class="col-lg-10 col-sm-12 col-md-12">
                                    <x-input-with-icon label="Search Nama Pegawai" value="{{ Request('nama_pegawai') }}"
                                        name="nama_pegawai" icon="ti ti-search" />
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
                                        <th>NIP.</th>
                                        <th>Nama Pegawai</th>
                                        <th>Jabatan</th>
                                        <th>Unit</th>
                                        <th>Organisasi</th>
                                        <th>Status</th>
                                        <th>Username</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pegawai as $d)
                                        <tr>
                                            <td>{{ $d->nip }}</td>
                                            <td>{{ $d->nama_pegawai }}</td>
                                            <td>{{ $d->nama_jabatan }}</td>
                                            <td>{{ $d->nama_unit }}</td>
                                            <td>{{ $d->nama_organisasi }}</td>
                                            <td>
                                                @if ($d->is_active == 1)
                                                    <span class="badge bg-success">Aktif</span>
                                                @elseif ($d->is_active == 2)
                                                    <span class="badge bg-danger">Hapus</span>
                                                @elseif ($d->is_active == 3)
                                                    <span class="badge bg-danger">Keluar</span>
                                                @elseif ($d->is_active == 3)
                                                    <span class="badge bg-warning">Pensiun</span>
                                                    <span class="badge bg-info">Mutasi</span>
                                                @endif
                                            </td>
                                            <td>{{ $d->username }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div>
                                                        <a href="#" class="me-2 editPegawai"
                                                            id="{{ Crypt::encrypt($d->nip) }}">
                                                            <i class="ti ti-edit text-success"></i>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        @if (!empty($d->id_user))
                                                            <a href="#" class="me-2 editAkun"
                                                                id="{{ Crypt::encrypt($d->nip) }}">
                                                                <i class="ti ti-user-star text-info"></i>
                                                            </a>
                                                        @else
                                                            <a href="#" class="me-2 createAkun"
                                                                id="{{ Crypt::encrypt($d->nip) }}">
                                                                <i class="ti ti-user-star text-info"></i>
                                                            </a>
                                                        @endif

                                                    </div>
                                                    <div>
                                                        <form method="POST" name="deleteform" class="deleteform"
                                                            action="{{ route('pegawai.delete', Crypt::encrypt($d->nip)) }}">
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
                            {{ $pegawai->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-modal-form id="mdlcreatePegawai" size="" show="loadcreatePegawai" title="Tambah Pegawai" />
<x-modal-form id="mdleditPegawai" size="" show="loadeditPegawai" title="Edit Pegawai" />
<x-modal-form id="mdlcreateAkun" size="" show="loadcreateAkun" title="Akun" />
<x-modal-form id="mdleditAkun" size="" show="loadeditAkun" title="Edit Akun" />

@endsection



@push('myscript')
{{-- <script src="{{ asset('assets/js/pages/roles/create.js') }}"></script> --}}
<script>
    $(function() {
        $("#btncreatePegawai").click(function(e) {
            $('#mdlcreatePegawai').modal("show");
            $("#loadcreatePegawai").load('/pegawai/create');
        });

        $(".editPegawai").click(function(e) {
            var id = $(this).attr("id");
            e.preventDefault();
            $('#mdleditPegawai').modal("show");
            $("#loadeditPegawai").load('/pegawai/' + id + '/edit');
        });

        $(".createAkun").click(function(e) {
            var id = $(this).attr("id");
            e.preventDefault();
            $('#mdlcreateAkun').modal("show");
            $("#loadcreateAkun").load('/pegawai/' + id + '/createakun');
        });

        $(".editAkun").click(function(e) {
            var id = $(this).attr("id");
            e.preventDefault();
            $('#mdleditAkun').modal("show");
            $("#loadeditAkun").load('/pegawai/' + id + '/editakun');
        });
    });
</script>
@endpush
