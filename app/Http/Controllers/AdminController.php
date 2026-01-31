<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Publication;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Métodos para Publicaciones
    public function createPublication()
    {
        return view('admin.publications.create');
    }

    public function storePublication(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'nullable|date',
        ]);

        Publication::create([
            'title' => $request->title,
            'content' => $request->content,
            'is_published' => $request->has('is_published'),
            'published_at' => $request->published_at ?? now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Publicación creada con éxito.');
    }

    public function editPublication(Publication $publication)
    {
        return view('admin.publications.edit', compact('publication'));
    }

    public function updatePublication(Request $request, Publication $publication)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'published_at' => 'nullable|date',
        ]);

        $publication->update([
            'title' => $request->title,
            'content' => $request->content,
            'is_published' => $request->has('is_published'),
            'published_at' => $request->published_at ?? now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Publicación actualizada con éxito.');
    }

    // Métodos para Eventos
    public function createEvent()
    {
        return view('admin.events.create');
    }

    public function storeEvent(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
        ]);

        Event::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Evento creado con éxito.');
    }

    public function editEvent(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function updateEvent(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
        ]);

        $event->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Evento actualizado con éxito.');
    }
}
