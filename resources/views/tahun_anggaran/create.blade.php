<form action="{{ route('tahunanggaran.store') }}" id="formcreateAnggaran" method="POST">
    @csrf
    <x-input-with-icon icon="ti ti-file-text" label="Tahun" name="tahun" />
    <x-input-with-icon icon="ti ti-file-text" label="Jumlah Anggaran" name="jumlah_anggaran" align="right" />


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
<script src="{{ asset('assets/js/pages/tahunanggaran/create.js') }}"></script>
<script>
    $(function() {
        $("#jumlah_anggaran").maskMoney();
    });
</script>
