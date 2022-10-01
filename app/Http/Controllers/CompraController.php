<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Inventario;
use App\Models\Producto;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $factura =  Compra::orderByDesc('id')->take(1)->get();
        $factura = count($factura) == 0 ? 1 : $factura[0]['id'] + 1;
        $productos = Producto::get();
        return view('compras.index', compact('productos', 'factura'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Compra $compra)
    {
        $compra->valor_total = $request->total;
        $compra->observaciones = $request->observaciones;
        $compra->fecha = date('Y-m-d');
        $compra->user_id = $request->usuario;
        $compra->save();

        $lastId = Compra::orderByDesc('id')->take(1)->get();

        foreach ($request->compras as  $value) {
            $producto = Producto::where('codigo', $value['codigo'])->take(1)->get();
            $detalle = new DetalleCompra();
            $detalle->compra_id =  $lastId[0]['id'];
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
        $numFac = $lastId[0]['id'] + 1;
        return $numFac;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::find($id);
        return $producto;
    }
}
