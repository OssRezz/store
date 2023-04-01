@extends('layouts.layaout')
@section('title', 'Ingresos')
@section('content')
    <div class="row d-flex align-items-center mb-4">
        <div class="col">
            <a class="btn btn-danger" href="{{ url('admin/ingresos/create') }}">
                <i class="fas fa-plus-square"></i> Agregar ingreso
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
                <div class="card-header"><i class="fa-solid fa-file-invoice-dollar"></i> <b>Lista de ingresos</b>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-stripped table-bordered table-sm" style="width: 100%"
                            id="tableIngreso">
                            <thead>
                                <tr>
                                    <th class="text-start">Usuario</th>
                                    <th class="text-start">Fecha</th>
                                    <th class="text-start">Producto</th>
                                    <th class="text-start">Observacion</th>
                                    <th class="text-end">Codigo</th>
                                    <th class="text-end">Cantidad</th>
                                    <th class="text-center">Accion</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ingresos as $item)
                                    <tr>
                                        <td class="text-start">{{ $item->User->name }}</td>
                                        <td class="text-start">{{ $item->created_at }}</td>
                                        <td class="text-start">{{ $item->productoFk->nombre }}</td>
                                        <td class="text-start">{{ $item->observaciones }}</td>
                                        <td class="text-end">{{ $item->productoFk->codigo }}</td>
                                        <td class="text-end">{{ $item->cantidad }}</td>
                                        <td class="text-center">
                                            {{-- <a class="btn btn-outline-danger btn-table border-0 btn-sm"
                                                href="{{ route('admin.gastos.show', $item->id) }}">
                                                <i class="fas fa-eye" style="pointer-events: none"></i>
                                            </a> --}}
                                            <a class="btn btn-outline-danger btn-table border-0 btn-sm"
                                                href="{{ url('admin/ingresos/edit', $item->id) }}">
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
        table = $('#tableIngreso').DataTable({
            paging: true
        });
    </script>
@endsection
