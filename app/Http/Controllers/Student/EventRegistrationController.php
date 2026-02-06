<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\EventRegistration;
use Illuminate\Http\Request;

class EventRegistrationController extends Controller
{
    public function index()
    {
        $events = Post::whereHas('contentType', fn($q) => $q->where('key', 'event'))
            ->where('is_published', true)
            ->whereDoesntHave('registrations', fn($q) => $q->where('user_id', auth()->id()))
            ->with(['eventDetails', 'author'])
            ->withCount('registrations')
            ->latest()
            ->paginate(12);
        
        return view('student.events.index', compact('events'));
    }
    
    public function myRegistrations()
    {
        $registrations = EventRegistration::where('user_id', auth()->id())
            ->with(['post.eventDetails', 'post.author'])
            ->latest()
            ->paginate(10);
        
        return view('student.registrations.index', compact('registrations'));
    }
    
    public function register(Post $event)
    {
        // Verificar que el evento esté publicado
        if (!$event->is_published) {
            return back()->with('error', 'Este evento no está disponible para inscripción.');
        }
        
        // Verificar si ya está inscrito
        $existingRegistration = EventRegistration::where('user_id', auth()->id())
            ->where('post_id', $event->id)
            ->first();
        
        if ($existingRegistration) {
            return back()->with('error', 'Ya estás inscrito en este evento.');
        }
        
        // Verificar cupo máximo
        $event->load('eventDetails', 'registrations');
        if ($event->eventDetails && $event->eventDetails->max_attendees) {
            if ($event->registrations->count() >= $event->eventDetails->max_attendees) {
                return back()->with('error', 'Este evento ha alcanzado su cupo máximo.');
            }
        }
        
        // Crear inscripción
        EventRegistration::create([
            'user_id' => auth()->id(),
            'post_id' => $event->id,
            'status' => 'confirmed',
        ]);
        
        return back()->with('success', '¡Te has inscrito exitosamente al evento!');
    }
    
    public function cancel(EventRegistration $registration)
    {
        // Verificar que la inscripción pertenece al usuario
        if ($registration->user_id !== auth()->id()) {
            abort(403);
        }
        
        $registration->update(['status' => 'cancelled']);
        
        return back()->with('success', 'Inscripción cancelada exitosamente.');
    }
}
