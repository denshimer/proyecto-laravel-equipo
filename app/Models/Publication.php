<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <--- ESTA FALTABA
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'excerpt', 'content', 'image_path', 'is_published', 'published_at'];

    protected $casts = [
        'published_at' => 'date',
    ];
}