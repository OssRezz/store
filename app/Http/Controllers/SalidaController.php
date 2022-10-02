<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSalidaRequest;
use App\Models\Inventario;
use App\Models\Salida;
use Illuminate\Http\Request;

class SalidaController extends Controller
{
    public function index()
    {
        $salidas = Salida::with('productoFk')->with('User')->get();
        return view('salidas.index', compact('salidas'));
    }
    public function new($producto)
    {
        $producto = Inventario::with('ProductoFk')->find($producto);
        return view('salidas.create', compact('producto'));
    }

    public function store(CreateSalidaRequest $request)
    {
        Salida::create($request->validated());
        $isTheProductInInventory = Inventario::where('producto_id', $request->producto_id)->get();
        $iventario = Inventario::find($isTheProductInInventory[0]['id']);
        $iventario->cantidad =  $isTheProductInInventory[0]['cantidad'] - $request->cantidad;
        $iventario->update();

        return redirect()->to('admin/inventarios')->with('message', 'Salida creada exitosamente');
    }

    public function edit($id)
    {
        $salida = Salida::with('ProductoFk')->find($id);
        return view('salidas.edit', compact('salida'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "cantidad" => "required",
            "observaciones" => ""
        ]);
        $salida = Salida::find($id);

        $salidaInInventary = Inventario::where('producto_id', $salida->producto_id)->get();
        $inventario = Inventario::find($salidaInInventary[0]['id']);
        $inventario->cantidad = $inventario->cantidad + $salida->cantidad;
        $inventario->update();

        $salida->cantidad =  $request->cantidad;
        $salida->observaciones = $request->observaciones;
        $salida->update();

        $inventario->cantidad = $inventario->cantidad - $request->cantidad;
        $inventario->update();

        return redirect()->to('admin/salidas')->with('message', 'Salida actualizada exitosamente');
    }
}
