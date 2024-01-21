<form action="{{ route('penerimahibah.update', Crypt::encrypt($penerimahibah->kode_penerimahibah)) }}"
    id="formeditPenerimahibah" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <x-input-with-icon icon="ti ti-barcode" label="Auto" name="name" readonly="true"
        value="{{ $penerimahibah->kode_penerimahibah }}" />
    <x-input-with-icon-label icon="ti ti-user" label="Nama Penerima Hibah" name="nama"
        value="{{ $penerimahibah->nama }}" />
    <x-input-with-icon-label icon="ti ti-map" label="Alamat Penerima Hibah" name="alamat"
        value="{{ $penerimahibah->alamat }}" />
    <div class="row">
        <div class="col-6">
            <x-input-with-icon-label icon="ti ti-map-pin" label="Latitude" name="latitude"
                value="{{ $penerimahibah->latitude }}" />
        </div>
        <div class="col-6">
            <x-input-with-icon-label icon="ti ti-map-pin" label="Longitude" name="longitude"
                value="{{ $penerimahibah->longitude }}" />
        </div>
    </div>
    <x-input-with-icon-label icon="ti ti-barcode" label="No. Izin" name="no_izin"
        value="{{ $penerimahibah->no_izin }}" />
    <x-input-with-icon-label icon="ti ti-phone" label="No. Telepon" name="no_telepon"
        value="{{ $penerimahibah->no_telepon }}" />
    <x-input-with-icon-label icon="ti ti-mail" label="Email" name="email" value="{{ $penerimahibah->email }}" />
    <x-input-with-icon-label icon="ti ti-user" label="Penanggung Jawab" name="penanggung_jawab"
        value="{{ $penerimahibah->penanggung_jawab }}" />
    <x-input-with-icon-label icon="ti ti-phone" label="No. Telepon Penanngung Jawab" name="no_telepon_penanggung_jawab"
        value="{{ $penerimahibah->no_telepon_penanggung_jawab }}" />
    <x-input-with-icon-label icon="ti ti-mail" label="Email Penanggung Jawab" name="email_penanggung_jawab"
        value="{{ $penerimahibah->email_penanggung_jawab }}" />
    <x-input-file-with-label name="file_ktp" label="File KTP" />
    <x-input-with-icon-label icon="ti ti-building" label="Nama Bank" name="nama_bank"
        value="{{ $penerimahibah->nama_bank }}" />
    <x-input-with-icon-label icon="ti ti-credit-card" label="No. Rekening" name="no_rekening"
        value="{{ $penerimahibah->no_rekening }}" />
    <x-input-with-icon-label icon="ti ti-user" label="Nama Pemilik Rekening" name="nama_pemilik_rekening"
        value="{{ $penerimahibah->nama_pemilik_rekening }}" />
    <x-input-file-with-label name="file_rekening" label="File Rekening" />
    <div class="form-group">
        <button class="btn btn-primary w-100" type="submit">
            <ion-icon name="repeat-outline" class="me-1"></ion-icon>
            Submit
        </button>
    </div>
</form>

<script src="{{ asset('/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/penerimahibah/edit.js') }}"></script>
