<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIngresoRequest;
use App\Models\Ingreso;
use App\Models\Inventario;
use App\Models\Salida;
use Illuminate\Http\Request;

class IngresosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingresos = Ingreso::with('productoFk')->with('User')->get();
        return view('ingresos.index', compact('ingresos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function new($producto)
    {
        $producto = Inventario::with('ProductoFk')->find($producto);
        return view('ingresos.create', compact('producto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateIngresoRequest $request)
    {
        Ingreso::create($request->validated());
        $isTheProductInInventory = Inventario::where('producto_id', $request->producto_id)->get();
        $iventario = Inventario::find($isTheProductInInventory[0]['id']);
        $iventario->cantidad =  $isTheProductInInventory[0]['cantidad'] + $request->cantidad;
        $iventario->update();

        return redirect()->to('admin/inventarios')->with('message', 'Ingreso creado exitosamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ingresos = Ingreso::with('ProductoFk')->find($id);
        return view('ingresos.edit', compact('ingresos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "cantidad" => "required",
            "observaciones" => ""
        ]);
        $ingreso = Ingreso::find($id);

        $ingresoInInventary = Inventario::where('producto_id', $ingreso->producto_id)->get();
        $inventario = Inventario::find($ingresoInInventary[0]['id']);
        $inventario->cantidad = $inventario->cantidad - $ingreso->cantidad;
        $inventario->update();

        $ingreso->cantidad =  $request->cantidad;
        $ingreso->observaciones = $request->observaciones;
        $ingreso->update();

        $inventario->cantidad = $inventario->cantidad + $request->cantidad;
        $inventario->update();

        return redirect()->to('admin/ingresos')->with('message', 'Ingreso actualizado exitosamente');
    }


}
