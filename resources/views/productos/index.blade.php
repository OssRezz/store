@extends('layouts.layaout')
@section('title', 'Productos')
@section('content')
    <div class="row d-flex align-items-center mb-4">
        <div class="col">
            <a class="btn btn-danger" href="{{ route('admin.productos.create') }}">
                <i class="fas fa-plus-square"></i> Agregar producto
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
                        <button type="button"class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><i class="fa-solid fa-boxes-stacked"></i> <b>Lista de productos</b>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-stripped table-bordered table-sm" style="width: 100%"
                            id="tableclient">
                            <thead>
                                <tr>
                                    <th class="text-start">Nombre</th>
                                    <th class="text-end">Codigo</th>
                                    <th class="text-end">Precio Compra</th>
                                    <th class="text-end">Precio Venta</th>
                                    <th class="text-end">Utilidad</th>
                                    <th class="text-end">Stock Min</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productos as $item)
                                    <tr>
                                        <td class="text-center">{{ $item->nombre }}</td>
                                        <td class="text-end">{{ $item->codigo }}</td>
                                        <td class="text-end">${{ number_format($item->precio_compra) }}</td>
                                        <td class="text-end">${{ number_format($item->precio_venta) }}</td>
                                        <td class="text-end">${{ number_format($item->utilidad) }}</td>
                                        <td class="text-end">{{ $item->stock }}</td>
                                        <td class="text-center"><span
                                                class="badge bg-{{ $item->estado == 1 ? 'primary' : 'dark' }}">{{ $item->estado == 1 ? 'Activo' : 'Inactivo' }}</span>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-outline-danger btn-table border-0 btn-sm"
                                                href="{{ route('admin.productos.show', $item->id) }}">
                                                <i class="fas fa-eye" style="pointer-events: none"></i>
                                            </a>
                                            <a class="btn btn-outline-danger btn-table border-0 btn-sm"
                                                href="{{ route('admin.productos.edit', $item->id) }}">
                                                <i class="fas fa-edit" style="pointer-events: none"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script defer>
        table = $('#tableclient').DataTable({
            paging: true
        });
    </script>
@endsection
