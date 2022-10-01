<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductoRequest $request, Producto $producto)
    {
        $request->validated();
        $producto->nombre = $request->nombre;
        $producto->codigo = $request->codigo;
        $producto->precio_venta = $request->precio_venta;
        $producto->precio_compra = $request->precio_compra;
        $producto->utilidad = ($request->precio_venta - $request->precio_compra);
        $producto->stock = $request->stock;
        $producto->save();
        return redirect()->to('admin/productos')->with('message', 'Producto ingresado exitosamente');
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
        return view('productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::find($id);
        return view('productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductoRequest $request, $id)
    {
        $request->validated();
        $isCodigoAlreadyIn = Producto::where('codigo', $request->codigo)->get();
        if (count($isCodigoAlreadyIn) != 0 && $isCodigoAlreadyIn[0]['id'] != $id) {
            return redirect()->back()->with('message', 'El codigo del producto ya existe');
        }
        $producto = Producto::find($id);
        $producto->nombre = $request->nombre;
        $producto->codigo = $request->codigo;
        $producto->precio_venta = $request->precio_venta;
        $producto->precio_compra = $request->precio_compra;
        $producto->utilidad = ($request->precio_venta - $request->precio_compra);
        $producto->estado = $request->estado;
        $producto->stock = $request->stock;
        $producto->update();
        return redirect()->to('admin/productos')->with('message', 'Producto actualizado exitosamente');
    }
}
