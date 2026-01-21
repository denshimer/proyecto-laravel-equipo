<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use App\Models\ContentType;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $title = $this->faker->sentence();
        
        return [
            // Crea un usuario o usa uno existente
            'user_id' => User::factory(), 
            // Crea una categoría al azar
            'category_id' => Category::factory(),
            // Por defecto crea noticias (tipo 1), luego lo sobrescribiremos para eventos
            'content_type_id' => 1, 
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => $this->faker->paragraph(),
            'body' => $this->faker->text(2000), // Texto largo
            'image_path' => null, // O puedes poner una URL de placeholder
            'is_featured' => $this->faker->boolean(20), // 20% de probabilidad de ser destacado
            'is_published' => true,
        ];
    }

    // Estado especial para crear EVENTOS
    public function event()
    {
        return $this->state(function (array $attributes) {
            return [
                'content_type_id' => 2, // ID del tipo Evento
            ];
        });
    }
}
