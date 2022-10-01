<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;

class DetalleVentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::all();
        return view('detalleventa.index', compact('ventas'));
    }

    public function show($id)
    {
        $venta = Venta::with('UsuarioFk')->find($id);
        $detalle_ventas = DetalleVenta::with('productoFk')->where('venta_id', $id)->get();
        return view('detalleventa.show', compact('venta', 'detalle_ventas'));
    }

    public function edit($id)
    {
        $inventario = Inventario::join('productos', 'productos.id', '=', 'inventario.producto_id')
            ->select('inventario.*', 'productos.precio_compra', 'productos.precio_venta', 'productos.nombre', 'productos.codigo')
            ->get();

        $venta = Venta::find($id);
        $producto_venta = DetalleVenta::with('ProductoFk')->where('venta_id', $id)->get();

        return view('detalleventa.edit', compact('venta', 'inventario', 'producto_venta'));
    }

    public function store(Request $request, Venta $venta)
    {
        $venta = Venta::find($request->factura);
        $venta->valor_total = $request->total;
        $venta->forma_pago = $request->forma_pago;
        $venta->forma_pago_dos = $request->forma_pago_dos;
        $venta->valor_pago_dos = $request->valor_pago_dos;
        $venta->observaciones = $request->observaciones;
        $venta->update();

        $productos_venta = DetalleVenta::with('ProductoFk')->where('venta_id', $request->factura)->get();
        foreach ($productos_venta as $key => $value) {
            $producto = Producto::where('codigo', $value->ProductoFk->codigo)->take(1)->get();

            $isTheProductInInventory = Inventario::where('producto_id', $producto[0]['id'])->get();
            $iventario = Inventario::find($isTheProductInInventory[0]['id']);
            $iventario->cantidad = $isTheProductInInventory[0]['cantidad'] + $value->cantidad;
            $iventario->update();
        }

        DetalleVenta::where('venta_id', $request->factura)->delete();
        foreach ($request->ventas as $key => $value) {
            $producto = Producto::where('codigo', $value['codigo'])->take(1)->get();
            $detalle = new DetalleVenta();
            $detalle->venta_id =  $request->factura;
            $detalle->producto_id = $producto[0]['id'];
            $detalle->cantidad = $value['unidades'];
            $detalle->valor = $value['valor'];
            $detalle->tipo_venta = $value['tipo_venta'];
            $detalle->descuento = $value['descuento'];
            $detalle->save();

            $isTheProductInInventory = Inventario::where('producto_id', $producto[0]['id'])->get();
            $iventario = Inventario::find($isTheProductInInventory[0]['id']);
            $iventario->cantidad = $isTheProductInInventory[0]['cantidad'] - $value['unidades'];
            $iventario->update();
        }

        $inventario = Inventario::join('productos', 'productos.id', '=', 'inventario.producto_id')
            ->select('inventario.*', 'productos.precio_compra', 'productos.precio_venta', 'productos.nombre', 'productos.codigo')->select('inventario.id', 'productos.nombre', 'productos.codigo', 'inventario.cantidad', 'productos.precio_venta')
            ->where('cantidad', '>', 0)->get();
        return $inventario;
    }
}
