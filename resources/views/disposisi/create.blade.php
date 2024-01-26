<form action="{{ route('disposisi.store') }}" id="formcreateDisposisi" method="POST">
    @csrf

    <x-select name="id_penerima" label="Penerima" :data="$users" key="id" textShow="name" />
    <div class="form-group mb-3">
        <select name="id_jenis_penanganan" id="id_jenis_penanganan" class="form-select">
            <option value="">Jenis Penanganan</option>
            <option value="1">1. Tindak Lanjuti Sesuai Aturan </option>
            <option value="2">2. Teliti </option>
            <option value="3">3. Telaah Staff </option>
            <option value="4">4. Kita Bicarakan / Diskusikan </option>
            <option value="5">5. Pendapat / Saran </option>
            <option value="6">6. Lainnya </option>
        </select>
    </div>
    <div class="form-group mb-3">
        <textarea name="catatan" id="catatan" cols="30" rows="5" placeholder="Catatan (Optional)"
            class="form-control"></textarea>
    </div>
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
<script src="{{ asset('assets/js/pages/disposisi/create.js') }}"></script>
