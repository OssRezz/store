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
        <div class="col-12 col-lg-6 col-xl-4 mb-4">
            <div class="card">
                <div class="card-header"><i class="fa-solid fa-warehouse"></i> <b>Agregar producto al inventario</b>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('admin.inventarios.store') }}">
                        @csrf
                        <div class="form-floating mb-3" hidden>
                            <input type="text" class="form-control" placeholder="Gasto" name="producto_id"
                                id="id_producto" value="{{ old('producto_id', '') }}" readonly />
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Valor" name="nombre_producto"
                                id="nombre" readonly />
                            <label>Producto <b class="text-danger">*</b></label>
                            @if ($errors->has('nombre_producto'))
                                <small class="text-danger">El nombre del producto es requerido <b
                                        class="text-danger">*</b></small>
                            @endif
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Valor" name="codigo_producto"
                                id="codigo" readonly />
                            <label>Codigo <b class="text-danger">*</b></label>
                            @if ($errors->has('codigo_producto'))
                                <small class="text-danger">El codigo del producto es requerido <b
                                        class="text-danger">*</b></small>
                            @endif
                        </div>

                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" placeholder="Valor" name="cantidad"
                                {{ $errors->has('cantidad') ? 'is-invalid' : '' }} id='cantidadInput' />
                            <label>cantidad <b class="text-danger">*</b></label>
                            @if ($errors->has('cantidad'))
                                <small class="text-danger">{{ $errors->first('cantidad') }}</small>
                            @endif
                        </div>



                        <div class="d-grid">
                            <button type="submit" class="btn btn-outline-danger colorRed" id="btn-add-class">
                                Ingresar inventario
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-8">
            <div class="card">
                <div class="card-header"><i class="fa-solid fa-boxes-stacked"></i>
                    <b>Productos</b>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-stripped table-bordered table-sm" style="width: 100%"
                        id="tableProductos">
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
    <script defer>
        table = $('#tableProductos').DataTable({
            paging: true,
            paging: true,
            lengthChange: false,
            responsive: true,
            pagingType: "simple",
            info: false,
            dom: "<'row'<'col-sm-12'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        });
    </script>
    <script src="{{ asset('assets/js/inventario/inventario.js') }}"></script>
@endsection
