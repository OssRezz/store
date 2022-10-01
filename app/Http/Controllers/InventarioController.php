<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInventarioRequest;
use App\Http\Requests\UpdateInventarioRequest;
use App\Models\Inventario;
use App\Models\Producto;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventario = Inventario::with('ProductoFk')->get();
        return view('inventario.index', compact('inventario'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = Producto::all();
        return view('inventario.create', compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateInventarioRequest $request)
    {;
        $request->validated();
        $isTheProductInInventory = Inventario::where('producto_id', $request->producto_id)->get();
        if (count($isTheProductInInventory) > 0) {
            $iventario = Inventario::find($isTheProductInInventory[0]['id']);
            $iventario->cantidad =  $request->cantidad + $isTheProductInInventory[0]['cantidad'];
            $iventario->update();
            return redirect()->to('admin/inventarios')->with('message', 'El iventario se ha actualizado exitosamente');
        } else {
            Inventario::create($request->validated());
            return redirect()->to('admin/inventarios')->with('message', 'El producto se ha agregado al inventario exitosamente');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inventario = Inventario::with('ProductoFk')->find($id);
        return view('inventario.show', compact('inventario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inventario = Inventario::with('ProductoFk')->find($id);
        return view('inventario.edit', compact('inventario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInventarioRequest $request, Inventario $inventario)
    {

        $inventario->update($request->validated());
        return redirect()->to('admin/inventarios')->with('message', 'El inventario se ha actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
