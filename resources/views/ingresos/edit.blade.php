@extends('layouts.layaout')
@section('title', ' Ingresos')

@section('content')
    <div class="row d-flex align-items-center mb-4">
        <div class="col">
            <a class="btn btn-danger" href="{{ url('admin/ingresos') }}">
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
                <div class="card-header"><i class="fa-solid fa-edit"></i> <b>Actualizar ingreso</b>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ url('admin/ingresos/update', $ingresos->id) }}">
                        @csrf
                        @method('PUT')
                        <input type="text" class="form-control" placeholder="Valor" name="id_producto"
                            value="{{ $ingresos->producto_id }}" hidden />
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Valor" name="nombre_producto"
                                value="{{ $ingresos->productoFk->nombre }}" readonly />
                            <label>Producto </label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Valor" name="codigo_producto"
                                id="codigo" readonly value="{{ $ingresos->productoFk->codigo }}" />
                            <label>Codigo </label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" placeholder="Valor" name="cantidad"
                                {{ $errors->has('cantidad') ? 'is-invalid' : '' }} id='cantidadInput'
                                value="{{ $ingresos->cantidad }}" />
                            <label>cantidad <b class="text-danger">*</b></label>
                            @if ($errors->has('cantidad'))
                                <small class="text-danger">{{ $errors->first('cantidad') }}</small>
                            @endif
                        </div>

                        <div class="form-floating mb-3">
                            <textarea name="observaciones" class="form-control" placeholder="observaciones">{{ $ingresos->observaciones }}</textarea>
                            <label>Observaciones </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-outline-danger colorRed" id="btn-add-class">
                                Actualizar ingreso
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
