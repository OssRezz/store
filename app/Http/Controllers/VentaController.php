<?php

namespace App\Http\Controllers;

use App\Exports\FacturaVentaExport;
use App\Exports\ReporteTipoPagosExport;
use App\Models\DetalleVenta;
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $factura = Venta::orderByDesc('id')->take(1)->get();

        $factura = count($factura) == 0 ? 1 : $factura[0]['id'] + 1;
        $inventario = Inventario::join('productos', 'productos.id', '=', 'inventario.producto_id')
            ->select('inventario.*', 'productos.precio_compra', 'productos.precio_venta', 'productos.nombre', 'productos.codigo')
            ->where('cantidad', '>', 0)->get();
        return view('ventas.index', compact('inventario', 'factura'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Venta $venta)
    {
        $venta->user_id = $request->usuario;
        $venta->valor_total = $request->total;
        $venta->fecha = date('Y-m-d');
        $venta->forma_pago = $request->forma_pago;
        $venta->forma_pago_dos = $request->forma_pago_dos;
        $venta->valor_pago_dos = $request->valor_pago_dos;
        $venta->observaciones = $request->observaciones;
        $venta->save();

        $lastId = Venta::orderByDesc('id')->take(1)->get();

        foreach ($request->ventas as $key => $value) {
            $producto = Producto::where('codigo', $value['codigo'])->take(1)->get();
            $detalle = new DetalleVenta();
            $detalle->venta_id =  $lastId[0]['id'];
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
        $numFac = $lastId[0]['id'] + 1;
        return [$inventario, $numFac];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Inventario::join('productos', 'productos.id', '=', 'inventario.producto_id')
            ->select('inventario.*', 'productos.precio_compra', 'productos.precio_venta', 'productos.nombre', 'productos.codigo')
            ->find($id);
        return $producto; //
    }

    public function reporteVentas(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
        ]);

        $ventas = DetalleVenta::join('ventas', 'ventas.id', '=', 'detalle_venta.venta_id')
            ->join('users', 'users.id', '=', 'ventas.user_id')
            ->join('productos', 'productos.id', '=', 'detalle_venta.producto_id')
            ->select(
                'users.name',
                'detalle_venta.venta_id',
                'ventas.fecha',
                'productos.nombre',
                'productos.codigo',
                'detalle_venta.tipo_venta',
                'detalle_venta.cantidad',
                'detalle_venta.descuento',
                'detalle_venta.valor',
                'ventas.valor_total',
                'ventas.observaciones',
            )
            ->orderByDesc('detalle_venta.venta_id')
            ->whereBetween('ventas.fecha', [$request->fecha_inicio, $request->fecha_fin])->get();

        $export = new FacturaVentaExport([$ventas]);

        return Excel::download($export, 'ventas.xlsx');
    }

    public function reporteFormaPago(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
        ]);
        $ventas = Venta::whereBetween('ventas.fecha', [$request->fecha_inicio, $request->fecha_fin])->get();
        $Credito = 0;
        $Efectivo = 0;
        $Transacción = 0;

        foreach ($ventas as $key => $venta) {

            if ($venta->forma_pago_dos == null) {
                if ($venta->forma_pago == "Credito") {
                    $Credito = $Credito + $venta->valor_total;
                } else if ($venta->forma_pago == "Efectivo") {
                    $Efectivo = $Efectivo + $venta->valor_total;
                } else if ($venta->forma_pago == "Transacción") {
                    $Transacción = $Transacción + $venta->valor_total;
                }
            } else {
                if ($venta->forma_pago == "Credito") {
                    $Credito = $Credito + ($venta->valor_total - $venta->valor_pago_dos);
                } else if ($venta->forma_pago == "Efectivo") {
                    $Efectivo = $Efectivo + ($venta->valor_total - $venta->valor_pago_dos);
                } else if ($venta->forma_pago == "Transacción") {
                    $Transacción = $Transacción + ($venta->valor_total - $venta->valor_pago_dos);
                }

                if ($venta->forma_pago_dos == "Credito") {
                    $Credito = $Credito + $venta->valor_pago_dos;
                } else if ($venta->forma_pago_dos == "Efectivo") {
                    $Efectivo = $Efectivo + $venta->valor_pago_dos;
                } else if ($venta->forma_pago_dos == "Transacción") {
                    $Transacción = $Transacción + $venta->valor_pago_dos;
                }
            }
        }


        $export = new ReporteTipoPagosExport([["Transacción" => $Transacción, "Credito" =>  $Credito, "Efectivo" => $Efectivo]]);

        return Excel::download($export, 'forma_pago.xlsx');
    }
}
