<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\DetalleVenta;
use App\Models\Inventario;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;

class CuadreController extends Controller
{
    public function index()
    {
        $ventas = Venta::where('fecha', '=', date('Y-m-d'))->get();
        $efectivo =  0;
        $transaccion =  0;
        foreach ($ventas as $key => $venta) {
            if ($venta->forma_pago === "Efectivo") {
                $efectivo = $venta->valor_total - $venta->valor_pago_dos + $efectivo;
            } else if ($venta->forma_pago_dos === "Efectivo") {
                $efectivo = $venta->valor_pago_dos + $efectivo;
            }

            if ($venta->forma_pago === "Transacción") {
                $transaccion = $venta->valor_total - $venta->valor_pago_dos  + $transaccion;
            } else if ($venta->forma_pago_dos === "Transacción") {
                $transaccion = $venta->valor_pago_dos  + $transaccion;
            }
        }

        //     <tr {{ $venta->forma_pago_dos == null ? 'hidden' : '' }}>
        //     <th>Valor {{ $venta->forma_pago }}</th>
        //     <td>${{ number_format($venta->valor_total - $venta->valor_pago_dos) }}</td>
        // </tr>
        // <tr {{ $venta->forma_pago_dos == null ? 'hidden' : '' }}>
        //     <th>Valor {{ $venta->forma_pago_dos }}</th>
        //     <td>${{ number_format($venta->valor_pago_dos) }}</td>
        // </tr>

        $cantidadCompras = Compra::where('fecha', '=', date('Y-m-d'))->count();
        $valorVendido = Venta::where('fecha', '=', date('Y-m-d'))->sum('valor_total');
        $valorComprado = Compra::where('fecha', '=', date('Y-m-d'))->sum('valor_total');
        $cuadre = $valorVendido - $valorComprado;

        return view('reportes.cuadres', compact('efectivo', 'transaccion', 'valorVendido', 'valorComprado', 'cuadre'));
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
