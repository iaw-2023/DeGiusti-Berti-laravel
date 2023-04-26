<?php

use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ReportePedidosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DetallePedidosController;
use App\Http\Controllers\ReporteProductosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/estadisticas', function(){
    return view('estadisticas');
})->middleware('auth')->name('principio');
Route::resource('clientes', ClientesController::class)->middleware('auth');
Route::resource('categorias', CategoriasController::class)->middleware('auth');



Route::resource('rproductos', ReporteProductosController::class)->middleware('auth');
Route::resource('productos', ProductosController::class)->middleware('auth');
Route::resource('pedidos', DetallePedidosController::class)->middleware('auth');
Route::resource('rpedidos', ReportePedidosController::class)->middleware('auth');
// Login
Route::get('/', function () {
    if (Auth::check()) { //Si ya inició sesión y quiere ir a la ruta raíz, se re-direcciona al principio.
        return redirect()->route('principio');
    } else { // Si no, lo forza a iniciar sesión.
        return view('login');
    }
})->name('login');
Route::post('/inicia-sesion', [LoginController::class, 'login'])->name('inicia-sesion');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

