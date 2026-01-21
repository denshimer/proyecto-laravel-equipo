<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Crear los Tipos de Contenido (Si no lo hiciste antes)
    $this->call(ContentTypeSeeder::class);

    // 2. Crear un Usuario Admin (Para que puedas loguearte tú)
    \App\Models\User::factory()->create([
        'name' => 'Admin User',
        'email' => 'admin@admin.com',
        'password' => bcrypt('password'), // La contraseña es 'password'
    ]);

    // 3. Crear 10 Noticias
    \App\Models\Post::factory(10)->create([
        'content_type_id' => 1 // Fuerza que sean noticias
    ]);

    // 4. Crear 5 Eventos con sus Detalles
    $eventos = \App\Models\Post::factory(5)->event()->create();

    // Por cada evento creado, creamos sus detalles (Fecha, Lugar)
    foreach ($eventos as $evento) {
        \App\Models\EventDetail::create([
            'post_id' => $evento->id,
            'start_date' => now()->addDays(rand(1, 30)), // Será en los próximos 30 días
            'end_date' => now()->addDays(rand(1, 30))->addHours(2),
            'location' => 'Sala de Conferencias ' . rand(1, 5),
            'max_attendees' => 50,
        ]);
    }
    }
}
