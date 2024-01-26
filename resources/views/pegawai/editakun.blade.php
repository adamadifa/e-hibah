<div class="row">
    <div class="col-12">
        <table class="table">
            <tr>
                <th>NIP</th>
                <td>{{ $pegawai->nip }}</td>
            </tr>
            <tr>
                <th>Nama Pegawai</th>
                <td>{{ $pegawai->nama_pegawai }}</td>
            </tr>
            <tr>
                <th>Jabatan</th>
                <td>{{ $pegawai->nama_jabatan }}</td>
            </tr>
            <tr>
                <th>Organisasi</th>
                <td>{{ $pegawai->nama_organisasi }}</td>
            </tr>
            <tr>
                <th>Unit</th>
                <td>{{ $pegawai->nama_unit }}</td>
            </tr>
        </table>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <form action="{{ route('users.update', Crypt::encrypt($user->id)) }}" id="formcreateUser" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" value="{{ $pegawai->nip }}" name="nip">
            <x-input-with-icon icon="ti ti-user" label="Nama User" name="name" value="{{ $user->name }}" />
            <x-input-with-icon icon="ti ti-user" label="Username" name="username" value="{{ $user->username }}" />
            <x-input-with-icon icon="ti ti-mail" label="Email" name="email" value="{{ $user->email }}" />
            <x-input-with-icon icon="ti ti-key" label="Password" name="password" type="password" />
            <x-select label="Role" name="role" :data="$roles" key="name" textShow="name" />
            <div class="form-group">
                <button class="btn btn-primary w-100" type="submit">
                    <ion-icon name="send-outline" class="me-1"></ion-icon>
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
<script src="{{ asset('/assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/users/edit.js') }}"></script>
