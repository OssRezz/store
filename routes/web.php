<?php

use App\Http\Controllers\CompraController;
use App\Http\Controllers\CuadreController;
use App\Http\Controllers\DetalleCompraController;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IngresosController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentaController;
use App\Models\DetalleVenta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/', [LoginController::class, 'index'])->name('/');
Route::post('login', [LoginController::class, 'iniciarSesion']);
Route::post('user/logout', [LoginController::class, 'logout']);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {

    Route::get('salidas', [SalidaController::class, 'index']);
    Route::get('salidas/create', [SalidaController::class, 'create']);
    Route::get('salidas/edit/{id}', [SalidaController::class, 'edit']);
    Route::get('salidas/{producto}', [SalidaController::class, 'new']);
    Route::post('salidas/store', [SalidaController::class, 'store']);
    Route::put('salidas/update/{salida}', [SalidaController::class, 'update']);

    Route::get('ingresos', [IngresosController::class, 'index']);
    Route::get('ingresos/create', [IngresosController::class, 'create']);
    Route::get('ingresos/edit/{id}', [IngresosController::class, 'edit']);
    Route::get('ingresos/{producto}', [IngresosController::class, 'new']);
    Route::post('ingresos/store', [IngresosController::class, 'store']);
    Route::put('ingresos/update/{salida}', [IngresosController::class, 'update']);

    Route::get('reportes', [ReporteController::class, 'index']);
    Route::get('reportes/chartLine', [ReporteController::class, 'chartLine']);
    Route::get('reportes/chartDonaProductos', [ReporteController::class, 'chartDonaProductos']);
    Route::get('reportes/chartDonaStock', [ReporteController::class, 'chartDonaStock']);

    Route::get('cuadres', [CuadreController::class, 'index']);
    // Route::get('reportes/chartLine', [ReporteController::class, 'chartLine']);
    // Route::get('reportes/chartDonaProductos', [ReporteController::class, 'chartDonaProductos']);
    // Route::get('reportes/chartDonaStock', [ReporteController::class, 'chartDonaStock']);

    Route::resource('ventas', VentaController::class);
    Route::post('ventas/export', [VentaController::class, 'reporteVentas']);
    Route::post('ventas_pago/export', [VentaController::class, 'reporteFormaPago']);

    Route::resource('compras', CompraController::class);
    Route::post('compras/export', [CompraController::class, 'reporteCompras']);


    Route::get('home', [HomeController::class, 'index']);
    Route::resource('usuarios', UserController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('gastos', GastoController::class);
    Route::resource('inventarios', InventarioController::class);
    Route::resource('detalleventa', DetalleVentaController::class);
    Route::resource('detallecompra', DetalleCompraController::class);
});
