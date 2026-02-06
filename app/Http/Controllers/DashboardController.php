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

        // ESTUDIANTES: Redirigir a home (no necesitan dashboard de gestión)
        if ($user->hasRole('estudiante')) {
            return redirect()->route('home');
        }

        // 1. DASHBOARD ADMIN/DEV
        if ($user->hasRole(['admin', 'dev'])) {
            $totalEventos = Post::whereHas('contentType', fn($q) => $q->where('key', 'event'))->count();
            $totalUsuarios = \App\Models\User::count();
            $totalEstudiantes = \App\Models\User::role('estudiante')->count();
            $totalDocentes = \App\Models\User::role('docente')->count();
            $totalInscripciones = EventRegistration::count();
            
            // Eventos recientes
            $eventosRecientes = Post::whereHas('contentType', fn($q) => $q->where('key', 'event'))
                ->with(['author', 'eventDetails'])
                ->latest()
                ->take(5)
                ->get();
            
            return view('dashboard.admin', compact(
                'totalEventos', 
                'totalUsuarios', 
                'totalEstudiantes', 
                'totalDocentes',
                'totalInscripciones',
                'eventosRecientes'
            ));
        }

        // 2. DASHBOARD DOCENTE
        if ($user->hasRole('docente')) {
            $misEventos = Post::where('user_id', $user->id)
                ->whereHas('contentType', fn($q) => $q->where('key', 'event'))
                ->with(['eventDetails', 'registrations'])
                ->withCount('registrations')
                ->latest()
                ->get();

            // Inscripciones recientes a mis eventos
            $inscripcionesRecientes = EventRegistration::whereIn('post_id', $misEventos->pluck('id'))
                ->with(['user', 'post'])
                ->latest()
                ->take(10)
                ->get();

            return view('dashboard.teacher', compact('misEventos', 'inscripcionesRecientes'));
        }

        // Fallback
        return view('dashboard');
    }
}