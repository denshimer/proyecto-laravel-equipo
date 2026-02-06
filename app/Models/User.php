<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method bool hasRole(string|array $roles, string $guard = null)
 * @method bool hasAnyRole(string|array $roles, string $guard = null)
 * @method void assignRole(...$roles)
 * @method void removeRole(...$roles)
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */

    
    use HasFactory, Notifiable, HasRoles, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name', // Nuevo
        'last_name',  // Nuevo
        'email',
        'password',
        'profile_type',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    // Helper para obtener el nombre completo
    public function getNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    // Relación: Un usuario escribe muchos posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Relación: Un usuario tiene muchas inscripciones
    public function eventRegistrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    // Relación 1:1 con Student o Teacher
    public function student(): HasOne
    {
        return $this->hasOne(Student::class);
    }

    // Relación 1:1 con Teacher
    public function teacher(): HasOne
    {
        return $this->hasOne(Teacher::class);
    }

    // Helper para obtener el perfil asociado (student o teacher)
    public function getProfileAttribute()
    {
        if ($this->profile_type === 'teacher') {
            return $this->teacher;
        }
        // Por defecto retornamos estudiante si no es docente
        return $this->student;
    }
}
