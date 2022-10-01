@extends('layouts.layaout')
@section('title', 'Inventario')

@section('content')
    <div class="row d-flex align-items-center mb-4">
        <div class="col">
            <a class="btn btn-danger" href="{{ route('admin.inventarios.index') }}">
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
                <div class="card-header"><i class="fa-solid fa-edit"></i> <b>Actualizar inventario</b>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('admin.inventarios.update', $inventario->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="inventario" name="producto_id"
                                id="id_producto" value="{{ $inventario->productoFk->id }}" readonly />
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Valor" name="nombre_producto"
                                id="nombre" value="{{ $inventario->productoFk->nombre }}" readonly />
                            <label>Producto <b class="text-danger">*</b></label>
                            @if ($errors->has('nombre_producto'))
                                <small class="text-danger">El nombre del producto es requerido <b
                                        class="text-danger">*</b></small>
                            @endif
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Valor" name="codigo_producto"
                                id="codigo" value="{{ $inventario->productoFk->codigo }}" readonly />
                            <label>Codigo <b class="text-danger">*</b></label>
                            @if ($errors->has('codigo_producto'))
                                <small class="text-danger">El codigo del producto es requerido <b
                                        class="text-danger">*</b></small>
                            @endif
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" placeholder="cantidad" name="cantidad"
                                {{ $errors->has('cantidad') ? 'is-invalid' : '' }} value='{{ $inventario->cantidad }}' />
                            <label>Cantidad en inventario <b class="text-danger">*</b></label>
                            @if ($errors->has('cantidad'))
                                <small class="text-danger">{{ $errors->first('cantidad') }}</small>
                            @endif
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-outline-danger colorRed" id="btn-add-class">
                                Actualizar inventario
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
