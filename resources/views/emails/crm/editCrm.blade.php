@extends('adminlte::page')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Create New Contact</h4>
        </div>
        <form action="{{ route('crm.update') }}" method="POST">
            @csrf
            <div class="card-body">
                    <input type="hidden" name="id" value="{{ $contact->id }}">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input class="form-control" type="text" name="name" value="{{ old('name', $contact->name) }}">
                    </div>
                    <div class="form-group">
                        <label for="company">Company</label>
                        <input class="form-control" type="text" name="company" value="{{ old('company', $contact->company) }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="text" name="email" value="{{ old('email', $contact->email) }}">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input class="form-control" type="text" name="address" value="{{ old('address', $contact->address) }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input class="form-control" type="text" name="phone" value="{{ old('phone', $contact->phone) }}">
                    </div>
                    <div class="form-group">
                        <label for="website">Website</label>
                        <input class="form-control" type="text" name="website" value="{{ old('website', $contact->website) }}">
                    </div>
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea class="form-control" name="notes" id="" cols="30" rows="5">{{ old('notes', $contact->notes) }}</textarea>
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