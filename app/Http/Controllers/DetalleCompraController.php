<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Inventario;
use App\Models\Producto;
use Illuminate\Http\Request;

class DetalleCompraController extends Controller
{
    public function index()
    {
        $compras = Compra::all();
        return view('detallecompra.index', compact('compras'));
    }

    public function show($id)
    {
        $compra = Compra::with('UsuarioFk')->find($id);
        $detalle_compras = DetalleCompra::with('productoFk')->where('compra_id', $id)->get();

        return view('detallecompra.show', compact('compra', 'detalle_compras'));
    }

    public function edit($id)
    {
        $productos = Producto::get();
        $factura = $id;
        $detalle_compras = DetalleCompra::with('productoFk')->where('compra_id', $factura)->get();
        return view('detallecompra.edit', compact('productos', 'factura', 'detalle_compras'));
    }

    public function store(Request $request, Compra $compra)
    {
        $compra = Compra::find($request->factura);
        $compra->valor_total = $request->total;
        $compra->observaciones = $request->observaciones;
        $compra->update();

        $detalle_compras = DetalleCompra::with('productoFk')->where('compra_id', $request->factura)->get();
        foreach ($detalle_compras as $key => $value) {
            $producto = Producto::find($value->producto_id);
            $isTheProductInInventory = Inventario::where('producto_id', $producto->id)->get();

            $iventario = Inventario::find($isTheProductInInventory[0]['id']);
            $iventario->cantidad = $isTheProductInInventory[0]['cantidad'] - $value->cantidad;
            $iventario->update();
        }
        DetalleCompra::where('compra_id', $request->factura)->delete();

        foreach ($request->compras as  $value) {
            $producto = Producto::where('codigo', $value['codigo'])->take(1)->get();
            $detalle = new DetalleCompra();
            $detalle->compra_id =  $request->factura;
            $detalle->producto_id = $producto[0]['id'];
            $detalle->cantidad = $value['unidades'];
            $detalle->valor = $value['valor'];
            $detalle->save();

            $isTheProductInInventory = Inventario::where('producto_id', $producto[0]['id'])->get();
            if (count($isTheProductInInventory) > 0) {
                $iventario = Inventario::find($isTheProductInInventory[0]['id']);
                $iventario->cantidad = $value['unidades'] + $isTheProductInInventory[0]['cantidad'];
                $iventario->update();
            } else {
                $iventario = new Inventario();
                $iventario->cantidad =  $value['unidades'];
                $iventario->producto_id = $producto[0]['id'];
                $iventario->save();
            }
        }
        return $request;
    }
}
