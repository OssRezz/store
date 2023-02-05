@extends('layouts.app')

@section('content')
    <div class=" col-10 col-md-6 col-lg-8 col-xl-6 col-xxl-4 my-5">
        <div class="card shadow-sm ">
            <div class="card-header d-flex justify-content-center bg-white border-bottom-0 mt-4">
                <img src="{{ asset('assets/images/sinlimite.jpg') }}" alt="" height="150px">
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="col-12 mb-4 mt-2">
                        <div class="form-floating">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <label for="email">{{ __('Email') }}</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 mb-4">
                        <div class="form-floating">

                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">
                            <label for="password">{{ __('Password') }}</label>


                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                    </div>

                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-danger">
                            {{ __('Iniciar sesion') }}
                        </button>
                    </div>
                </form>

                <div class="col mb-2">
                    @if (session('message'))
                        <div class="alert alert-primary alert-dismissible fade show d-flex justify-content-bewteen align-items-center mb-1"
                            role="alert">
                            <div class="col-10">
                                <i class="fa-solid fa-circle-info"></i> <b>{{ session('message') }}</b>
                            </div>
                            <div class="col-2 d-flex align-items-center text-center">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
    <div class="col-12 text-center" hidden>@ Desarrollado por <b>James Osorio Florez</b></div>
@endsection
