@extends('layouts.layaout')
@section('title', 'Historico Compras')
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
        <div class="col-12">
            <div class="card">
                <div class="card-header"><i class="fa-solid fa-file-invoice-dollar"></i> <b>Historial de compras</b>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-stripped table-bordered table-sm" style="width: 100%"
                            id="tableGasto">
                            <thead>
                                <tr>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">Factura</th>
                                    <th class="text-center">Observaciones</th>
                                    <th class="text-end">Total</th>
                                    <th class="text-center">Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($compras as $item)
                                    <tr>
                                        <td class="text-center">{{ $item->created_at }}</td>
                                        <td class="text-center">{{ $item->id }}</td>
                                        <td class="text-center">{{ $item->observaciones }}</td>
                                        <td class="text-end">${{ number_format($item->valor_total) }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-outline-danger btn-table border-0 btn-sm"
                                                href="{{ route('admin.detallecompra.show', $item->id) }}">
                                                <i class="fas fa-eye" style="pointer-events: none"></i>
                                            </a>
                                            <a class="btn btn-outline-danger btn-table border-0 btn-sm"
                                                href="{{ route('admin.detallecompra.edit', $item->id) }}"
                                                {{ Auth::user()->roles_id != 1 ? 'hidden' : '' }}>
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
        table = $('#tableGasto').DataTable({
            paging: true
        });
    </script>
@endsection
