<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\EventRegistration;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. VISTA PARA EL ADMIN / DEV (Directiva)
        if ($user->hasRole(['admin', 'dev'])) {
            // Datos: Estadísticas generales
            $totalEventos = Post::whereHas('contentType', fn($q) => $q->where('key', 'event'))->count();
            $totalUsuarios = \App\Models\User::count();
            
            return view('dashboard.admin', compact('totalEventos', 'totalUsuarios'));
        }

        // 2. VISTA PARA DOCENTE
        if ($user->hasRole('docente')) {
            // Datos: Solo SUS eventos creados
            $misEventos = Post::where('user_id', $user->id)
                              ->with('eventDetails')
                              ->latest()
                              ->get();

            return view('dashboard.teacher', compact('misEventos'));
        }

        // 3. VISTA PARA ESTUDIANTE (Default)
        // Datos: Eventos a los que se inscribió
        // (Asumimos que existe la relación 'registrations' en User, si no, la creamos luego)
        // Por ahora mandamos un array vacío para que no falle
        $misInscripciones = []; 
        
        return view('dashboard.student', compact('misInscripciones'));
    }
}