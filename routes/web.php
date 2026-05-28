<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\GestionAcademicaController;
use App\Http\Controllers\RequisitoController;

// ===== RUTAS PÚBLICAS (Guest) =====
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect('/login');
    });

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    // Password Recovery Routes
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetCode'])->name('password.email');
    Route::get('/verify-code', [ForgotPasswordController::class, 'showVerifyCodeForm'])->name('password.verify');
    Route::post('/verify-code', [ForgotPasswordController::class, 'verifyCode'])->name('password.verify.submit');
    Route::get('/reset-password', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');
});

// ===== RUTAS PROTEGIDAS (Autenticado) =====
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Infraestructura y Seguridad (API)
    Route::resource('personas', PersonaController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('roles', RolController::class);
    Route::get('bitacoras', [BitacoraController::class, 'index']);
    Route::get('bitacoras/{bitacora}', [BitacoraController::class, 'show']);

    // Configuración Académica Base
    Route::resource('carreras', CarreraController::class);
    Route::resource('materias', MateriaController::class);
    Route::resource('aulas', AulaController::class);

    // Planificación de Periodos y Control Documental
    Route::resource('gestiones', GestionAcademicaController::class);
    Route::patch('requisitos/{requisito}/status', [RequisitoController::class, 'updateStatus'])->name('requisitos.status');
    Route::resource('requisitos', RequisitoController::class);
});
