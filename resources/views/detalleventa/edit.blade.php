@extends('layouts.layaout')
@section('title', 'Detalle de ventas')
@section('content')
    <div class="row mb-4">
        <div class="col-lg-12">
            <a class="btn btn-danger" href="{{ route('admin.detalleventa.index') }}">
                <i class="fas fa-caret-square-left"></i> Atrás
            </a>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-12 col-lg-7">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <b><i class="fa-solid fa-file-invoice-dollar"></i> Venta</b>
                    <small><span class="badge bg-dark">Factura: <b id="factura"
                                class="{{ $venta->id }}">{{ $venta->id }}</b></span></small>
                </div>
                <div class="card-body">
                    <div class="row mb-sm-3">
                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <input type="text" id="nombre" placeholder="Nombre" class="form-control" readonly>
                                <label for="">Nombre <b class="text-danger">*</b></label>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-floating">
                                <input type="text" id="codigo" placeholder="Codigo" class="form-control" readonly>
                                <label for="">Codigo <b class="text-danger">*</b></label>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-floating">
                                <input type="number" id="valor_unidad" placeholder="Codigo" class="form-control">
                                <label for="">Valor unidad <b class="text-danger">*</b></label>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-floating">
                                <input type="number" id="unidades" placeholder="Codigo" class="form-control"
                                    min="1" max="50">
                                <label for="">Unidades <b class="text-danger">*</b></label>
                                <input type="number" id="existencias" hidden>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <select name="" id="selectTipoVenta" class="form-select">
                                    <option value="Detal">Detal</option>
                                    <option value="Por mayor">Por mayor</option>
                                </select>
                                <label for="">Tipo de compra</label>
                            </div>
                        </div>

                        <div class="col-12" id="colDescuento">
                            <div class="form-floating">
                                <input type="number" id="descuento" placeholder="descuento" class="form-control">
                                <label for="">Descuento <b class="text-danger">*</b></label>
                            </div>
                        </div>

                    </div>
                    <div class="row d-flex justify-content-end">
                        <div class="col-12 col-md-4 d-flex justify-content-end">
                            <button class="btn btn-outline-danger" onclick="agregarProducto(this);">Agregar</button>
                        </div>
                    </div>
                </div>


            </div>
            <div class="card mb-4">
                <div class="card-body pb-0">
                    <input type="text" value="{{ json_encode($producto_venta) }}" id="contenidoVenta" hidden>
                    <div class="table-responsive">
                        <table class="table table-hover table-stripped table-bordered table-sm" id="VentaDetalle"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th class="text-end">Codigo</th>
                                    <th class="text-end">Uds</th>
                                    <th class="text-end">Precio</th>
                                    <th class="text-end">Dcto</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody id="carrito">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="col-12 mb-3">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <b>Valor Total: </b>
                                <span class="badge bg-primary rounded-pill" id="total"></span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="form-floating">
                            <select name="" id="forma_pago" class="form-select">
                                <option value="" selected disabled>Seleccione una opcion</option>
                                <option {{ $venta->forma_pago == 'Efectivo' ? 'selected' : '' }} value="Efectivo">
                                    Efectivo
                                </option>
                                <option {{ $venta->forma_pago == 'Transacción' ? 'selected' : '' }} value="Transacción">
                                    Transacción
                                </option>
                                <option {{ $venta->forma_pago == 'Credito' ? 'selected' : '' }} value="Credito">Credito
                                </option>
                            </select>
                            <label for="">Forma de pago <b class="text-danger">*</b></label>
                        </div>
                    </div>

                    <div class="col d-flex justify-content-start mb-3">
                        <small class="mx-1"><b>Activar segunda opcion de pago:</b></small>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="segundaOpcion"
                                {{ $venta->forma_pago_dos == null ? '' : 'checked' }}>
                        </div>
                    </div>

                    <div class="col-12 mb-3" id="colSegundaForma" {{ $venta->forma_pago_dos == null ? 'hidden' : '' }}>
                        <div class="form-floating">
                            <select name="" id="segunda_forma_pago" class="form-select">
                                <option {{ $venta->forma_pago_dos == 'Efectivo' ? 'selected' : '' }} value="Efectivo">
                                    Efectivo
                                </option>
                                <option {{ $venta->forma_pago_dos == 'Transacción' ? 'selected' : '' }}
                                    value="Transacción">
                                    Transacción
                                </option>
                                <option {{ $venta->forma_pago_dos == 'Credito' ? 'selected' : '' }} value="Credito">
                                    Credito
                                </option>
                            </select>
                            <label for="">Segunda Forma de pago <b class="text-danger">*</b></label>
                        </div>
                    </div>

                    <div class="col-12 mb-3" id="colValorSegunda" {{ $venta->valor_pago_dos == null ? 'hidden' : '' }}>
                        <div class="form-floating">
                            <input type="number" id="valor_pago_dos" placeholder="Codigo" class="form-control"
                                value="{{ $venta->valor_pago_dos }}">
                            <label for="">Valor de pago<b class="text-danger">*</b></label>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="form-floating">
                            <textarea name="" id="observaciones" class="form-control">{{ $venta->observaciones }}</textarea>
                            <label for="">Observaciones</label>
                            <input type="text" id="usuario" value=" {{ Auth::user()->id }}" hidden>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-outline-danger" onclick="actualizarCompra(this)">Actualizar venta</button>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-12 col-lg-5">
            <div class="card">
                <div class="card-header"><i class="fa-solid fa-boxes-stacked"></i>
                    <b>Productos en inventario</b>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-stripped table-bordered table-sm" style="width: 100%"
                        id="tableclient">
                        <thead>
                            <tr>
                                <th class="text-start">Producto</th>
                                <th class="text-end">Codigo</th>
                                <th class="text-end">Uds</th>
                                <th class="text-end">V. Venta</th>
                            </tr>
                        </thead>
                        <tbody id='tablaInventario'>
                            @foreach ($inventario as $item)
                                <tr onclick="selectProduct(this);" id="{{ $item->id }}" style="cursor: pointer;">
                                    <td class="text-start">{{ $item->nombre }}</td>
                                    <td class="text-end">{{ $item->codigo }}</td>
                                    <td class="text-end">{{ $item->cantidad }}</td>
                                    <td class="text-end">${{ number_format($item->precio_venta) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/ventas/datatable.js') }}" defer></script>
    <script src="{{ asset('assets/js/toast.js') }}" defer></script>
    <script src="{{ asset('assets/js/ventas/detalleventa.js') }}" defer></script>
@endsection
