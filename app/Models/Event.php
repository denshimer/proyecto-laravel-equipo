<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <--- ESTA TAMBIÉN FALTABA
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'image_path', 'event_date', 'location', 'type'];

    protected $casts = [
        'event_date' => 'datetime',
    ];
}