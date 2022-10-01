@extends('layouts.layaout')
@section('title', 'Compras')
@section('content')

    <div class="row mb-0">
        <div class="col">
            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show d-flex justify-content-bewteen align-items-center mb-1"
                    role="alert">
                    <div class="col-10">
                        <i class="fa-solid fa-circle-info"></i> <b>{{ session('message') }}</b>
                    </div>
                    <div class="col-2 d-flex align-items-center text-center">
                        <button type="button"class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-7">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <b><i class="fa-solid fa-money-bill"></i> Compra</b>
                    <small><span class="badge bg-dark">Factura: <b id="factura">{{ $factura }}</b></span></small>
                </div>
                <div class="card-body">
                    <div class="row mb-md-0">
                        <div class="col-12 mb-3">
                            <div class="form-floating">
                                <input type="text" id="nombre" placeholder="Nombre" class="form-control" readonly>
                                <label for="">Nombre <b class="text-danger">*</b></label>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-floating">
                                <input type="text" id="codigo" placeholder="Codigo" class="form-control" readonly>
                                <label for="">Codigo <b class="text-danger">*</b></label>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <div class="form-floating">
                                <input type="text" id="valor_unidad" placeholder="Codigo" class="form-control">
                                <label for="">Valor unidad <b class="text-danger">*</b></label>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="form-floating">
                                <input type="text" id="unidades" placeholder="Codigo" class="form-control">
                                <label for="">Unidades <b class="text-danger">*</b></label>
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
                    <div class="table-responsive">
                        <table class="table table-hover table-stripped table-bordered table-sm" id="tableDetalle"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th class="text-center">Codigo</th>
                                    <th class="text-center">Uds</th>
                                    <th class="text-center">Precio</th>
                                    <th class="text-center">Total</th>
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
                            <textarea name="" id="observaciones" class="form-control"></textarea>
                            <label for="">Observaciones</label>
                            <input type="text" id="usuario" value="{{ Auth::user()->id }}" hidden>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-outline-danger" onclick="guardarCompra(this)">Guardar compra</button>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-12 col-lg-5">
            <div class="card">
                <div class="card-header"><i class="fa-solid fa-boxes-stacked"></i>
                    <b>Productos</b>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-stripped table-bordered table-sm" style="width: 100%"
                        id="tableclient">
                        <thead>
                            <tr>
                                <th class="text-center">Codigo</th>
                                <th class="text-center">Producto</th>
                                <th class="text-center">V. Compra</th>
                                <th class="text-center">V. Venta</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $item)
                                <tr onclick="selectProduct(this);" id="{{ $item->id }}" style="cursor: pointer;">
                                    <td class="text-center">{{ $item->codigo }}</td>
                                    <td class="text-center">{{ $item->nombre }}</td>
                                    <td class="text-center">${{ number_format($item->precio_compra) }}</td>
                                    <td class="text-center">${{ number_format($item->precio_venta) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/toast.js') }}" defer></script>
    <script src="{{ asset('assets/js/compras/producto.js') }}" defer></script>
    <script src="{{ asset('assets/js/compras/datatable.js') }}" defer></script>
@endsection
