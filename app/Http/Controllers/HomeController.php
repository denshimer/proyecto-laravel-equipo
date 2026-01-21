<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Obtener Noticias Destacadas (Solo tipo 'post' y marcadas como featured)
        // Usamos whereHas para filtrar por la relación content_type
        $destacados = Post::whereHas('contentType', function($q) {
            $q->where('key', 'post');
        })
        ->where('is_featured', true)
        ->where('is_published', true)
        ->latest()
        ->take(3)
        ->get();

        // 2. Obtener Próximos Eventos (Ordenados por fecha de inicio)
        $proximosEventos = Post::whereHas('contentType', function($q) {
            $q->where('key', 'event');
        })
        ->where('is_published', true)
        ->with('eventDetails') // Carga rápida de la relación para no hacer 100 consultas
        ->get()
        ->sortBy(function($post) {
            return $post->eventDetails->start_date;
        })
        ->take(4);

        // 3. Enviar todo a la vista 'welcome'
        return view('welcome', compact('destacados', 'proximosEventos'));
    }
}