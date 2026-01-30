<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use App\Models\ContentType;
use App\Models\EventDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of posts (all types).
     */
    public function index(Request $request)
    {
        $query = Post::with(['author', 'category', 'contentType']);

        // Filtros
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('is_published', $request->status === 'published');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('type')) {
            $query->where('content_type_id', $request->type);
        }

        $posts = $query->latest()->paginate(15);
        $categories = Category::all();
        $contentTypes = ContentType::all();

        return view('admin.posts.index', compact('posts', 'categories', 'contentTypes'));
    }

    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        $categories = Category::all();
        $contentTypes = ContentType::all();
        return view('admin.posts.create', compact('categories', 'contentTypes'));
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        $isEvent = $request->content_type_id == 2;

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content_type_id' => 'required|exists:content_types,id',
            'category_id' => 'nullable|exists:categories,id',
            'excerpt' => 'nullable|string|max:500',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
            
            // Campos de evento (solo si es evento)
            'start_date' => $isEvent ? 'required|date' : 'nullable|date',
            'end_date' => $isEvent ? 'required|date|after:start_date' : 'nullable|date',
            'location' => $isEvent ? 'required|string|max:255' : 'nullable|string|max:255',
            'max_attendees' => 'nullable|integer|min:0',
            'external_registration_link' => 'nullable|url|max:500',
        ], [
            'title.required' => 'El título es obligatorio.',
            'title.max' => 'El título no puede exceder 255 caracteres.',
            'content_type_id.required' => 'Debe seleccionar un tipo de contenido.',
            'body.required' => 'El contenido es obligatorio.',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.mimes' => 'La imagen debe ser de tipo: jpeg, jpg, png o webp.',
            'image.max' => 'La imagen no puede exceder 2MB.',
            'start_date.required' => 'La fecha de inicio es obligatoria para eventos.',
            'end_date.after' => 'La fecha de fin debe ser posterior a la fecha de inicio.',
            'location.required' => 'La ubicación es obligatoria para eventos.',
            'max_attendees.min' => 'El cupo máximo debe ser 0 o mayor (0 = ilimitado).',
            'external_registration_link.url' => 'El enlace debe ser una URL válida.',
        ]);

        // Asignar autor
        $validated['user_id'] = auth()->id();
        
        // Generar slug único
        $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        
        // Manejar upload de imagen
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $validated['image_path'] = $path;
        } else {
            $validated['image_path'] = 'posts/default.jpg';
        }
        
        // Valores booleanos y defaults
        $validated['is_published'] = $request->has('is_published');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['category_id'] = $validated['category_id'] ?? 1; // Default: General
        $validated['excerpt'] = $validated['excerpt'] ?? '';

        // Crear el post
        $post = Post::create($validated);

        // Si es evento, crear detalles
        if ($isEvent) {
            EventDetail::create([
                'post_id' => $post->id,
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'location' => $validated['location'],
                'max_attendees' => $validated['max_attendees'] ?? 0,
                'external_registration_link' => $validated['external_registration_link'] ?? '',
            ]);
        }

        return redirect()->route('admin.posts.index')
            ->with('success', $isEvent ? 'Evento creado exitosamente.' : 'Noticia creada exitosamente.');
    }

    /**
     * Display the specified post.
     */
    public function show(Post $post)
    {
        $post->load(['author', 'category', 'contentType', 'eventDetails', 'registrations.user']);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit(Post $post)
    {
        $post->load('eventDetails');
        $categories = Category::all();
        $contentTypes = ContentType::all();
        return view('admin.posts.edit', compact('post', 'categories', 'contentTypes'));
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, Post $post)
    {
        $isEvent = $request->content_type_id == 2;

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content_type_id' => 'required|exists:content_types,id',
            'category_id' => 'nullable|exists:categories,id',
            'excerpt' => 'nullable|string|max:500',
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
            
            // Campos de evento
            'start_date' => $isEvent ? 'required|date' : 'nullable|date',
            'end_date' => $isEvent ? 'required|date|after:start_date' : 'nullable|date',
            'location' => $isEvent ? 'required|string|max:255' : 'nullable|string|max:255',
            'max_attendees' => 'nullable|integer|min:0',
            'external_registration_link' => 'nullable|url|max:500',
        ], [
            'title.required' => 'El título es obligatorio.',
            'title.max' => 'El título no puede exceder 255 caracteres.',
            'content_type_id.required' => 'Debe seleccionar un tipo de contenido.',
            'body.required' => 'El contenido es obligatorio.',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.mimes' => 'La imagen debe ser de tipo: jpeg, jpg, png o webp.',
            'image.max' => 'La imagen no puede exceder 2MB.',
            'start_date.required' => 'La fecha de inicio es obligatoria para eventos.',
            'end_date.after' => 'La fecha de fin debe ser posterior a la fecha de inicio.',
            'location.required' => 'La ubicación es obligatoria para eventos.',
            'max_attendees.min' => 'El cupo máximo debe ser 0 o mayor (0 = ilimitado).',
            'external_registration_link.url' => 'El enlace debe ser una URL válida.',
        ]);

        // Actualizar slug si cambió el título
        if ($post->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        }
        
        // Manejar upload de imagen
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si no es default
            if ($post->image_path && $post->image_path !== 'posts/default.jpg') {
                \Storage::disk('public')->delete($post->image_path);
            }
            $path = $request->file('image')->store('posts', 'public');
            $validated['image_path'] = $path;
        }
        
        // Valores booleanos y defaults
        $validated['is_published'] = $request->has('is_published');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['category_id'] = $validated['category_id'] ?? 1;
        $validated['excerpt'] = $validated['excerpt'] ?? '';

        $post->update($validated);

        // Actualizar o crear detalles de evento
        if ($isEvent) {
            $post->eventDetails()->updateOrCreate(
                ['post_id' => $post->id],
                [
                    'start_date' => $validated['start_date'],
                    'end_date' => $validated['end_date'],
                    'location' => $validated['location'],
                    'max_attendees' => $validated['max_attendees'] ?? 0,
                    'external_registration_link' => $validated['external_registration_link'] ?? '',
                ]
            );
        } else {
            // Si cambió de evento a noticia, eliminar detalles
            $post->eventDetails()->delete();
        }

        return redirect()->route('admin.posts.index')
            ->with('success', $isEvent ? 'Evento actualizado exitosamente.' : 'Noticia actualizada exitosamente.');
    }

    /**
     * Toggle publish status.
     */
    public function togglePublish(Post $post)
    {
        $post->update(['is_published' => !$post->is_published]);
        return back()->with('success', 'Estado de publicación actualizado.');
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy(Post $post)
    {
        // Eliminar imagen si existe y no es default
        if ($post->image_path && $post->image_path !== 'posts/default.jpg') {
            \Storage::disk('public')->delete($post->image_path);
        }
        
        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Publicación eliminada exitosamente.');
    }
    
    /**
     * Mostrar publicaciones eliminadas (papelera)
     */
    public function trash(Request $request)
    {
        $query = Post::onlyTrashed()->with(['author', 'category', 'contentType']);
        
        // Búsqueda en papelera
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        
        if ($request->filled('type')) {
            $query->where('content_type_id', $request->type);
        }
        
        $posts = $query->latest('deleted_at')->paginate(15);
        $contentTypes = ContentType::all();
        
        return view('admin.posts.trash', compact('posts', 'contentTypes'));
    }
    
    /**
     * Restaurar publicación eliminada
     */
    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();
        
        return redirect()->route('admin.posts.trash')
            ->with('success', 'Publicación restaurada exitosamente.');
    }
    
    /**
     * Eliminar permanentemente publicación
     */
    public function forceDelete($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        
        // Eliminar imagen si existe
        if ($post->image_url && file_exists(public_path($post->image_url))) {
            unlink(public_path($post->image_url));
        }
        
        $post->forceDelete();
        
        return redirect()->route('admin.posts.trash')
            ->with('success', 'Publicación eliminada permanentemente.');
    }
}

