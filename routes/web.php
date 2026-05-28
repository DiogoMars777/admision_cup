<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
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
    Route::apiResource('personas', PersonaController::class);
    Route::apiResource('usuarios', UsuarioController::class);
    Route::apiResource('roles', RolController::class);
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
