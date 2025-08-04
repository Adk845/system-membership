@extends('adminlte::page')

@section('title', 'List Penerima')

@section('content')
@php
    $currentSort = request('sort', 'nama');
    $currentDirection = request('direction', 'asc');
@endphp

<h1 class="mb-4">Pilih Email Tujuan</h1>

{{-- Filter Form --}}
<form method="GET" action="{{ route('emails.penerima', $email_id) }}" class="mb-4">    
    <div class="form-row">
        <div class="col-md-3">
            <select name="peminatan_id" class="form-control">
                <option value="">-- Semua Peminatan --</option>
                @foreach ($peminatans as $peminatan)
                    <option value="{{ $peminatan->id }}" {{ request('peminatan_id') == $peminatan->id ? 'selected' : '' }}>
                        {{ $peminatan->peminatan }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="role" class="form-control">
                <option value="">-- Semua Role --</option>
                <option value="member" {{ request('role') == 'member' ? 'selected' : '' }}>Member</option>
                <option value="koordinator" {{ request('role') == 'koordinator' ? 'selected' : '' }}>Koordinator</option>                
                <option value="produser" {{ request('role') == 'produser' ? 'selected' : '' }}>Produser</option>
                <!-- Tambah sesuai role lainnya -->
            </select>
        </div>
        <div class="col-md-3">
            <input type="text" name="search" class="form-control" placeholder="Cari nama/email..." value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('emails.penerima', $email_id) }}" class="btn btn-secondary">Reset</a>
        </div>
    </div>
</form>


{{-- Table List Anggota --}}
<form method="POST" action="{{ route('emails.send') }}">
    @csrf
    <input type="hidden" name="email_id", value="{{ $email_id }}">                       
    <div class="card shadow">
        <div class="card-header bg-secondary text-white d-flex align-items-center">
            <strong>Daftar Anggota</strong>
           <div class="d-flex ml-auto">
            <a class="btn btn-warning btn-md mx-3" href="{{ route('emails.edit', $email_id) }}"><i class="fas fa-arrow-left"></i> Kembali</a>
             <button id="kirim_notifikasi_top" class="btn btn-success btn-md " type="submit">
                Kirim Email
            </button>
           </div>
        </div>
            <div class="card-body p-0">
                <table class="table table-bordered table-hover m-0">
                   <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th width="9%"><input type="checkbox" id="checkAll"> All</th>
                            
                            <!-- Nama -->
                            <th>
                                <span>Nama</span>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'nama', 'direction' => 'asc']) }}"
                                style="text-decoration: none; {{ $currentSort == 'nama' && $currentDirection == 'asc' ? 'font-weight: bold;' : '' }}">
                                    &#9650;
                                </a>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'nama', 'direction' => 'desc']) }}"
                                style="text-decoration: none; {{ $currentSort == 'nama' && $currentDirection == 'desc' ? 'font-weight: bold;' : '' }}">
                                    &#9660;
                                </a>
                            </th>

                            <!-- Email -->
                            <th>
                                <span>Email</span>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'email', 'direction' => 'asc']) }}"
                                style="text-decoration: none; {{ $currentSort == 'email' && $currentDirection == 'asc' ? 'font-weight: bold;' : '' }}">
                                    &#9650;
                                </a>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'email', 'direction' => 'desc']) }}"
                                style="text-decoration: none; {{ $currentSort == 'email' && $currentDirection == 'desc' ? 'font-weight: bold;' : '' }}">
                                    &#9660;
                                </a>
                            </th>

                            <!-- Peminatan -->
                            <th>Peminatan</th>

                            <!-- Level -->
                            <th>
                                <span>Level</span>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'level', 'direction' => 'asc']) }}"
                                style="text-decoration: none; {{ $currentSort == 'level' && $currentDirection == 'asc' ? 'font-weight: bold;' : '' }}">
                                    &#9650;
                                </a>
                                <a href="{{ request()->fullUrlWithQuery(['sort' => 'level', 'direction' => 'desc']) }}"
                                style="text-decoration: none; {{ $currentSort == 'level' && $currentDirection == 'desc' ? 'font-weight: bold;' : '' }}">
                                    &#9660;
                                </a>
                            </th>
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
                                    <div class="">
                                        @foreach ($item->peminatan as $p)
                                            <span class="badge badge-info">{{ $p->peminatan }}</span>
                                        @endforeach
                                    </div>                                    
                                </td>
                                <td>{{ $item->level }}</td>
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
