@extends('adminlte::page')

@section('title', $event->nama)

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="row no-gutters">
            <!-- Gambar -->
            @if(!empty($event->gambar) && $event->gambar != '')
                <div class="col-md-5">
                    <img src="{{ asset('storage/' . $event->gambar) }}" class="card-img rounded-left" alt="{{ $event->nama }}" style="object-fit: cover;">
                </div>
            @else
                <div class="col-md-5">
                    <img src="{{ asset('images/no_image.png') }}" class="card-img h-100 rounded-left" alt="Default Event" style="object-fit: cover;">
                </div>
            @endif

            <!-- Konten -->
            <div class="col-md-7">
                <div class="card-body">
                    <div class="">
                        <h5 class="font-weight-bold text-primary">{{ $event->nama }}</h5>                        
                    </div>
                    <div>
                        <p class="text-muted mb-2"><i class="fas fa-user-tie"></i> Oleh: <strong>{{ $event->createdBy }}</strong></p>
                        <p class="text-muted mb-2"><i class="fas fa-map-marker-alt"></i> Lokasi: <strong>{{ $event->Lokasi }}</strong></p>
                        <p class="text-muted mb-2"><i class="fas fa-calendar-alt"></i> Tanggal: <strong>{{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }}</strong></p>
                        <p class="text-muted mb-3"><i class="fas fa-clock"></i> Jam: <strong>{{ $event->waktu}}</strong></p>
                        {{-- <p class="text-muted mb-3"><i class="fas fa-clock"></i> Jam: <strong>{{ \Carbon\Carbon::parse($event->waktu)->format('H:i') }}</strong></p> --}}
                    </div>
                    

                    <hr>
                    
                    <p><strong>Deskripsi:</strong></p>
                    <p>{{ $event->deskripsi }}</p>

                    <p><strong>Narasumber:</strong> {{ $event->narasumber }}</p>
                    <p><strong>Jenis Peminatan:</strong> {{ ucfirst($event->jenis_peminatan) }}</p>
                    <p><strong>Wilayah Koordinator:</strong> {{ $event->wilayah_koordinator }}</p>

                    @if($event->link)
                        <a href="{{ $event->link }}" target="_blank" class="btn btn-outline-primary btn-block mt-3">
                            <i class="fas fa-external-link-alt"></i> Link Event
                        </a>
                    @endif

                    <div>
                        <form action="">
                            <input type="hidden" name="id_anggota" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="id_event" value="{{ $event->id }}">
                            
                            {{-- <button type="submit" class="btn btn-outline-primary btn-block mt-3">Daftar</button> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
