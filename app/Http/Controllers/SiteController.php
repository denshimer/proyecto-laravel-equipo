<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\Event;
use App\Models\User;

class SiteController extends Controller
{
    public function home() {
        $publications = Publication::where('is_published', true)
                                        ->latest('published_at')
                                        ->take(3)
                                        ->get();
        $events = Event::orderBy('event_date', 'asc')->take(3)->get();
        return view('welcome', compact('publications', 'events'));
    }

    public function showPublication(Publication $publication) {
        return view('publications.show', compact('publication'));
    }

    public function showEvent(Event $event) {
        return view('events.show', compact('event'));
    }

    public function about() {
        return view('about');
    }

    public function publications() {
        // Obtiene todas las noticias paginadas
        $publications = Publication::where('is_published', true)
                                   ->latest('published_at')
                                   ->get();

        // Separamos la primera (destacada) del resto
        $featured = $publications->first();
        $others = $publications->skip(1);

        return view('publications', compact('featured', 'others'));
    }

    public function events() {
        $events = Event::orderBy('event_date', 'asc')->get();
        return view('events', compact('events'));
    }

    public function dashboard() {
        // Datos REALES para tu Dashboard
        $stats = [
            'publications' => Publication::count(),
            'events' => Event::count(),
            'users' => User::count(),
        ];

        $recentPosts = Publication::latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recentPosts'));
    }
}