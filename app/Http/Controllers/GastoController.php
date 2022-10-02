<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGastoRequest;
use App\Http\Requests\UpdateGastoRequest;
use App\Models\Gasto;
use Illuminate\Http\Request;

class GastoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gastos = Gasto::with('User')->get();
        return view('gastos.index', compact('gastos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gastos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGastoRequest $request, Gasto $gasto)
    {
        $request->validated();

        $gasto->gasto = $request->gasto;
        $gasto->valor = $request->valor;
        $gasto->fecha = date('Y-m-d');
        $gasto->user_id = $request->user_id;
        $gasto->save();
        return redirect()->to('admin/gastos')->with('message', 'Gasto creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gasto = Gasto::find($id);
        return view('gastos.show', compact('gasto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gasto = Gasto::find($id);
        return view('gastos.edit', compact('gasto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGastoRequest $request, Gasto $gasto)
    {
        $gasto->update($request->validated());
        return redirect()->to('admin/gastos')->with('message', 'Gasto actualizado exitosamente');
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
