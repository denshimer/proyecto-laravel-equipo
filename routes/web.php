<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AdminController;

// Rutas Públicas (Usando el SiteController)
Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/nosotros', [SiteController::class, 'about'])->name('about');
Route::get('/publicaciones', [SiteController::class, 'publications'])->name('publications');
Route::get('/publicaciones/{publication}', [SiteController::class, 'showPublication'])->name('publications.show');
Route::get('/eventos', [SiteController::class, 'events'])->name('events');
Route::get('/eventos/{event}', [SiteController::class, 'showEvent'])->name('events.show');

// Dashboard Protegido
Route::get('/dashboard', [SiteController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rutas de Administración (CRUD)
Route::middleware(['auth', 'verified'])->group(function () {
    // Publicaciones
    Route::get('admin/publications/create', [AdminController::class, 'createPublication'])->name('admin.publications.create');
    Route::post('admin/publications', [AdminController::class, 'storePublication'])->name('admin.publications.store');
    Route::get('admin/publications/{publication}/edit', [AdminController::class, 'editPublication'])->name('admin.publications.edit');
    Route::put('admin/publications/{publication}', [AdminController::class, 'updatePublication'])->name('admin.publications.update');

    // Eventos
    Route::get('admin/events/create', [AdminController::class, 'createEvent'])->name('admin.events.create');
    Route::post('admin/events', [AdminController::class, 'storeEvent'])->name('admin.events.store');
    Route::get('admin/events/{event}/edit', [AdminController::class, 'editEvent'])->name('admin.events.edit');
    Route::put('admin/events/{event}', [AdminController::class, 'updateEvent'])->name('admin.events.update');
});

// Rutas de perfil (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';