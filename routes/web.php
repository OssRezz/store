<?php

use App\Http\Controllers\CompraController;
use App\Http\Controllers\DetalleCompraController;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\HomeController;
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
    Route::get('salidas/edit/{id}', [SalidaController::class, 'edit']);
    Route::get('salidas/{producto}', [SalidaController::class, 'new']);
    Route::post('salidas/store', [SalidaController::class, 'store']);

    Route::get('reportes', [ReporteController::class, 'index']);
    Route::get('reportes/chartLine', [ReporteController::class, 'chartLine']);
    Route::get('reportes/chartDonaProductos', [ReporteController::class, 'chartDonaProductos']);
    Route::get('reportes/chartDonaStock', [ReporteController::class, 'chartDonaStock']);

    Route::get('home', [HomeController::class, 'index']);
    Route::resource('usuarios', UserController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('compras', CompraController::class);
    Route::resource('ventas', VentaController::class);
    Route::resource('gastos', GastoController::class);
    Route::resource('inventarios', InventarioController::class);
    Route::resource('detalleventa', DetalleVentaController::class);
    Route::resource('detallecompra', DetalleCompraController::class);
});
