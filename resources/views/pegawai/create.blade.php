<form action="{{ route('pegawai.store') }}" id="formcreatePegawai" method="POST">
    @csrf
    <x-input-with-icon-label icon="ti ti-barcode" label="Nomor Induk Pegawai" name="nip" />
    <x-input-with-icon-label icon="ti ti-user" label="Nama Pegawai" name="nama_pegawai" />
    <x-select name="kode_jabatan" label="Jabatan" :data="$jabatan" key="kode_jabatan" textShow="nama_jabatan" />
    <x-select name="kode_unit" label="Unit Organisasi" :data="$unit_organisasi" key="kode_unit" textShow="nama_unit" />
    <x-select name="kode_status_pns" label="Status PNS" :data="$status_pns" key="kode_status_pns" textShow="status"
        uppercase="true" />
    <div class="form-group">
        <button class="btn btn-primary w-100" type="submit">
            <ion-icon name="send-outline" class="me-1"></ion-icon>
            Submit
        </button>
    </div>
</form>

<script src="{{ asset('/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/pegawai/create.js') }}"></script>