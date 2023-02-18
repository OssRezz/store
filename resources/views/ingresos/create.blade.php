@extends('layouts.layaout')
@section('title', 'Ingresos')

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
        <div class="col-12 col-lg-6 col-xl-4 mb-4">
            <div class="card">
                <div class="card-header"><i class="fa-solid fa-people-carry-box"></i> <b>Dar ingreso al inventario</b>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ url('admin/ingresos/store') }}">
                        @csrf
                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                        <div class="form-floating mb-3" hidden>
                            <input type="text" name="producto_id" value="{{ $producto->productoFk->id }}" readonly />
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Valor" name="nombre_producto"
                                value="{{ $producto->productoFk->nombre }}" readonly />
                            <label>Producto </label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Valor" name="codigo_producto"
                                id="codigo" readonly value="{{ $producto->productoFk->codigo }}" />
                            <label>Codigo </label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Valor" 
                                value="{{ $producto->cantidad }}" readonly />
                            <label>Cantidad en inventario </label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" placeholder="Valor" name="cantidad"
                                {{ $errors->has('cantidad') ? 'is-invalid' : '' }} id='cantidadInput' />
                            <label>cantidad <b class="text-danger">*</b></label>
                            @if ($errors->has('cantidad'))
                                <small class="text-danger">{{ $errors->first('cantidad') }}</small>
                            @endif
                        </div>

                        <div class="form-floating mb-3">
                            <textarea name="observaciones" class="form-control" placeholder="observaciones"></textarea>
                            <label>Observaciones </label>
                        </div>



                        <div class="d-grid">
                            <button type="submit" class="btn btn-outline-danger colorRed" id="btn-add-class">
                                Dar ingreso
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <script src="{{ asset('assets/js/inventario/inventario.js') }}"></script>
    @endsection
