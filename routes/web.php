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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/index-back', [App\Http\Controllers\IndexBackController::class, 'index'])->name('index-back');
Route::get('/catalogo-vehiculos', [App\Http\Controllers\CatalogoVehiculoController::class, 'index'])->name('catalogo-vehiculos');