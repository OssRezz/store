<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\DetalleVenta;
use App\Models\Inventario;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    public function index()
    {
        $cantidadVentas = Venta::where('fecha', '=', date('Y-m-d'))->count();
        $cantidadCompras = Compra::where('fecha', '=', date('Y-m-d'))->count();
        $valorVendido = Venta::where('fecha', '=', date('Y-m-d'))->sum('valor_total');
        $valorComprado = Compra::where('fecha', '=', date('Y-m-d'))->sum('valor_total');

        return view('reportes.reportes', compact('cantidadVentas', 'cantidadCompras', 'valorVendido', 'valorComprado'));
    }

    public function chartLine()
    {
        DB::statement("SET SQL_MODE=''");
        $timestamp = strtotime(date('Y-m-d'));
        $mes = date("n", $timestamp);
        $ventas = Venta::selectRaw('MONTH(fecha) as mes,fecha,SUM(valor_total) as total')
            ->having('mes', '=', $mes)->groupBy('fecha')->get();
        return $ventas;
    }

    public function chartDonaProductos()
    {
        DB::statement("SET SQL_MODE=''");
        $productos = DetalleVenta::join('productos', 'productos.id', '=', 'detalle_venta.producto_id')
            ->selectRaw('productos.nombre, SUM(cantidad) as cantidad_producto')
            ->groupBy('producto_id')->orderByRaw('cantidad_producto DESC')->take(5)->get();
        return $productos;
    }

    public function chartDonaStock()
    {
        $productos = Inventario::join('productos', 'productos.id', '=', 'inventario.producto_id')
            ->selectRaw('(inventario.cantidad - productos.stock) as total, productos.nombre')
            ->havingRaw('total <= 0')->orderByRaw('total ASC')->take(5)->get();
        return $productos;
    }
}
