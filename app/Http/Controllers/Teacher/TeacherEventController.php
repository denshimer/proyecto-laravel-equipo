<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\ContentType;
use App\Models\EventDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeacherEventController extends Controller
{
    public function index()
    {
        $events = Post::where('user_id', auth()->id())
            ->whereHas('contentType', fn($q) => $q->where('key', 'event'))
            ->with(['eventDetails', 'registrations', 'category'])
            ->withCount('registrations')
            ->latest()
            ->paginate(10);
        
        return view('teacher.events.index', compact('events'));
    }
    
    public function create()
    {
        $categories = Category::all();
        return view('teacher.events.create', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'excerpt' => 'nullable|string|max:500',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string|max:255',
            'max_attendees' => 'nullable|integer|min:0',
            'external_registration_link' => 'nullable|url|max:500',
        ], [
            'title.required' => 'El título es obligatorio.',
            'title.max' => 'El título no puede exceder 255 caracteres.',
            'body.required' => 'El contenido es obligatorio.',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.mimes' => 'La imagen debe ser de tipo: jpeg, jpg, png o webp.',
            'image.max' => 'La imagen no puede exceder 2MB.',
            'start_date.required' => 'La fecha de inicio es obligatoria.',
            'end_date.required' => 'La fecha de fin es obligatoria.',
            'end_date.after' => 'La fecha de fin debe ser posterior a la fecha de inicio.',
            'location.required' => 'La ubicación es obligatoria.',
            'max_attendees.min' => 'El cupo máximo debe ser 0 o mayor (0 = ilimitado).',
            'external_registration_link.url' => 'El enlace debe ser una URL válida.',
        ]);
        
        $contentType = ContentType::where('key', 'event')->first();
        
        // Manejar imagen
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        } else {
            $imagePath = 'posts/default.jpg';
        }
        
        $event = Post::create([
            'user_id' => auth()->id(),
            'content_type_id' => $contentType->id,
            'category_id' => $validated['category_id'] ?? 1,
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . time(),
            'excerpt' => $validated['excerpt'] ?? '',
            'body' => $validated['body'],
            'image_path' => $imagePath,
            'is_published' => false, // Docentes crean en borrador
        ]);
        
        $event->eventDetails()->create([
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'location' => $validated['location'],
            'max_attendees' => $validated['max_attendees'] ?? 0,
            'external_registration_link' => $validated['external_registration_link'] ?? '',
        ]);
        
        return redirect()->route('teacher.events.index')
            ->with('success', 'Evento creado exitosamente. Un administrador debe aprobarlo antes de publicarse.');
    }
    
    public function edit(Post $event)
    {
        // Verificar que el evento pertenece al docente
        if ($event->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para editar este evento.');
        }
        
        $event->load('eventDetails');
        $categories = Category::all();
        return view('teacher.events.edit', compact('event', 'categories'));
    }
    
    public function update(Request $request, Post $event)
    {
        // Verificar propiedad
        if ($event->user_id !== auth()->id()) {
            abort(403);
        }
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'excerpt' => 'nullable|string|max:500',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string|max:255',
            'max_attendees' => 'nullable|integer|min:0',
            'external_registration_link' => 'nullable|url|max:500',
        ], [
            'title.required' => 'El título es obligatorio.',
            'body.required' => 'El contenido es obligatorio.',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.mimes' => 'La imagen debe ser de tipo: jpeg, jpg, png o webp.',
            'image.max' => 'La imagen no puede exceder 2MB.',
            'start_date.required' => 'La fecha de inicio es obligatoria.',
            'end_date.after' => 'La fecha de fin debe ser posterior a la fecha de inicio.',
            'location.required' => 'La ubicación es obligatoria.',
        ]);
        
        // Manejar upload de imagen
        $updateData = [
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . time(),
            'category_id' => $validated['category_id'] ?? 1,
            'excerpt' => $validated['excerpt'] ?? '',
            'body' => $validated['body'],
        ];
        
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si no es default
            if ($event->image_path && $event->image_path !== 'posts/default.jpg') {
                \Storage::disk('public')->delete($event->image_path);
            }
            $updateData['image_path'] = $request->file('image')->store('posts', 'public');
        }
        
        $event->update($updateData);
        
        $event->eventDetails()->updateOrCreate(
            ['post_id' => $event->id],
            [
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'location' => $validated['location'],
                'max_attendees' => $validated['max_attendees'] ?? 0,
                'external_registration_link' => $validated['external_registration_link'] ?? '',
            ]
        );
        
        return redirect()->route('teacher.events.index')
            ->with('success', 'Evento actualizado exitosamente.');
    }
    
    public function destroy(Post $event)
    {
        if ($event->user_id !== auth()->id()) {
            abort(403);
        }
        
        // Eliminar imagen si no es default
        if ($event->image_path && $event->image_path !== 'posts/default.jpg') {
            \Storage::disk('public')->delete($event->image_path);
        }
        
        $event->delete();
        
        return redirect()->route('teacher.events.index')
            ->with('success', 'Evento eliminado exitosamente.');
    }
    
    public function registrations(Post $event)
    {
        if ($event->user_id !== auth()->id()) {
            abort(403);
        }
        
        $event->load(['registrations.user.student']);
        
        return view('teacher.events.registrations', compact('event'));
    }
    
    public function togglePublish(Post $event)
    {
        if ($event->user_id !== auth()->id()) {
            abort(403);
        }
        
        $event->update(['is_published' => !$event->is_published]);
        
        return back()->with('success', 'Estado de publicación actualizado.');
    }
}
