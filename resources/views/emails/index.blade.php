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
                    <strong>Information</strong>                
                </div>
        <div class="card-body">
        <a href="{{ route('emails.create') }}" class="btn btn-outline-primary">Create Email</a>
        </div>
    </div>
    <div class="card shadow-lg border-0 rounded-lg col p-0 col mx-2">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <strong>Information</strong>                
                </div>
        <div class="card-body">
        <h1>information</h1>
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
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Waktu Terkirim</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>test</td>
                        <td>test</td>
                        <td>12:00</td>
                    </tr>
                    @foreach ($emails as $index => $email)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $email->subject }}</td>
                            <td>{{ $email->status }}</td>                            
                            <td>{{ $email->created_at->format('d M Y H:i') }}</td>
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
