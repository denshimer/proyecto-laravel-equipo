<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Obtener Noticias Destacadas (Solo tipo 'post' y marcadas como featured)
        $destacados = Post::whereHas('contentType', function($q) {
            $q->where('key', 'post');
        })
        ->where('is_featured', true)
        ->where('is_published', true)
        ->with('category')
        ->latest()
        ->take(3)
        ->get();

        // 2. Obtener Próximos Eventos (Ordenados por fecha de inicio)
        $proximosEventos = Post::whereHas('contentType', function($q) {
            $q->where('key', 'event');
        })
        ->where('is_published', true)
        ->with(['eventDetails', 'registrations'])
        ->get()
        ->sortBy(function($post) {
            return $post->eventDetails?->start_date;
        })
        ->take(4);

        // 3. Si el usuario está autenticado, obtener sus inscripciones
        $userRegistrations = [];
        if (auth()->check()) {
            $userRegistrations = \App\Models\EventRegistration::where('user_id', auth()->id())
                ->pluck('post_id')
                ->toArray();
        }

        // 4. Enviar todo a la vista 'welcome'
        return view('welcome', compact('destacados', 'proximosEventos', 'userRegistrations'));
    }
}