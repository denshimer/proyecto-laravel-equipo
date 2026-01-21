<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->word();
        
        return [
            'name' => ucfirst($name), // Primera letra mayúscula
            'slug' => Str::slug($name) . '-' . rand(1, 1000), // Slug único
            'color' => $this->faker->hexColor(), // Un color al azar (ej: #a3c4f3)
        ];
    }
}