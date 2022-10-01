@extends('layouts.layaout')
@section('title', 'Usuarios')
@section('content')
    <div class="row d-flex align-items-center mb-4">
        <div class="col">
            <a class="btn btn-danger" href="{{ route('admin.usuarios.create') }}">
                <i class="fas fa-plus-square"></i> Agregar usuario
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
                <div class="card-header"><i class="fa-solid fa-users"></i> <b>Lista de usuarios</b>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-stripped table-bordered table-sm" style="width: 100%"
                            id="tableclient">
                            <thead>
                                <tr>
                                    <th class="text-center">Nombre</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Rol</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (json_decode($users, true) as $item)
                                    <tr>
                                        <td class="text-center">{{ $item['name'] }}</td>
                                        <td class="text-center">{{ $item['email'] }}</td>
                                        <td class="text-center">{{ $item['nombre'] }}</td>
                                        <td class="text-center"><span
                                                class="badge bg-{{ $item['estado'] == 1 ? 'primary' : 'dark' }}">{{ $item['estado'] == 1 ? 'Activo' : 'Inactivo' }}</span>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-outline-danger btn-table border-0 btn-sm"
                                                href="{{ route('admin.usuarios.show', $item['id']) }}">
                                                <i class="fas fa-eye" style="pointer-events: none"></i>
                                            </a>
                                            <a class="btn btn-outline-danger btn-table border-0 btn-sm"
                                                href="{{ route('admin.usuarios.edit', $item['id']) }}">
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
        if ($.fn.dataTable.isDataTable('#tableclient')) {
            table = $('#tableclient').DataTable();
        } else {
            table = $('#tableclient').DataTable({
                paging: false
            });
        }
    </script>
@endsection
