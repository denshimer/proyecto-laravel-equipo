<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'university_code',
        'semester',
        'phone',
        'address',
        'birthdate',
        'academic_status', // 'active', 'graduated', etc.
    ];

    // Relación inversa: Un estudiante pertenece a un usuario
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}