<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventRegistration extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'post_id',
        'status', // 'confirmed', 'cancelled', 'attended'
        'notes'
    ];

    // Relación: Una inscripción pertenece a un Usuario
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relación: Una inscripción pertenece a un Post (Evento)
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
