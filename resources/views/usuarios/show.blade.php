@extends('layouts.layaout')
@section('title', 'Usuarios')

@section('content')
    <div class="row mb-4">
        <div class="col-lg-12">
            <a class="btn btn-danger" href="{{ route('admin.usuarios.index') }}">
                <i class="fas fa-caret-square-left"></i> Atrás
            </a>
        </div>
    </div>

    <div class="row">

        <div class="col-12 col-lg-7 mb-3">
            <div class="card shadow-sm">
                <div class="card-header fs-5">
                    <i class="fas fa-info-circle"></i>
                    Información del usuario
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered nowrap table-hover" style="width: 100%" id="tablaClase">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $usuario->id }}</td>
                                </tr>
                                <tr>
                                    <th class="d-flex align-items-center">Cargo</th>
                                    <td>{{ $usuario->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $usuario->email }}</td>
                                </tr>
                                <tr>
                                    <th>Rol</th>
                                    <td>{{ $usuario->nombre }}</td>
                                </tr>
                                <tr>
                                    <th>Estado</th>
                                    <td>
                                        <span
                                            class="badge bg-{{ $usuario->estado == 1 ? 'primary' : 'dark' }}">{{ $usuario->estado == 1 ? 'Activo' : 'Inactivo' }}</span>
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
