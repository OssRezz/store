@extends('layouts.layaout')
@section('title', 'Gastos')

@section('content')
    <div class="row mb-4">
        <div class="col-lg-12">
            <a class="btn btn-danger" href="{{ route('admin.gastos.index') }}">
                <i class="fas fa-caret-square-left"></i> Atrás
            </a>
        </div>
    </div>

    <div class="row">

        <div class="col-12 col-lg-7 mb-3">
            <div class="card shadow-sm">
                <div class="card-header fs-5">
                    <i class="fas fa-info-circle"></i>
                    Información del gasto
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered nowrap table-hover" style="width: 100%" id="tablaClase">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $gasto->fecha }}</td>
                                </tr>
                                <tr>
                                    <th class="d-flex align-items-center">Gasto</th>
                                    <td>{{ $gasto->gasto }}</td>
                                </tr>
                                <tr>
                                    <th>Valor</th>
                                    <td>{{ $gasto->valor }}</td>
                                </tr>

                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
