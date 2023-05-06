<?php

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\IndexBackController::class, 'index'])->name('index');
Route::get('/index', [App\Http\Controllers\IndexBackController::class, 'index'])->name('index');
Route::get('/clientes', [App\Http\Controllers\ClienteController::class, 'index'])->name('clientes');
Route::get('/detalle', [App\Http\Controllers\ClienteController::class, 'cliente'])->name('detalle');
Route::get('/c-usuarios', [App\Http\Controllers\ClienteUsuarioController::class, 'index'])->name('index');
Route::get('/c-pacientes', [App\Http\Controllers\PacienteController::class, 'index'])->name('index');
Route::get('/paciente', [App\Http\Controllers\PacienteController::class, 'paciente'])->name('paciente');
Route::post('/carga-imagen-paciente', [App\Http\Controllers\PacienteController::class, 'carga_imagen_paciente'])->name('carga_imagen_paciente');
Route::get('/c-citas', [App\Http\Controllers\IndexBackController::class, 'citas'])->name('citas');
// Route::get('/catalogo-vehiculos', [App\Http\Controllers\CatalogoVehiculoController::class, 'index'])->name('catalogo-vehiculos');