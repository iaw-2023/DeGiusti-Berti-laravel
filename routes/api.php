<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/categorias/{id}', 'App\Http\Controllers\CategoriasController@showByAPI');
Route::get('/categorias', 'App\Http\Controllers\CategoriasController@showAllByAPI');

Route::post('/pedidos/crear', 'App\Http\Controllers\ClientesController@storeByAPI')->name('crearPedidoPorApi');
Route::get('/pedidos', 'App\Http\Controllers\ClientesController@showAllByAPI');
Route::get('/pedidos/{id}', 'App\Http\Controllers\ClientesController@showByAPI');
Route::get('/pedidos/email/{email}', 'App\Http\Controllers\ClientesController@showEmailByAPI');

Route::get('/productos/{id}', 'App\Http\Controllers\ProductosController@showByAPI');
Route::get('/productos', 'App\Http\Controllers\ProductosController@showAllByAPI');