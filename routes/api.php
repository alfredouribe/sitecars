<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('get_clientes',['App\Http\Controllers\api', 'get_clientes'])->name('get_clientes');
Route::post('save_cliente',['App\Http\Controllers\api', 'save_cliente'])->name('save_cliente');
Route::post('cambiar_status_cliente',['App\Http\Controllers\api', 'cambiar_status_cliente'])->name('cambiar_status_cliente');
Route::post('get_cliente',['App\Http\Controllers\api', 'get_cliente'])->name('get_cliente');
Route::post('get_usuarios_cliente',['App\Http\Controllers\api', 'get_usuarios_cliente'])->name('get_usuarios_cliente');
Route::post('save_usuario_cliente',['App\Http\Controllers\api', 'save_usuario_cliente'])->name('save_usuario_cliente');
Route::post('cambia_status_usuario_cliente',['App\Http\Controllers\api', 'cambia_status_usuario_cliente'])->name('cambia_status_usuario_cliente');
Route::post('get_pacientes',['App\Http\Controllers\api', 'get_pacientes'])->name('get_pacientes');
Route::post('save_paciente',['App\Http\Controllers\api', 'save_paciente'])->name('save_paciente');
//cambia_status_usuario_cliente