@extends('layouts.layaout')
@section('title', 'Historial de ventas')

@section('content')
    <div class="row mb-4">
        <div class="col-lg-12">
            <a class="btn btn-danger" href="{{ route('admin.detalleventa.index') }}">
                <i class="fas fa-caret-square-left"></i> Atrás
            </a>
        </div>
    </div>

    <div class="row">

        <div class="col-12 col-lg-6 col-xxl-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-header fs-5">
                    <i class="fas fa-info-circle"></i>
                    Información de la venta
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered nowrap table-hover" style="width: 100%" id="tablaClase">
                            <thead>
                                <tr>
                                    <th class="d-flex align-items-center">Factura</th>
                                    <td>{{ $venta->id }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha de la venta</th>
                                    <td>{{ $venta->fecha }}</td>
                                </tr>
                                <tr>
                                    <th>Usuario</th>
                                    <td>{{ $venta->UsuarioFk->name }}</td>
                                </tr>
                                <tr {{ $venta->observaciones == null ? 'hidden' : '' }}>
                                    <th>Observaciones</th>
                                    <td>{{ $venta->observaciones }}</td>
                                </tr>
                                <tr>
                                    <th>Forma de pago</th>
                                    <td>{{ $venta->forma_pago }}</td>
                                </tr>
                                <tr {{ $venta->forma_pago_dos == null ? 'hidden' : '' }}>
                                    <th>Otra forma de pago</th>
                                    <td>{{ $venta->forma_pago_dos }}</td>
                                </tr>
                                <tr {{ $venta->forma_pago_dos == null ? 'hidden' : '' }}>
                                    <th>Valor {{ $venta->forma_pago }}</th>
                                    <td>${{ number_format($venta->valor_total - $venta->valor_pago_dos) }}</td>
                                </tr>
                                <tr {{ $venta->forma_pago_dos == null ? 'hidden' : '' }}>
                                    <th>Valor {{ $venta->forma_pago_dos }}</th>
                                    <td>${{ number_format($venta->valor_pago_dos) }}</td>
                                </tr>
                                <tr>
                                    <th>Total venta</th>
                                    <td>${{ number_format($venta->valor_total) }}</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xxl-8 mb-3">
            <div class="card shadow-sm">
                <div class="card-header fs-5">
                    <i class="fa-solid fa-boxes-stacked"></i>
                    Producto vendidos
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered nowrap table-hover" style="width: 100%" id="tablaClase">
                            <thead>
                                <tr>
                                    <th class="text-start">Producto</th>
                                    <th class="text-end">Codigo</th>
                                    <th class="text-start">Tipo Venta</th>
                                    <th class="text-end">Valor und</th>
                                    <th class="text-end">Cantidad</th>
                                    <th class="text-end">Descuento</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detalle_ventas as $item)
                                    <tr>
                                        <td class="text-start">{{ $item->productoFk->nombre }}</td>
                                        <td class="text-end">{{ $item->productoFk->codigo }}</td>
                                        <td class="text-start">{{ $item->tipo_venta }}</td>
                                        <td class="text-end">${{ number_format($item->valor) }}</td>
                                        <td class="text-end">{{ $item->cantidad }}</td>
                                        <td class="text-end">${{ number_format($item->descuento) }}</td>
                                        <td class="text-end">
                                            ${{ number_format($item->valor * $item->cantidad - $item->descuento) }}</td>
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
