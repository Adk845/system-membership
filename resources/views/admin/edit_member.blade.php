@extends('adminlte::page')

@section('title', 'Create New Member')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header text-center font-weight-bold">Register</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('member.create') }}">
                        @csrf

                        <div class="form-row">
                            <!-- Name -->
                            <div class="form-group col-md-6">
                                <label for="name">Username</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $anggota->nama) }}" required autofocus>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- <!-- Password -->
                            <div class="form-group col-md-6">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group col-md-6">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                            </div> --}}

                            <!-- Nama Anggota -->
                            <div class="form-group col-md-6">
                                <label for="nama_anggota">Nama Lengkap</label>
                                <input type="text" name="nama_anggota" id="nama_anggota" class="form-control" value="{{ old('nama_anggota', $anggota->nama) }}" required>
                                @error('nama_anggota')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <!-- Domisili -->
                            <div class="form-group col-md-6">
                                <label for="domisili-select">Domisili</label>
                                <select name="domisili" id="domisili-select" class="form-control">
                                    <option value="">Pilih Kota</option>
                                    @foreach ($domisili as $id => $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <h5>Peminatan</h5>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="nonton" name="nonton">
                                <label class="form-check-label" for="nonton">Nonton</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="seminar">
                                <label class="form-check-label">Seminar</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="seminar_berbayar">
                                <label class="form-check-label">Seminar Berbayar</label>
                            </div>
                        </div>

                        <div id="bioskop-container" class="form-group" style="display:none;">
                            <label for="bioskop">Pilih Bioskop</label>
                            <select id="bioskop" name="bioskop[]" class="form-control" multiple></select>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    new TomSelect("#domisili-select", {
        create: false,
        sortField: { field: "text", direction: "asc" }
    });

    new TomSelect("#bioskop", {
        maxItems: 3,
        create: false,
        sortField: { field: "text", direction: "asc" },
        placeholder: 'max 3'
    });

    $(document).ready(function () {
        $('#nonton').on('change', function () {
            $('#bioskop-container').toggle($(this).is(':checked'));
        });

        $('#domisili-select').on('change', function () {
            let wilayah = $(this).val();
            let bioskopSelect = $('#bioskop')[0].tomselect;
            bioskopSelect.clearOptions();
            bioskopSelect.addOption({ value: '', text: 'Loading...' });
            bioskopSelect.refreshOptions();

            $.get(`/api/bioskop/search/${wilayah}`, function(data) {
                bioskopSelect.clearOptions();
                if (data.length === 0) {
                    bioskopSelect.addOption({ value: '', text: 'Tidak ada bioskop' });
                } else {
                    data.forEach(function(item) {
                        bioskopSelect.addOption({ value: item.id, text: item.bioskop });
                    });
                }
                bioskopSelect.refreshOptions();
            });
        });
    });
</script>
@endpush

@endsection
