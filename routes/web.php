<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

// Ruta HOME (pública, muestra welcome)
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Ruta /home (autenticados, muestra welcome con sidebar)
Route::get('/home', [WelcomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');

// ==========================================
// RUTAS PÚBLICAS
// ==========================================
// Página About
Route::get('/about', [WelcomeController::class, 'about'])->name('about');

// Página de Eventos
Route::get('/events', [WelcomeController::class, 'events'])->name('events');
Route::get('/events/{post}', [WelcomeController::class, 'showEvent'])->name('events.show');

// Página de Publicaciones
Route::get('/publications', [WelcomeController::class, 'publications'])->name('publications');
Route::get('/publications/{post}', [WelcomeController::class, 'showPublication'])->name('publications.show');

// Dashboard genérico (redirección automática según rol)
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ==========================================
// RUTAS DE ADMIN/DEV
// ==========================================
Route::middleware(['auth', 'verified', 'role:admin|dev'])->prefix('admin')->name('admin.')->group(function () {
    
    // Papelera de Usuarios (ANTES del resource route para evitar conflicto)
    Route::get('users/trash', [\App\Http\Controllers\Admin\UserController::class, 'trash'])->name('users.trash');
    Route::post('users/{id}/restore', [\App\Http\Controllers\Admin\UserController::class, 'restore'])->name('users.restore');
    Route::delete('users/{id}/force-delete', [\App\Http\Controllers\Admin\UserController::class, 'forceDelete'])->name('users.force-delete');
    
    // Gestión de Usuarios
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::post('users/{user}/toggle-status', [\App\Http\Controllers\Admin\UserController::class, 'toggleStatus'])
        ->name('users.toggle-status');
    
    // Papelera de Publicaciones (ANTES del resource route para evitar conflicto)
    Route::get('posts/trash', [\App\Http\Controllers\Admin\PostController::class, 'trash'])->name('posts.trash');
    Route::post('posts/{id}/restore', [\App\Http\Controllers\Admin\PostController::class, 'restore'])->name('posts.restore');
    Route::delete('posts/{id}/force-delete', [\App\Http\Controllers\Admin\PostController::class, 'forceDelete'])->name('posts.force-delete');
    
    // Gestión de Publicaciones (Noticias y Eventos unificados)
    Route::resource('posts', PostController::class);
    Route::post('posts/{post}/toggle-publish', [PostController::class, 'togglePublish'])
        ->name('posts.toggle-publish');

    // Gestión de solicitudes de rol
    Route::get('role-requests', [\App\Http\Controllers\Admin\RoleRequestController::class, 'index'])
        ->name('role-requests.index');
    Route::get('role-requests/{roleRequest}', [\App\Http\Controllers\Admin\RoleRequestController::class, 'show'])
        ->name('role-requests.show');
    Route::post('role-requests/{roleRequest}/approve', [\App\Http\Controllers\Admin\RoleRequestController::class, 'approve'])
        ->name('role-requests.approve');
    Route::post('role-requests/{roleRequest}/reject', [\App\Http\Controllers\Admin\RoleRequestController::class, 'reject'])
        ->name('role-requests.reject');
});

// ==========================================
// RUTAS DE DOCENTE
// ==========================================
Route::middleware(['auth', 'verified', 'role:docente|admin|dev'])->prefix('teacher')->name('teacher.')->group(function () {
    
    // Gestión de Eventos Propios
    Route::resource('events', \App\Http\Controllers\Teacher\TeacherEventController::class);
    Route::get('events/{event}/registrations', [\App\Http\Controllers\Teacher\TeacherEventController::class, 'registrations'])
        ->name('events.registrations');
    Route::post('events/{event}/toggle-publish', [\App\Http\Controllers\Teacher\TeacherEventController::class, 'togglePublish'])
        ->name('events.toggle-publish');
});

// ==========================================
// RUTAS DE ESTUDIANTE
// ==========================================
Route::middleware(['auth', 'verified', 'role:estudiante|docente|admin|dev'])->prefix('student')->name('student.')->group(function () {
    
    // Ver eventos disponibles
    Route::get('events', [\App\Http\Controllers\Student\EventRegistrationController::class, 'index'])
        ->name('events.index');
    
    // Mis inscripciones
    Route::get('my-registrations', [\App\Http\Controllers\Student\EventRegistrationController::class, 'myRegistrations'])
        ->name('registrations.index');
    
    // Inscribirse a evento
    Route::post('events/{event}/register', [\App\Http\Controllers\Student\EventRegistrationController::class, 'register'])
        ->name('events.register');
    
    // Cancelar inscripción
    Route::delete('registrations/{registration}/cancel', [\App\Http\Controllers\Student\EventRegistrationController::class, 'cancel'])
        ->name('registrations.cancel');
    
    // Solicitar rol de docente (solo estudiantes)
    Route::middleware('role:estudiante')->group(function () {
        Route::get('request-teacher-role', [\App\Http\Controllers\Student\RoleRequestController::class, 'create'])
            ->name('role-request.create');
        Route::post('request-teacher-role', [\App\Http\Controllers\Student\RoleRequestController::class, 'store'])
            ->name('role-request.store');
        Route::get('role-request-status', [\App\Http\Controllers\Student\RoleRequestController::class, 'show'])
            ->name('role-request.show');
        Route::get('complete-teacher-profile', [\App\Http\Controllers\Student\RoleRequestController::class, 'completeProfile'])
            ->name('role-request.complete');
        Route::post('complete-teacher-profile', [\App\Http\Controllers\Student\RoleRequestController::class, 'storeProfile'])
            ->name('role-request.store-profile');
    });
});

// Perfil de Usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
