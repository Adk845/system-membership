@extends('adminlte::page')

@section('title', 'Event List')

@section('content_header')
    <h1 class="mb-4">Event List</h1>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <!-- Header + Add Button -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="m-3">
            <form method="GET" class="form-inline mb-3">
                <input type="text" name="search" class="form-control mr-2" placeholder="Cari nama event" value="{{ request('search') }}">
                
                <select name="per_page" class="form-control mr-2" onchange="this.form.submit()">
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>All</option>
                </select>

                <button type="submit" class="btn btn-primary">Terapkan</button>
            </form>
            <a class="btn btn-primary" href="{{ route('member.create') }}">Crete new Member</a>
        </div>
        <a href="{{ route('events.create') }}" class="btn btn-success shadow-sm">
            <i class="fas fa-plus-circle mr-1"></i> Add New Event
        </a>
    </div>

    <!-- Event Table -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover table-striped mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Poster</th>
                        <th scope="col">Event Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Category</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $index => $event)
                        <tr>
                            <td style="cursor:pointer;" onclick="window.location='{{ route('events.show', $event->id) }}'">{{ $index + 1 }}</td>
                            <td style="cursor:pointer;" onclick="window.location='{{ route('events.show', $event->id) }}'">
                                <img src="{{ asset('storage/' . $event->gambar) }}" alt="poster" class="img-thumbnail" style="height: 60px; width: 60px; object-fit: cover;">
                            </td>
                            <td style="cursor:pointer;" onclick="window.location='{{ route('events.show', $event->id) }}'">{{ $event->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }}</td>
                            <td>{{ $event->waktu}}</td>
                            {{-- <td>{{ \Carbon\Carbon::parse($event->waktu)->format('H:i') }}</td> --}}
                            <td><span class="badge badge-info">{{ ucwords($event->jenis_peminatan) }}</span></td>
                            <td>
                               <div class="dropdown">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                        Option
                                    </a>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('events.delete', $event->id) }}" onclick=" return confirm('Apakah Anda Yakin Mau Menghapus Event Ini ? ')">Delete</a>
                                        <a class="dropdown-item" href="{{ route('events.edit', $event->id) }}">Edit</a>                                                                          
                                    </div>
                                </div>   
                            </td>
                        </tr>
                    @endforeach

                    @if ($events->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No events have been created.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-3 pb-3 d-flex justify-content-end">
            {{ $events->links() }}
        </div>
    </div>
@endsection
