<form action="{{ route('tahunanggaran.update', Crypt::encrypt($tahun_anggaran->kode_anggaran)) }}" id="formcreateAnggaran"
    method="POST">
    @csrf
    @method('PUT')
    <x-input-with-icon icon="ti ti-file-text" label="Tahun" name="tahun" value="{{ $tahun_anggaran->tahun }}" />
    <x-input-with-icon icon="ti ti-file-text" label="Jumlah Anggaran" name="jumlah_anggaran" align="right"
        value="{{ $tahun_anggaran->jumlah_anggaran }}" />


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
<script src="{{ asset('assets/js/pages/tahunanggaran/create.js') }}"></script>
