@extends('adminlte::page')

@section('title', 'Broadcast Email')

@section('content')
<h1 class="mb-4">Broadcast Email</h1>

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
{{-- Filter Form --}}


<div class="row">
    <div class="card shadow-lg border-0 rounded-lg col p-0 col mx-2" >
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <strong>Jumlah Email yang Terkirim Bulan ini </strong>                
        </div>
        <div class="card-body">
            <p style="font-size: 30px">{{  \Carbon\Carbon::now()->translatedFormat('F') }}</p>
            <div class="d-flex align-items-baseline">                
                <p style="font-size: 50px">0</p>
                <p style="font-weight: bolder">Email</p>
            </div>
            <a href="{{ route('emails.create') }}" class="btn btn-outline-primary">Create Email</a>
            
        </div>
    </div>
    <div class="card shadow-lg border-0 rounded-lg col p-0 col mx-2">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <strong>Jumlah Email Yang Terkirim Hari ini</strong>                
        </div>
        <div class="card-body">
            <p style="font-size: 30px">{{  \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
            <div class="d-flex align-items-baseline">
                <p style="font-size: 50px">0</p>
                <p style="font-weight: bolder">Email</p>
            </div>
        </div>
    </div>
</div>
<div class="card shadow-lg border-0 rounded-lg col p-0">
    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <strong>Riwayat Email</strong>                
            </div>
    <div class="card-body">
        <div>
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 50px">No</th>
                        <th>Tanggal</th>
                        <th>Subject</th>
                        <th>Status</th>                        
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>                    
                    @foreach ($emails as $index => $email)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $email->created_at->format('d M Y H:i') }}</td>
                            <td>{{ $email->subject }}</td>
                            <td>{{ $email->status }}</td>                                                        
                            <td>
                                <div class="dropdown dropleft">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                        Option
                                    </a>

                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('emails.delete', $email->id) }}" onclick=" return confirm('Apakah Anda Yakin Mau Menghapus Event Ini ? ')">Delete</a>
                                        <a class="dropdown-item" href="{{ route('emails.edit', $email->id) }}">Edit</a>                                                                                                                  
                                    </div>
                                </div>   
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    document.getElementById('checkAll').addEventListener('click', function () {
        let checkboxes = document.querySelectorAll('input[name="anggota_id[]"]');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });
</script>
@endpush
