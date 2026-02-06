<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // Noticias destacadas (is_featured = true)
        $destacados = Post::where('is_published', true)
            ->where('is_featured', true)
            ->whereHas('contentType', fn($q) => $q->where('key', 'post'))
            ->with(['category', 'author'])
            ->latest()
            ->take(6)
            ->get();

        // Próximos eventos publicados
        $eventos = Post::where('is_published', true)
            ->whereHas('contentType', fn($q) => $q->where('key', 'event'))
            ->whereHas('eventDetails', function($q) {
                $q->where('start_date', '>=', now());
            })
            ->with(['eventDetails', 'category', 'author'])
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return view('welcome', compact('destacados', 'eventos'));
    }

    public function about()
    {
        // Página estática, no requiere datos
        return view('about');
    }

    public function events()
    {
        // Todos los eventos próximos publicados
        $events = Post::where('is_published', true)
            ->whereHas('contentType', fn($q) => $q->where('key', 'event'))
            ->whereHas('eventDetails', function($q) {
                $q->where('start_date', '>=', now());
            })
            ->with(['eventDetails', 'category', 'author'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('events', compact('events'));
    }

    public function publications()
    {
        // Publicación destacada (la más reciente con is_featured)
        $featured = Post::where('is_published', true)
            ->where('is_featured', true)
            ->whereHas('contentType', fn($q) => $q->where('key', 'post'))
            ->with(['category', 'author'])
            ->latest()
            ->first();

        // Otras publicaciones recientes (excluyendo la destacada)
        $others = Post::where('is_published', true)
            ->whereHas('contentType', fn($q) => $q->where('key', 'post'))
            ->when($featured, fn($q) => $q->where('id', '!=', $featured->id))
            ->with(['category', 'author'])
            ->latest()
            ->take(5)
            ->get();

        return view('publications', compact('featured', 'others'));
    }

    public function showEvent(Post $post)
    {
        // Verificar que sea un evento publicado
        if (!$post->is_published || $post->contentType->key !== 'event') {
            abort(404);
        }

        $post->load(['eventDetails', 'category', 'author']);
        return view('events.show', compact('post'));
    }

    public function showPublication(Post $post)
    {
        // Verificar que sea una publicación publicada
        if (!$post->is_published || $post->contentType->key !== 'post') {
            abort(404);
        }

        $post->load(['category', 'author']);
        return view('publications.show', compact('post'));
    }
}
