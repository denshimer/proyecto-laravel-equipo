<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'content_type_id',
        'title',
        'slug',
        'excerpt',
        'body',
        'image_path',
        'is_featured',
        'is_published'
    ];

    // --- RELACIONES ---

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function contentType(): BelongsTo
    {
        return $this->belongsTo(ContentType::class);
    }

    // Relación normalizada (Solo si es evento tendrá esto)
    public function eventDetails(): HasOne
    {
        return $this->hasOne(EventDetail::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(EventRegistration::class);
    }

    // --- HELPERS (Funciones de ayuda) ---

    // Para saber fácilmente si es un evento: if($post->isEvent())
    public function isEvent(): bool
    {
        // Asumiendo que cargaste la relación 'contentType' o usas el ID directo
        // Una forma segura sin cargar relación: compara con el ID del seeder (usualmente 2)
        // O mejor, cargando la relación:
        return $this->contentType && $this->contentType->key === 'event';
    }

    // --- SCOPES (Para consultas rápidas) ---
    
    // Uso: Post::published()->get();
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    // Uso: Post::featured()->get();
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
