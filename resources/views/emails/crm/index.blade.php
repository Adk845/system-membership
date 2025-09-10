@extends('adminlte::page')

@section('title', 'CRM Contacts')

@section('content')

<div class="card p-3">
    <div class="card-header">
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
        <div class="d-flex flex-row justify-content-between">
            <h4>CRM Contacts</h4>
            <div>                
                <a class="btn btn-secondary" href="{{ route('crm.write') }}"><i class="fas fa-envelope"></i> Write Email</a>
                <a class="btn btn-secondary" href="{{ route('crm.create') }}"><i style="font-size: 20px" class="fas fa-plus"></i> Add New Contact</a>
            </div>            
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-bordered table-hover m-0">
            <thead class="thead-dark">
                <tr>
                    <th>Index</th>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Notes</th>
                    <th>Phone</th>
                    <th>Website</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($contacts as $index => $item)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $item->name }}</td>                                
                        <td>{{ $item->company }}</td>                                
                        <td>{{ $item->email }}</td>                                
                        <td>{{ $item->address }}</td>                                
                        <td>{{ $item->notes }}</td>                                
                        <td>{{ $item->phone }}</td>                                
                        <td>{{ $item->website }}</td>
                        <td>
                            <div class="d-flex flex-row">
                                <a class="btn btn-warning mr-3" href="{{ route('crm.edit', $item->id) }}">Edit</a>
                                <a class="btn btn-danger" href="{{ route('crm.destroy', $item->id) }}">Delete</a>
                            </div>
                        </td>                               
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada Email</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


</div>

@endsection

@push('js')

@endpush
