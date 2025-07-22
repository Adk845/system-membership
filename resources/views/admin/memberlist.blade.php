@extends('adminlte::page')

@section('title', 'memberlist')

@section('content')
<div>
     @if (session('success'))
          <div id="popup-success" class="alert alert-success alert-dismissible fade show my-4 shadow-sm" role="alert" style="font-size: 1rem; animation: slideIn 0.5s ease-out;">
              <i class="fas fa-check-circle mr-2"></i>
              <strong>Sukses!</strong> {{ session('success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="outline: none;">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
      @endif

       @if (session('success_create'))
          <div id="popup-success" class="alert alert-success alert-dismissible fade show my-4 shadow-sm" role="alert" style="font-size: 1rem; animation: slideIn 0.5s ease-out;">
              <i class="fas fa-check-circle mr-2"></i>
              <strong>Sukses!</strong> {{ session('success_create') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="outline: none;">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
      @endif

      @if (session('error'))
          <div id="popup-error" class="alert alert-danger alert-dismissible fade show my-4 shadow-sm" role="alert" style="font-size: 1rem; animation: slideIn 0.5s ease-out;">
              <i class="fas fa-check-circle mr-2"></i>
              <strong>Error!</strong> {{ session('error') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="outline: none;">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
      @endif

      @if (session('error_create'))
          <div id="popup-error" class="alert alert-danger alert-dismissible fade show my-4 shadow-sm" role="alert" style="font-size: 1rem; animation: slideIn 0.5s ease-out;">
              <i class="fas fa-check-circle mr-2"></i>
              <strong>Error!</strong> {{ session('error_create') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="outline: none;">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
      @endif

      <div class="m-3">
        <form method="GET" class="form-inline mb-3">
            <input type="text" name="search" class="form-control mr-2" placeholder="Cari nama, domisili, email" value="{{ request('search') }}">
            
            <select name="per_page" class="form-control mr-2" onchange="this.form.submit()">
                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>All</option>
            </select>

            <button type="submit" class="btn btn-primary">Terapkan</button>
        </form>
        <a class="btn btn-primary" href="{{ route('member.create') }}">Crete new Member</a>
     </div>

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
                        <td>{{ ($member instanceof \Illuminate\Pagination\LengthAwarePaginator ? $member->firstItem() + $index : $loop->iteration) }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->domisili }}</td>
                        <td>{{ $item->user->email }}</td>
                       <td>{{ \Illuminate\Support\Str::title($item->level) }}</td>
                       
                        <td>
                          <div class="dropdown">
                              <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                Option
                              </a>

                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('member.delete', $item->user->id) }}" onclick=" return confirm('Apakah Anda Yakin Mau Menghapus User Ini ? ')">Delete</a>
                                <a class="dropdown-item" href="{{ route('member.edit', $item->user->id) }}">Edit</a>                                                                  
                              </div>
                            </div>              
                        </td>                        
                    </tr>    
                @endforeach                               
            </tbody>
        </table>
    </div>
    <div class="px-3 pb-3 d-flex justify-content-end">
        @if(method_exists($member, 'links'))
            {{ $member->links() }}
        @endif
    </div>

</div>

<!-- Modal -->
{{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div> --}}

@endsection