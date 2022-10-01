@extends('layouts.layaout')
@section('title', 'Home')

@section('content')
    <div class="col-12 col-md-6 col-lg-4 col-xl-3 my-5">
        <div class="col mb-2">
            @if (session('message'))
                <div class="alert alert-primary alert-dismissible fade show d-flex justify-content-bewteen align-items-center mb-1"
                    role="alert">
                    <div class="col-10">
                        <i class="fa-solid fa-hand"></i> <b>{{ session('message') }}</b>
                    </div>
                    <div class="col-2 d-flex align-items-center text-center">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>
        <div class="card shadow-sm">
            <div class="card-header  text-center"><b> {{ Auth::user()->roles_id == 1 ? 'Administrador' : 'Usuario' }}</b>
            </div>
            <div class="card-body px-0 pb-0">
                <div class="row">
                    <div class="col-12 text-center mb-3">
                        <i class="fas fa-user-tie fa-4x"></i>
                    </div>
                    <div class="col-12 text-center">
                        <ul class="list-group">
                            <li class="list-group-item">
                                {{ Auth::user()->name }}
                            </li>
                            <li class="list-group-item">
                                {{ Auth::user()->email }}
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
