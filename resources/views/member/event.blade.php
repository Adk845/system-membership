{{-- filepath: resources\views\member\event.blade.php --}}
@extends('adminlte::page')

@section('title', 'Daftar Event')

@section('content_header')
    <h1 class="mb-4">Daftar Event</h1>
@endsection

@section('content')
<div class="container">
    <div class="row">
        @forelse($events as $event)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    @if($event->gambar)
                        {{-- <img src="{{ asset('storage/'.$event->gambar) }}" class="card-img-top" alt="{{ $event->nama }}" style="height:180px;object-fit:cover;"> --}}
                        <img src="{{ asset('images') }}/contoh_flyer.jpg" class="card-img-top" alt="{{ $event->nama }}" style="height:180px;object-fit:cover;">
                    @else
                        <img src="{{ asset('images') }}/contoh_flyer.jpg" class="card-img-top" alt="event">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-primary">{{ $event->nama }}</h5>
                        <p class="card-text text-muted mb-1"><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }} | <i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($event->waktu)->format('H:i') }}</p>
                        <p class="card-text mb-2"><i class="fas fa-map-marker-alt"></i> {{ $event->Lokasi }}</p>
                        <p class="card-text" style="min-height:60px;">{{ Str::limit($event->deskripsi, 80) }}</p>
                        <div class="mt-auto">
                            <span class="badge bg-info text-dark mb-2">{{ $event->jenis_peminatan }}</span>
                            <a href="{{ $event->link ?? '#' }}" target="_blank" class="btn btn-outline-primary btn-sm w-100">Detail Event</a>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 small text-muted">
                        <i class="fas fa-user"></i> {{ $event->narasumber }}
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    Belum ada event tersedia.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection