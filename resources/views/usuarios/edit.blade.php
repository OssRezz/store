@extends('layouts.layaout')
@section('title', 'Usuarios')

@section('content')
    <div class="row d-flex align-items-center mb-4">
        <div class="col">
            <a class="btn btn-danger" href="{{ route('admin.usuarios.index') }}">
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
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card">
                <div class="card-header"><i class="fa-solid fa-edit"></i> <b>Actualizar usuario</b>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('admin.usuarios.update', $usuario['id']) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Nombres" name="name"
                                {{ $errors->has('name') ? 'is-invalid' : '' }} value="{{ $usuario['name'] }}" />
                            <label>Nombre <b class="text-latinco">*</b></label>
                            @if ($errors->has('name'))
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                            @endif
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" placeholder="Email" name="email"
                                {{ $errors->has('email') ? 'is-invalid' : '' }} value='{{ $usuario->email }}' />
                            <label>Email <b class="text-latinco">*</b></label>
                            @if ($errors->has('email'))
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                            @endif
                        </div>

                        <div class="form-floating mb-3">
                            <select name="roles_id" id="" class="form-select">
                                @foreach ($roles as $rol)
                                    <option {{ $usuario->roles_id == $rol->id ? 'selected' : '' }}
                                        value="{{ $rol->id }}">{{ $rol->nombre }}</option>
                                @endforeach
                            </select>
                            <label>Rol <b class="text-latinco">*</b></label>
                        </div>


                        <div class="form-floating mb-3">
                            <select name="estado" id="" class="form-select">
                                <option {{ $usuario->estado == 1 ? 'selected' : '' }} value="1">Activo</option>
                                <option {{ $usuario->estado == 0 ? 'selected' : '' }} value="0">Inactivo</option>
                            </select>
                            <label>Estado <b class="text-latinco">*</b></label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-outline-danger colorRed" id="btn-add-class">
                                Actualizar usuario
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
