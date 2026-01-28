<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'profile_type' => 'student', // Default
            'is_active' => true,
        ];
    }

    public function docente(): static
    {
        return $this->state(fn(array $attributes) => ['profile_type' => 'teacher'])
            ->afterCreating(function (User $user) {
                $user->assignRole('docente');
                // Crear su perfil de Teacher
                \App\Models\Teacher::create([
                    'user_id' => $user->id,
                    'academic_degree' => fake()->randomElement(['Ing.', 'MSc.', 'PhD.']),
                    'specialty' => fake()->jobTitle(),
                    'bio' => fake()->paragraph(),
                    'phone' => fake()->phoneNumber(),
                ]);
            });
    }

    // ESTADO: Crear un usuario que SEA ESTUDIANTE automáticamente
    public function estudiante(): static
    {
        return $this->state(fn(array $attributes) => ['profile_type' => 'student'])
            ->afterCreating(function (User $user) {
                $user->assignRole('estudiante');
                // Crear su perfil de Student
                \App\Models\Student::create([
                    'user_id' => $user->id,
                    'university_code' => fake()->unique()->numerify('######'), // Genera 123456
                    'semester' => fake()->numberBetween(1, 10),
                    'academic_status' => 'active',
                ]);
            });
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
