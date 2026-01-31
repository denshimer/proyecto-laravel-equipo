<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContentType extends Model
{
    // Permitimos llenar estos datos (aunque generalmente lo haces por Seeder)
    protected $fillable = ['name', 'key'];

    // Relación: Un tipo de contenido tiene muchos posts
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
