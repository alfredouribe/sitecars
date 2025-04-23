<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\AuthController;

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

// Página de login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

// Logout personalizado
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Registro (opcional)
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Recuperación de contraseña (opcional)
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Confirmación de contraseña (opcional)
Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);

// Verificación de correo (opcional)
Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');




Route::middleware(['auth'])->group(function () {
    Route::get('/detalle', [App\Http\Controllers\ClienteController::class, 'cliente'])->name('detalle');
    Route::get('/home', [App\Http\Controllers\IndexBackController::class, 'index'])->name('home');
});



Route::middleware(['auth', 'rol:admin'])->group(function () {
    Route::get('/clientes', [App\Http\Controllers\ClienteController::class, 'index'])->name('clientes');
});

Route::middleware(['auth', 'rol:cliente'])->group(function () {
    Route::get('/c-usuarios', [App\Http\Controllers\ClienteUsuarioController::class, 'index'])->name('index');
    Route::get('/c-pacientes', [App\Http\Controllers\PacienteController::class, 'index'])->name('index');
    Route::get('/paciente', [App\Http\Controllers\PacienteController::class, 'paciente'])->name('paciente');
    Route::post('/carga-imagen-paciente', [App\Http\Controllers\PacienteController::class, 'carga_imagen_paciente'])->name('carga_imagen_paciente');
    Route::get('/c-citas', [App\Http\Controllers\IndexBackController::class, 'citas'])->name('citas');
});

// Route::get('/catalogo-vehiculos', [App\Http\Controllers\CatalogoVehiculoController::class, 'index'])->name('catalogo-vehiculos');