@extends('adminlte::page') {{-- Atau sesuaikan layout --}}
@section('content')
<div class="container">
    <h3>📢 Preview dan Kirim Broadcast Email</h3>

    {{-- Form Pilih Event --}}
    <form method="GET" action="{{ route('broadcast.preview') }}" class="mb-4">
        <div class="form-group">
            <label for="event_id">Pilih Acara:</label>
            <select name="event_id" id="event_id" class="form-control" required>
                <option value="">-- Pilih Acara --</option>
                @foreach($events as $event)
                    <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>
                        {{ $event->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Preview</button>
    </form>

    {{-- Preview Email --}}
   @if($selectedEvent)
        <h5>Preview Email:</h5>

        <div class="border p-3 mb-3" style="background-color: #fff; border-radius: 6px; max-height: 400px; overflow-y: auto;">
            {!! view('emails.email_template.notifikasi', ['event' => $selectedEvent])->render() !!}
        </div>

        <form method="POST" action="{{ route('broadcast.send') }}">
            @csrf
            <input type="hidden" name="event_id" value="{{ $selectedEvent->id }}">

            <div class="form-group">
                <label for="emails">Masukkan Email Tujuan (pisahkan dengan koma):</label>
                <textarea name="email_string" class="form-control" rows="3" placeholder="contoh: user1@email.com, user2@email.com" required>{{ old('email_string') }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Kirim Email</button>
        </form>
    @endif

</div>
@endsection
