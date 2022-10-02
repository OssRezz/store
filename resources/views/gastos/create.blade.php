@extends('layouts.layaout')
@section('title', 'Gastos')

@section('content')
    <div class="row d-flex align-items-center mb-4">
        <div class="col">
            <a class="btn btn-danger" href="{{ route('admin.gastos.index') }}">
                <i class="fas fa-plus-square"></i> Atras
            </a>
        </div>
    </div>
    <div class="row mb-0">
        <div class="col">
            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show d-flex justify-content-bewteen align-items-center mb-1"
                    role="alert">
                    <div class="col-10">
                        <i class="fa-solid fa-circle-info"></i> <b>{{ session('message') }}</b>
                    </div>
                    <div class="col-2 d-flex align-items-center text-center">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card">
                <div class="card-header"><i class="fa-solid fa-file-invoice-dollar"></i> <b>Crear gasto</b>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('admin.gastos.store') }}">
                        @csrf
                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Gasto" name="gasto"
                                {{ $errors->has('gasto') ? 'is-invalid' : '' }} value="{{ old('gasto', '') }}" />
                            <label>Descripcion <b class="text-danger">*</b></label>
                            @if ($errors->has('gasto'))
                                <small class="text-danger">{{ $errors->first('gasto') }}</small>
                            @endif
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" placeholder="Valor" name="valor"
                                {{ $errors->has('valor') ? 'is-invalid' : '' }} />
                            <label>Valor gasto <b class="text-danger">*</b></label>
                            @if ($errors->has('valor'))
                                <small class="text-danger">{{ $errors->first('valor') }}</small>
                            @endif
                        </div>



                        <div class="d-grid">
                            <button type="submit" class="btn btn-outline-danger colorRed" id="btn-add-class">
                                Ingresar gasto
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
