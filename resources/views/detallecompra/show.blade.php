@extends('layouts.layaout')
@section('title', 'Historial de compras')

@section('content')
    <div class="row mb-4">
        <div class="col-lg-12">
            <a class="btn btn-danger" href="{{ route('admin.detallecompra.index') }}">
                <i class="fas fa-caret-square-left"></i> Atrás
            </a>
        </div>
    </div>

    <div class="row">

        <div class="col-12 col-lg-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-header fs-5">
                    <i class="fas fa-info-circle"></i>
                    Información de la compra
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered nowrap table-hover" style="width: 100%" id="tablaClase">
                            <thead>
                                <tr>
                                    <th class="d-flex align-items-center">Factura</th>
                                    <td>{{ $compra->id }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha de la compra</th>
                                    <td>{{ $compra->fecha }}</td>
                                </tr>
                                <tr>
                                    <th>Usuario</th>
                                    <td>{{ $compra->UsuarioFk->name }}</td>
                                </tr>
                                <tr {{ $compra->observaciones == null ? 'hidden' : '' }}>
                                    <th>Observaciones</th>
                                    <td>{{ $compra->observaciones }}</td>
                                </tr>
                                <tr>
                                    <th>Total compra</th>
                                    <td>${{ number_format($compra->valor_total) }}</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-header fs-5">
                    <i class="fa-solid fa-boxes-stacked"></i>
                    Producto comprados
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered nowrap table-hover" style="width: 100%" id="tablaClase">
                            <thead>
                                <tr>
                                    <th class="text-start">Producto</th>
                                    <th class="text-end">Codigo</th>
                                    <th class="text-end">Cantidad</th>
                                    <th class="text-end">Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detalle_compras as $item)
                                    <tr>
                                        <td class="text-start">{{ $item->productoFk->nombre }}</td>
                                        <td class="text-end">{{ $item->productoFk->codigo }}</td>
                                        <td class="text-end">{{ $item->cantidad }}</td>
                                        <td class="text-end">${{ number_format($item->valor) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
