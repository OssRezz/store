@extends('layouts.layaout')
@section('title', 'Productos')

@section('content')
    <div class="row d-flex align-items-center mb-4">
        <div class="col">
            <a class="btn btn-danger" href="{{ route('admin.productos.index') }}">
                <i class="fas fa-plus-square"></i> Atras
            </a>
        </div>
    </div>
    <div class="row mb-0">
        <div class="col">
            @if (session('message'))
                <div class="alert alert-primary alert-dismissible fade show d-flex justify-content-bewteen align-items-center mb-1"
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
                <div class="card-header"><i class="fa-solid fa-boxes-stacked"></i> <b>Crear productos</b>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('admin.productos.store') }}">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Nombres" name="nombre"
                                {{ $errors->has('nombre') ? 'is-invalid' : '' }} value="{{ old('nombre', '') }}" />
                            <label>Nombre <b class="text-danger">*</b></label>
                            @if ($errors->has('nombre'))
                                <small class="text-danger">{{ $errors->first('nombre') }}</small>
                            @endif
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" placeholder="Nombres" name="codigo"
                                {{ $errors->has('codigo') ? 'is-invalid' : '' }} value="{{ old('codigo', '') }}" />
                            <label>Codigo <b class="text-danger">*</b></label>
                            @if ($errors->has('codigo'))
                                <small class="text-danger">{{ $errors->first('codigo') }}</small>
                            @endif
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" placeholder="Nombres" name="precio_compra"
                                {{ $errors->has('precio_compra') ? 'is-invalid' : '' }}
                                value="{{ old('precio_compra', '') }}" />
                            <label>Precio de compra <b class="text-danger">*</b></label>
                            @if ($errors->has('precio_compra'))
                                <small class="text-danger">{{ $errors->first('precio_compra') }}</small>
                            @endif
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" placeholder="Nombres" name="precio_venta"
                                {{ $errors->has('precio_venta') ? 'is-invalid' : '' }}
                                value="{{ old('precio_venta', '') }}" />
                            <label>Precio de venta <b class="text-danger">*</b></label>
                            @if ($errors->has('precio_venta'))
                                <small class="text-danger">{{ $errors->first('precio_venta') }}</small>
                            @endif
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" placeholder="Stock" name="stock"
                                {{ $errors->has('stock') ? 'is-invalid' : '' }} value="{{ old('stock', '') }}" />
                            <label>Stock minimo <b class="text-danger">*</b></label>
                            @if ($errors->has('stock'))
                                <small class="text-danger">{{ $errors->first('stock') }}</small>
                            @endif
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-outline-danger colorRed" id="btn-add-class">
                                Ingresar producto
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
