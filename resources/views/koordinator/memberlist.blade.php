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
                                Option
                              </a>

                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('member.delete', $item->user->id) }}">Delete</a>
                                <div>
                                  <form method="POST" action="{{ route('member.edit') }}">
                                    @csrf
                                    <input type="hidden" name="id_user" value="{{ $item->id }}">
                                    <button class="dropdown-item">edit</button>
                                  </form>
                                </div>
                                {{-- <a class="dropdown-item" href="{{ route('member.edit') }}">Edit</a> --}}
                                {{-- <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a> --}}
                              </div>
                            </div>              
                        </td>                        
                    </tr>    
                @endforeach                               
            </tbody>
        </table>
    </div>
</div>

<!-- Button trigger modal -->
<a class="btn btn-primary" href="{{ route('member.create') }}">Crete new Member</a>

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