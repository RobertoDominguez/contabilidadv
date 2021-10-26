<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransaccionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;
use Whoops\RunInterface;

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

Route::get('/test', function () {
    return view('test.test4');
});

Route::get('/', [UserController::class, 'loginView'])->name('login_view')->middleware('guest:web');
Route::post('/login', [UserController::class, 'login'])->name('login')->middleware('guest:web');

Route::middleware(['auth:web',])->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/ventas', [VentaController::class, 'index'])->name('ventas');
    Route::get('ventas/deudas', [VentaController::class, 'deudas'])->name('ventas.deudas');

    Route::get('/venta/nueva', [VentaController::class, 'create'])->name('venta.create');
    Route::post('/venta/nueva', [VentaController::class, 'store'])->name('venta.store');

    Route::get('/venta/pagar/{venta}', [VentaController::class, 'pagar'])->name('venta.pagar');

    Route::get('/venta/editar/{venta}', [VentaController::class, 'edit'])->name('venta.edit');
    Route::post('/venta/editar/{venta}', [VentaController::class, 'update'])->name('venta.update');

    Route::get('/venta/eliminar/{venta}', [VentaController::class, 'destroy'])->name('venta.destroy');

    Route::get('/ventas/registro', [VentaController::class, 'ventas'])->name('ventas.registro');

    Route::get('/caja', [VentaController::class, 'caja'])->name('caja');

    Route::get('/json/ventas/mes', [VentaController::class, 'jsonVentasMes'])->name('json.ventas.mes');


    Route::get('/transacciones', [TransaccionController::class, 'index'])->name('transacciones');

    Route::get('/transaccion/nueva', [TransaccionController::class, 'create'])->name('transaccion.create');
    Route::post('/transaccion/nueva', [TransaccionController::class, 'store'])->name('transaccion.store');

    Route::get('/transaccion/editar/{transaccion}', [TransaccionController::class, 'edit'])->name('transaccion.edit');
    Route::post('/transaccion/editar/{transaccion}', [TransaccionController::class, 'update'])->name('transaccion.update');

    Route::get('/transaccion/eliminar/{transaccion}', [TransaccionController::class, 'destroy'])->name('transaccion.destroy');
});





//admin



Route::prefix('administrador')->group(function () {
    Route::get('/', [AdminController::class, 'loginView'])->name('admin.login_view')->middleware('guest:admin');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login')->middleware('guest:admin');


    Route::middleware(['auth:admin',])->group(function () {

        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

        Route::get('/ventas', [VentaController::class, 'ventasDia'])->name('admin.ventas');

        Route::get('/caja', [VentaController::class, 'cajaAdmin'])->name('admin.caja');

    });
});
