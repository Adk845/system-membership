@extends('adminlte::page')

@section('title', 'Create Email')

@section('content')
@push('css')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <style>
         trix-editor {
        min-height: 300px;
    }
    </style>
@endpush
<h1>Write Email</h1>

<div class="card shadow-lg border-0 rounded-lg col p-0 mx-2">
    <div class="card-body">
        <form action="{{ route('crm.store_mail') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="category" value="broadcast">
            <div class="form-group">
                <label for="subject">Email Subject</label>
                <input type="text" name="subject" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="body">Email Body </label>
                <input id="body" type="hidden" name="body">
                <trix-editor input="body"></trix-editor>
            </div>

            <div class="form-group">
                <label for="picture">Picture (optional)</label>
                <input type="file" name="picture" class="form-control-file">
            </div>

            {{-- <div class="form-group">
                <label>Pilih Penerima</label><br>
                @foreach ($members as $member)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="recipients[]" value="{{ $member->id }}" id="member{{ $member->id }}">
                        <label class="form-check-label" for="member{{ $member->id }}">
                            {{ $member->nama }} ({{ $member->email }})
                        </label>
                    </div>
                @endforeach
            </div> --}}

            <button type="submit" class="btn btn-primary">Choose Recipients</button>
        </form>
    </div>

</div>
@push('js')    
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
@endpush
@endsection