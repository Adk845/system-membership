@extends('adminlte::page')

@section('title', 'Edit Event')

@section('content_header')
    <h1 class="mb-4">Edit Event</h1>
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('events.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <input type="hidden" name="id" value="{{ $event->id }}">
                <div class="form-group">
                    <label for="nama">Nama Event</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $event->nama }}" required>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $event->deskripsi }}</textarea>
                </div>

                <div class="form-group">
                    <label for="narasumber">Narasumber</label>
                    <input type="text" class="form-control" id="narasumber" name="narasumber" value="{{ $event->narasumber }}">
                </div>

                <div class="form-group">
                    <label for="jenis_peminatan">Jenis Peminatan</label>
                    <select class="form-control" id="jenis_peminatan" name="jenis_peminatan" required>
                        <option value="" disabled>Pilih jenis peminatan</option>
                        <option value="nonton" {{ $event->jenis_peminatan == 'nonton' ? 'selected' : '' }}>Nonton</option>
                        <option value="seminar" {{ $event->jenis_peminatan == 'seminar' ? 'selected' : '' }}>Seminar</option>
                        <option value="seminar berbayar" {{ $event->jenis_peminatan == 'seminar berbayar' ? 'selected' : '' }}>Seminar Berbayar</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="Lokasi">Lokasi</label>
                    <input type="text" class="form-control" id="Lokasi" name="Lokasi" value="{{ $event->Lokasi }}">
                </div>

                <div class="form-group">
                    <label for="link">Link (jika online)</label>
                    <input type="text" class="form-control" id="link" name="link" value="{{ $event->link }}">
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $event->tanggal }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="waktu">Waktu</label>
                        <input type="text" class="form-control" id="waktu" name="waktu" value="{{ $event->waktu }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="wilayah_koordinator">Wilayah Koordinator</label>
                    <input type="text" class="form-control" id="wilayah_koordinator" name="wilayah_koordinator" value="{{ $event->wilayah_koordinator }}">
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar (poster/flyer)</label>
                    <input type="file" class="form-control-file" id="gambar" name="gambar" accept="image/*" onchange="previewImage(event)">
                    
                    <div id="preview-container" class="mt-3 d-none">
                        <p class="mb-2 font-weight-bold">Preview Gambar baru:</p>
                        <img id="preview" class="img-thumbnail rounded border" style="max-height: 250px; object-fit: cover;">
                    </div>

                    @if($event->gambar)
                        <div id="preview-container2" class="mt-3">
                            <p class="mb-2 font-weight-bold">Gambar Saat Ini:</p>
                            <img src="{{ asset('storage/' . $event->gambar) }}" class="img-thumbnail rounded border" style="max-height: 250px; object-fit: cover;">
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-save"></i> Update Event
                </button>
            </form>
        </div>
    </div>

     @push('js')
        <script>
            function previewImage(event) {
                const input = event.target;
                const preview = document.getElementById('preview');
                const container = document.getElementById('preview-container');
                const container2 = document.getElementById('preview-container2');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    container2.classList.add('d-none');
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        container.classList.remove('d-none');
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endpush

@endsection
