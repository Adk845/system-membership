@extends('adminlte::page')

@section('title', 'Dashboard Member')

@section('content')

    @section('css')
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @endsection


    <div class="card mt-5">
        <div class="card-header">
            <ul class="nav nav-pills justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Event Aktif</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Event Lalu</a>
                </li>                
            </ul>
        </div>
        <div class="card-body">
            
        </div>
    </div>
    


@endsection