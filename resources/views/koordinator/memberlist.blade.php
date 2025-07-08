@extends('adminlte::page')

@section('title', 'memberlist')

@section('content')
<div>
    <h2>this is memberlist page</h2>
    <div>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Domisili</th>
                <th scope="col">Email</th>
                <th scope="col">Level</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($member as $index => $item)
                    <tr>                
                        <td>{{ $index }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->domisili }}</td>
                        <td>{{ $item->user->email }}</td>
                        <td>{{ $item->level }}</td>                        
                        <td>
                          <div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
    Dropdown link
  </a>

  <div class="dropdown-menu">
    <a class="dropdown-item" href="{{ route('') }}">Delete</a>
    {{-- <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a> --}}
  </div>
</div>
                            {{-- <div class="dropdown">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Action
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="#">Edit</a>
                                    </li>
                                    <li>
                                        <form action="#" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item text-danger" type="submit">Delete</button>
                                        </form>
                                    </li>
                                </ul>
                            </div> --}}
                        </td>                        
                    </tr>    
                @endforeach                               
            </tbody>
        </table>
    </div>
</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

@endsection