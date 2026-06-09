<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JugadorController;
use App\Http\Controllers\PartidoController;
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\LesionController;
use App\Http\Controllers\TituloController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EstadisticaPartidoController;


// ── Rutas públicas ──────────────────────────────────────────
Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('jugadores', JugadorController::class)->only(['index', 'show']);
Route::resource('partidos', PartidoController::class)->only(['index', 'show']);
Route::resource('titulos', TituloController::class)->only(['index', 'show']);
Route::get('/lesiones', [LesionController::class, 'index'])->name('lesiones.index');
Route::get('/estadisticas', [EstadisticaController::class, 'index'])->name('estadisticas.index');
Route::get('/estadisticas/comparar', [EstadisticaController::class, 'comparar'])->name('estadisticas.comparar');


// ── Rutas de administración (auth + rol admin) ───────────────
Route::middleware(['auth', 'esAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::resource('jugadores', JugadorController::class)->except(['index', 'show']);
    Route::resource('partidos', PartidoController::class)->except(['index', 'show']);
    Route::resource('lesiones', LesionController::class)->except(['index']);
    Route::resource('titulos', TituloController::class)->except(['index', 'show']);
    Route::get('/partidos/{partido}/estadisticas', [EstadisticaPartidoController::class, 'edit']) ->name('admin.estadisticas.edit');
    Route::put('/partidos/{partido}/estadisticas', [EstadisticaPartidoController::class, 'update']) ->name('admin.estadisticas.update');
    
});

require __DIR__.'/auth.php';