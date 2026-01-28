<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Teacher extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'academic_degree',
        'specialty',
        'item_number',
        'bio',
        'website_url',
        'office_location',
        'phone',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    // Un pequeño helper para mostrar el nombre formal
    // Ej: $teacher->full_title -> "MSc. Juan Perez"
    public function getFullTitleAttribute()
    {
        return $this->academic_degree . ' ' . $this->user->name;
    }
}