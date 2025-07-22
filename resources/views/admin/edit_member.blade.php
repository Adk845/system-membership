@extends('adminlte::page')

@section('title', 'Edit Member')

@section('content_header')
    
@endsection

@section('content')
    <div class="container">
    <h2>Edit Member</h2>
    <form action="{{ route('member.update') }}" method="POST">
        @csrf
        @method('POST')

        <div class="form-row">
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div class="form-group col-md-6">
                <label>Username</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>
            <div class="form-group col-md-6">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>
            <div class="form-group col-md-6">
                <label>No. Telepon</label>
                <input type="text" name="nomor" class="form-control" value="{{ old('nomor', $anggota->nomor) }}" required>
            </div>
            <div class="form-group col-md-6">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $anggota->tanggal_lahir) }}" required>
            </div>
            <div class="form-group col-md-6">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_anggota" class="form-control" value="{{ old('nama_anggota', $anggota->nama) }}" required>
            </div>
            <div class="form-group col-md-6">
                <label>Domisili</label>
                <select name="domisili" id="domisili-select" class="form-control" required>
                    <option disabled selected>Pilih Domisili</option>
                    @foreach($domisili as $id => $item)
                        <option value="{{ $item }}" {{ old('domisili', $anggota->domisili) == $item ? 'selected' : '' }}>
                            {{ $item }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Peminatan --}}
        <div class="form-group">
            <label>Peminatan</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="nonton" id="nonton" {{ in_array(1, $peminatan) ? 'checked' : '' }}>
                <label class="form-check-label">Nonton</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="seminar" {{ in_array(3, $peminatan) ? 'checked' : '' }}>
                <label class="form-check-label">Seminar</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="seminar_berbayar" {{ in_array(2, $peminatan) ? 'checked' : '' }}>
                <label class="form-check-label">Seminar Berbayar</label>
            </div>
        </div>

        {{-- Genre Favorit dan Bioskop--}} 
        <div class="container"  id="genre_bioskop" data-anggota="{{ $anggota->id }}" data-get_bioskop="{{ route('get_bioskop', $anggota->id) }}" data-get_genre="{{ route('get_genre', $anggota->id) }}">
             <div class="row">

                <div class="col-sm col-2">
                    <div id="bioskop-container">
                        <label for="bioskop">Bioskop</label>
                        <select id="bioskop-select" name="bioskop" class="form-control">
                            <option value="" disabled selected>Pilih bioskop</option>
                        </select>
                        <div id="bioskop-tags" class="flex flex-wrap gap-2 mt-2">

                        </div>
                        <!-- Hidden input untuk submit array genre -->
                        <input type="hidden" name="bioskop" id="bioskop-hidden">
                    </div> 
                </div>

                <div class="ms-5 col-sm col-2" id="genre-container">
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
                    <!-- Hidden input untuk submit array genre -->
                    <input type="hidden" name="genre" id="genre-hidden">
                </div>

                
                
            </div>  
        </div>  
         

       

        <button type="submit" class="btn btn-primary mt-5">Update</button>
    </form>
</div>
@push('js')
<script>
$(document).ready(function () {
    const anggotaId = $('#genre_bioskop').data('anggota');
    const link_api_genre = $('#genre_bioskop').data('get_genre');
    const link_api_bioskop = $('#genre_bioskop').data('get_bioskop');

    let selectedGenres = [];
    let selectedBioskop = [];
    let selectedBioskop_name = [];

    // Load genre sebelumnya
    $.get(link_api_genre, function(data) {
        data.forEach(element => {
            selectedGenres.push(element);
            $('#genre-tags').append(`
                <span class="badge badge-pill badge-secondary d-inline-flex align-items-center">
                    ${element}
                    <button type="button" class="btn p-0 ml-2 text-white border-0 bg-transparent" data-val="${element}">&times;</button>
                </span>
            `);
        });
        updateHiddenInput1();
    });

    // Load bioskop sebelumnya
    $.get(link_api_bioskop, function(data){
        data.forEach(element => {
            selectedBioskop.push(`${element.id}`);
            selectedBioskop_name.push(element);
        });

        selectedBioskop_name.forEach(element => {
            $('#bioskop-tags').append(`
                <span class="badge badge-pill badge-secondary d-inline-flex align-items-center">
                    ${element.bioskop}
                    <button type="button" class="btn p-0 ml-2 text-white border-0 bg-transparent" data-val="${element.id}">&times;</button>
                </span>
            `);
        });

        updateHiddenInput2();
    });

    // Toggle tampilan awal peminatan
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

    // Tambah genre
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
            updateHiddenInput1();
        }

        $(this).val('');
    });

    $('#genre-tags').on('click', 'button', function () {
        const val = $(this).data('val');
        selectedGenres = selectedGenres.filter(v => v != val);
        $(this).parent().remove();
        updateHiddenInput1();
    });

    function updateHiddenInput1() {
        $('#genre-hidden').val(selectedGenres.join(','));
    }

    // Tambah bioskop
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
            updateHiddenInput2();
        }

        $(this).val('');
    });

    $('#bioskop-tags').on('click', 'button', function () {
        const val = $(this).data('val');
        selectedBioskop = selectedBioskop.filter(v => v != val);
        $(this).parent().remove();
        updateHiddenInput2();
    });

    function updateHiddenInput2() {
        $('#bioskop-hidden').val(selectedBioskop.join(','));
    }

    // Ganti domisili → load bioskop
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

@endsection
