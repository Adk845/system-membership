@extends('adminlte::page')

@section('title', 'Broadcast Email')

@section('content')
<h1 class="mb-4">Broadcast Email</h1>

{{-- Filter Form --}}
<form method="GET" action="{{ route('broadcast.email', $event->id) }}" class="mb-4">
    <input type="hidden" name="event_id" value="{{ $event->id }}">
    <div class="form-row">
        <div class="col-md-4">
            <select name="peminatan_id" class="form-control">
                <option value="">-- Semua Peminatan --</option>
                @foreach ($peminatans as $peminatan)
                    <option value="{{ $peminatan->id }}" {{ request('peminatan_id') == $peminatan->id ? 'selected' : '' }}>
                        {{ $peminatan->peminatan }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Cari nama atau email..." value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('emails.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </div>
</form>

{{-- Table List Anggota --}}
<form method="POST" action="{{ route('broadcast.send') }}">
    @csrf
    <div class="card shadow">       
        <input type="hidden" name="event_id" value="{{ $event->id }}">
          
    <div class="card shadow">
    <div class="card-header bg-secondary text-white d-flex align-items-center">
        <strong>Daftar Anggota</strong>
        <button id="kirim_notifikasi_top" class="btn btn-success btn-md ml-auto" type="submit">
            Kirim Email
        </button>
    </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-hover m-0">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th width="9%"><input type="checkbox" id="checkAll">Check All</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Peminatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($anggota as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            {{-- <td><input type="checkbox" name="anggota_id[]" value="{{ $item->id }}"></td> --}}
                            <td><input type="checkbox" name="emails[]" value="{{ $item->email }}"></td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                @foreach ($item->peminatan as $p)
                                    <span class="badge badge-info">{{ $p->peminatan }}</span>
                                @endforeach
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data anggota.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- <button id="kirim_notifikasi" class="btn btn-success">Kirim Email</button> --}}
    </div>
</form>

<!-- Modal Loading -->
    <div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-sm text-center p-5">
                <div class="spinner-border text-primary mb-3" role="status"></div>
                <h5 class="mb-0">Mengirim notifikasi email...</h5>
            </div>
        </div>
    </div>    
@endsection

@push('js')
<script>
    document.getElementById('checkAll').addEventListener('click', function () {
        let checkboxes = document.querySelectorAll('input[name="emails[]"]');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });

    $('#kirim_notifikasi_top').on('click', function () {
        $('#loadingModal').modal('show'); // Tampilkan modal loading saat tombol diklik
    });
</script>
@endpush
