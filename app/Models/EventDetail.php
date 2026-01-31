<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventDetail extends Model
{
    protected $fillable = [
        'post_id',
        'start_date',
        'end_date',
        'location',
        'external_registration_link',
        'max_attendees'
    ];

    // CONVERSIÓN AUTOMÁTICA DE FECHAS
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    // Relación inversa: Pertenece a un Post
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
