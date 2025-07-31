@extends('adminlte::page')

@section('title', 'Broadcast Email')

@section('content')
<h1 class="mb-4">Broadcast Email</h1>

{{-- Filter Form --}}
<form method="GET" action="{{ route('emails.index') }}" class="mb-4">
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
<form method="POST" action="{{ route('emails.send') }}">
    @csrf
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <strong>Daftar Anggota</strong>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-hover m-0">
                <thead>
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
                            <td><input type="checkbox" name="anggota_id[]" value="{{ $item->id }}"></td>
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
        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('member.delete', $item->user->id) }}" onclick=" return confirm('Apakah Anda Yakin Mau Menghapus User Ini ? ')">Delete</a>
            <a class="dropdown-item" href="{{ route('member.edit', $item->user->id) }}">Edit</a>                                                                  
        </div>
    </div>
</form>
@endsection

@push('js')
<script>
    document.getElementById('checkAll').addEventListener('click', function () {
        let checkboxes = document.querySelectorAll('input[name="anggota_id[]"]');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });
</script>
@endpush
