@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Create New Contact</h4>
        </div>
        <form action="{{ route('crm.store') }}" method="POST">
            @csrf
            <div class="card-body">
                
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input class="form-control" type="text" name="name">
                    </div>
                    <div class="form-group">
                        <label for="company">Company</label>
                        <input class="form-control" type="text" name="company">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="text" name="email">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input class="form-control" type="text" name="address">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input class="form-control" type="text" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="website">Website</label>
                        <input class="form-control" type="text" name="website">
                    </div>
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea class="form-control" name="notes" id="" cols="30" rows="5"></textarea>
                    </div>
                
            </div>
            <div class="card-footer">
                <div>
                    <button class="btn btn-primary" type="submit"><i class="fas fa-check"></i> Save</button>
                    <a class="btn btn-secondary" href="{{ route('crm.index') }}"><i class="fas fa-times"></i> Cancel</a>
                </div>
            </div>

        </form>
    </div>
@endsection

@push('js')
    
@endpush