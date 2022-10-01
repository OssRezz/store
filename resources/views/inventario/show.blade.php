@extends('layouts.layaout')
@section('title', 'Inventarios')

@section('content')
    <div class="row mb-4">
        <div class="col-lg-12">
            <a class="btn btn-danger" href="{{ route('admin.inventarios.index') }}">
                <i class="fas fa-caret-square-left"></i> Atrás
            </a>
        </div>
    </div>

    <div class="row">

        <div class="col-12 col-lg-7 mb-3">
            <div class="card shadow-sm">
                <div class="card-header fs-5">
                    <i class="fas fa-info-circle"></i>
                    Información del producto en inventario
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered nowrap table-hover" style="width: 100%" id="tablaClase">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $inventario->id }}</td>
                                </tr>
                                <tr>
                                    <th class="d-flex align-items-center">Producto</th>
                                    <td>{{ $inventario->productoFk->nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Codigo</th>
                                    <td>{{ $inventario->productoFk->codigo }}</td>
                                </tr>
                                <tr>
                                    <th>Precio de compra</th>
                                    <td>${{ number_format($inventario->productoFk->precio_compra) }}</td>
                                </tr>
                                <tr>
                                    <th>Precio de venta</th>
                                    <td>${{ number_format($inventario->productoFk->precio_venta) }}</td>
                                </tr>
                                <tr>
                                    <th>Cantidad en inventario</th>
                                    <td>{{ $inventario->cantidad }}</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
