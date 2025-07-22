@extends('adminlte::page')

@section('title', 'Create Member')

@section('content')
<div class="container">
    <h2>Create Member</h2>
    <form action="{{ route('member.create') }}" method="POST">
        @csrf
        @method('POST')
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Username</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="form-group col-md-6">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="form-group col-md-6">
                <label>No. Telepon</label>
                <input type="text" name="nomor" class="form-control" value="{{ old('nomor') }}" required>
            </div>
            <div class="form-group col-md-6">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
            </div>
            <div class="form-group col-md-6">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_anggota" class="form-control" value="{{ old('nama_anggota') }}" required>
            </div>
            <div class="form-group col-md-6">
                <label>Domisili</label>
                <select name="domisili" id="domisili-select" class="form-control" required>
                    <option disabled selected>Pilih Domisili</option>
                    @foreach($domisili as $item)
                        <option value="{{ $item }}" {{ old('domisili') == $item ? 'selected' : '' }}>{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>Peminatan</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="nonton" id="nonton" {{ old('nonton') ? 'checked' : '' }}>
                <label class="form-check-label">Nonton</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="seminar" {{ old('seminar') ? 'checked' : '' }}>
                <label class="form-check-label">Seminar</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="seminar_berbayar" {{ old('seminar_berbayar') ? 'checked' : '' }}>
                <label class="form-check-label">Seminar Berbayar</label>
            </div>
        </div>

        <div class="container" id="genre_bioskop" >
            <div class="row">
                <div class="col-sm col-2" id="bioskop-container" style="display:none">
                    <label for="bioskop">Bioskop</label>
                    <select id="bioskop-select" class="form-control">
                        <option value="" disabled selected>Pilih bioskop</option>
                    </select>
                    <div id="bioskop-tags" class="flex flex-wrap gap-2 mt-2"></div>
                    <input type="hidden" name="bioskop" id="bioskop-hidden">
                </div>

                <div class="ms-5 col-sm col-2" id="genre-container" style="display:none">
                    <label for="genre">Genre Favorit</label>
                    <select id="genre-select" class="form-control">
                        <option value="" disabled selected>Pilih genre</option>
                        <option value="Action">Action</option>
                        <option value="Drama">Drama</option>
                        <option value="Comedy">Comedy</option>
                        <option value="Thriller">Thriller</option>
                        <option value="Horror">Horror</option>
                    </select>
                    <div id="genre-tags" class="flex flex-wrap gap-2 mt-2"></div>
                    <input type="hidden" name="genre" id="genre-hidden">
                </div>
            </div>
        </div>
        <hr class="my-4">
            <div class="row g-4 mb-3">
                <div class="col-md-6">
                    <label for="password" class="profile-form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" autocomplete="new-password" placeholder="">
                </div>
                <div class="col-md-6">
                    <label for="password_confirmation" class="profile-form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password" placeholder="Ulangi password">
                </div>
            </div>

        <button type="submit" class="btn btn-primary mt-5">Simpan</button>
    </form>
</div>
@endsection

@push('js')
<script>
$(document).ready(function () {
    let selectedGenres = [];
    let selectedBioskop = [];

    togglePeminatan();

    $('#nonton').on('change', togglePeminatan);

    function togglePeminatan() {
        if ($('#nonton').is(':checked')) {
            $('#bioskop-container').show();
            $('#genre-container').show();
        } else {
            $('#bioskop-container').hide();
            $('#genre-container').hide();
        }
    }

    $('#genre-select').on('change', function () {
        const val = $(this).val();
        const text = $(this).find('option:selected').text();
        if (val && !selectedGenres.includes(val)) {
            selectedGenres.push(val);
            $('#genre-tags').append(`
                <span class="badge badge-pill badge-secondary d-inline-flex align-items-center">
                    ${text}
                    <button type="button" class="btn p-0 ml-2 text-white border-0 bg-transparent" data-val="${val}">&times;</button>
                </span>
            `);
            updateGenreInput();
        }
        $(this).val('');
    });

    $('#genre-tags').on('click', 'button', function () {
        const val = $(this).data('val');
        selectedGenres = selectedGenres.filter(v => v != val);
        $(this).parent().remove();
        updateGenreInput();
    });

    function updateGenreInput() {
        $('#genre-hidden').val(selectedGenres.join(','));
    }

    $('#bioskop-select').on('change', function () {
        const val = $(this).val();
        const text = $(this).find('option:selected').text();
        if (val && !selectedBioskop.includes(val) && selectedBioskop.length < 3) {
            selectedBioskop.push(val);
            $('#bioskop-tags').append(`
                <span class="badge badge-pill badge-secondary d-inline-flex align-items-center">
                    ${text}
                    <button type="button" class="btn p-0 ml-2 text-white border-0 bg-transparent" data-val="${val}">&times;</button>
                </span>
            `);
            updateBioskopInput();
        }
        $(this).val('');
    });

    $('#bioskop-tags').on('click', 'button', function () {
        const val = $(this).data('val');
        selectedBioskop = selectedBioskop.filter(v => v != val);
        $(this).parent().remove();
        updateBioskopInput();
    });

    function updateBioskopInput() {
        $('#bioskop-hidden').val(selectedBioskop.join(','));
    }

    $('#domisili-select').on('change', function() {
        const wilayah = $(this).val();
        $.get(`/api/bioskop/search/${wilayah}`, function(data) {
            $('#bioskop-select').empty();
            if (data.length === 0) {
                $('#bioskop-select').append(`<option>Tidak ada Bioskop</option>`);
            } else {
                $('#bioskop-select').append(`<option value="" disabled selected>Pilih bioskop</option>`);
                data.forEach(function(item) {
                    $('#bioskop-select').append(`<option value="${item.id}">${item.bioskop}</option>`);
                });
            }
        });
    });
});
</script>
@endpush
