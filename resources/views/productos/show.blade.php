@extends('layouts.layaout')
@section('title', 'Productos')

@section('content')
    <div class="row mb-4">
        <div class="col-lg-12">
            <a class="btn btn-danger" href="{{ route('admin.productos.index') }}">
                <i class="fas fa-caret-square-left"></i> Atrás
            </a>
        </div>
    </div>

    <div class="row">

        <div class="col-12 col-lg-7 mb-3">
            <div class="card shadow-sm">
                <div class="card-header fs-5">
                    <i class="fas fa-info-circle"></i>
                    Información del producto
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered nowrap table-hover" style="width: 100%" id="tablaClase">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $producto->id }}</td>
                                </tr>
                                <tr>
                                    <th class="d-flex align-items-center">nombre</th>
                                    <td>{{ $producto->nombre }}</td>
                                </tr>
                                <tr>
                                    <th>codigo</th>
                                    <td>{{ $producto->codigo }}</td>
                                </tr>
                                <tr>
                                    <th>Precio de compra</th>
                                    <td>${{ number_format($producto->precio_compra) }}</td>
                                </tr>
                                <tr>
                                    <th>Precio de venta</th>
                                    <td>${{ number_format($producto->precio_venta) }}</td>
                                </tr>

                                <tr>
                                    <th>Utilidad</th>
                                    <td>${{ number_format($producto->utilidad) }}</td>
                                </tr>
                                <tr>
                                    <th>Stock Min</th>
                                    <td>{{ $producto->stock }}</td>
                                </tr>
                                <tr>
                                    <th>Estado</th>
                                    <td>
                                        <span
                                            class="badge bg-{{ $producto->estado == 1 ? 'primary' : 'dark' }}">{{ $producto->estado == 1 ? 'Activo' : 'Inactivo' }}</span>
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
