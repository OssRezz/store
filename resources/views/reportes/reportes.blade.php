@extends('layouts.layaout')
@section('title', 'Reportes')
@section('cdn')
    <script type="text/javascript" src="{{ asset('assets/chartjs/chart.min.js') }}"></script>
@endsection
@section('content')
    @php
        $timestamp = strtotime(date('Y-m-d'));
        $mes = date('n', $timestamp);
    @endphp
    <div class="row">
        <div class="col-12  col-lg-6 col-xl-6 col-xxl-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-center px-4" style="height: 7em;">
                    <div class="col">
                        <i class="fa-solid fa-cash-register fa-3x text-success"></i>
                    </div>
                    <div class="col">
                        <div class="col-12 text-end">
                            <h3><b>{{ $cantidadVentas }}</b></h3>
                        </div>
                        <div class="col-12 text-end">
                            <small><b>Ventas del dia</b></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12  col-lg-6 col-xl-6 col-xxl-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-center px-4" style="height: 7em;">
                    <div class="col">
                        <i class="fa-solid fa-boxes-stacked fa-3x text-danger"></i>
                    </div>
                    <div class="col">
                        <div class="col-12 text-end">
                            <h3><b>{{ $cantidadCompras }}</b></h3>
                        </div>
                        <div class="col-12 text-end">
                            <small><b>Compras del dia</b></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12  col-lg-6 col-xl-6 col-xxl-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-center px-4" style="height: 7em;">
                    <div class="col">
                        <i class="fa-solid fa-money-bill-trend-up fa-3x text-success"></i>
                    </div>
                    <div class="col">
                        <div class="col-12 text-end">
                            <h3><b>${{ number_format($valorVendido) }}</b></h3>
                        </div>
                        <div class="col-12 text-end">
                            <small><b>Valor ventas</b></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12  col-lg-6 col-xl-6 col-xxl-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-center px-4" style="height: 7em;">
                    <div class="col">
                        <i class="fa-solid fa-money-bill-transfer fa-3x text-danger"></i>
                    </div>
                    <div class="col">
                        <div class="col-12 text-end">
                            <h3><b>${{ number_format($valorComprado) }}</b></h3>
                        </div>
                        <div class="col-12 text-end">
                            <small><b>Valor compras</b></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-xl-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header"><i class="fa-solid fa-chart-pie"></i> <b>Productos mas vendidos</b>
                </div>
                <div class="card-body chart d-flex justify-content-center">
                    <canvas id="chartDonaProductos" class="d-flex justify-content-center"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header"><i class="fa-solid fa-chart-pie"></i> <b>Productos con stock agotado</b>
                </div>
                <div class="card-body chart d-flex justify-content-center">
                    <canvas id="chartDonaStock" class="d-flex justify-content-center"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-header"><i class="fa-solid fa-chart-line"></i> <b>Ventas por dia mes:
                        {{ $mes }}</b>
                </div>
                <div class="card-body chart  d-flex justify-content-center">
                    <canvas id="myChart2" class="d-flex justify-content-center"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/reportes/chartLine.js') }}" defer></script>
    <script src="{{ asset('assets/js/reportes/chartDonaProducto.js') }}" defer></script>
    <script src="{{ asset('assets/js/reportes/chartDonaStock.js') }}" defer></script>
@endsection
