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
}
