@extends('adminlte::page')

@section('title', 'List Penerima')

@section('content')


<h1 class="mb-4">Pilih Email Tujuan</h1>

{{-- Filter Form --}}


{{-- Table List Anggota --}}
<form method="POST" action="{{ route('emails.send') }}">
    @csrf
    <input type="hidden" name="email_id", value="{{ $email_id }}">                       
    <div class="card shadow">
        <div class="card-header bg-secondary text-white d-flex align-items-center">
            <strong>Daftar Anggota</strong>
           <div class="d-flex ml-auto">
            <a class="btn btn-warning btn-md mx-3" href="{{ route('emails.edit', $email_id) }}"><i class="fas fa-arrow-left"></i> Kembali</a>
             <button id="kirim_notifikasi_top" class="btn btn-success btn-md " type="submit">
                Kirim Email
            </button>
           </div>
        </div>
            <div class="card-body p-0">
                <table class="table table-bordered table-hover m-0">
                   <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th width="9%"><input type="checkbox" id="checkAll"> All</th>
                            
                            <!-- Nama -->
                            <th>
                                Name
                            </th>
                            <th>
                                Company
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Address
                            </th>
                            <th>
                                Phone
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                     
                    </tbody>
                </table>
            </div>
        {{-- <button id="kirim_notifikasi" class="btn btn-success">Kirim Email</button> --}}
    </div>
</form>

<!-- Modal Loading -->
    <div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-sm text-center p-5">
                <div class="spinner-border text-primary mb-3" role="status"></div>
                <h5 class="mb-0">Mengirim notifikasi email...</h5>
            </div>
        </div>
    </div>    
@endsection

@push('js')
<script>
    document.getElementById('checkAll').addEventListener('click', function () {
        let checkboxes = document.querySelectorAll('input[name="emails[]"]');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });

    $('#kirim_notifikasi_top').on('click', function () {
        $('#loadingModal').modal('show'); // Tampilkan modal loading saat tombol diklik
    });
</script>
@endpush
