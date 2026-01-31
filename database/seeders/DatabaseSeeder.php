<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use App\Models\Publication;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear Usuario Admin
        User::create([
            'name' => 'Admin SICI',
            'email' => 'admin@sici.com',
            'password' => Hash::make('password'),
        ]);

        // 2. Crear Publicaciones
        Publication::create([
            'title' => 'Modernización Curricular: El futuro',
            'slug' => 'modernizacion-curricular',
            'excerpt' => 'Analizamos los cambios propuestos para la malla 2026 e IA.',
            'content' => 'Contenido completo del articulo sobre la nueva malla...',
            'image_path' => 'images/card-1.jpg',
            'published_at' => '2026-02-17',
            'is_published' => true
        ]);

        Publication::create([
            'title' => 'Proyectos de Grado Exitosos',
            'slug' => 'proyectos-grado',
            'excerpt' => 'Conoce los mejores proyectos defendidos este semestre.',
            'content' => 'Detalle de los proyectos destacados...',
            'image_path' => 'images/card-3.jpg',
            'published_at' => '2026-02-10',
            'is_published' => true
        ]);
        
        // Noticias de relleno (Manuales, para evitar el error de Factory)
        Publication::create([
            'title' => 'Inscripciones abiertas gestión 2026',
            'slug' => 'inscripciones-2026',
            'excerpt' => 'Todo lo que necesitas saber para inscribirte este semestre.',
            'content' => 'Pasos para la inscripción...',
            'image_path' => 'images/card-2.jpg',
            'published_at' => '2026-01-20',
            'is_published' => true
        ]);

        Publication::create([
            'title' => 'Nuevo laboratorio de Redes',
            'slug' => 'lab-redes',
            'excerpt' => 'Inauguración del bloque C con equipos Cisco.',
            'content' => 'Detalles de los equipos...',
            'image_path' => 'images/card-2.jpg',
            'published_at' => '2026-01-15',
            'is_published' => true
        ]);

        // 3. Crear Eventos
        Event::create([
            'title' => 'Bootcamp Frontend',
            'slug' => 'bootcamp-frontend',
            'description' => 'Aprende React y Laravel en tiempo récord.',
            'image_path' => 'images/card.jpeg',
            'event_date' => '2026-02-16 09:00:00',
            'location' => 'Laboratorio 4',
            'type' => 'Taller'
        ]);

        Event::create([
            'title' => 'ISI Challenge: Hackathon',
            'slug' => 'isi-challenge',
            'description' => 'Competencia de desarrollo de 48 horas.',
            'image_path' => 'images/card.jpeg',
            'event_date' => '2026-03-05 08:00:00',
            'location' => 'Auditorio Principal',
            'type' => 'Competencia'
        ]);
        
        Event::create([
            'title' => 'Conferencia IA Generativa',
            'slug' => 'ia-conf',
            'description' => 'El impacto de GPT-5 en la industria.',
            'image_path' => 'images/card.jpeg',
            'event_date' => '2026-04-10 18:00:00',
            'location' => 'Paraninfo',
            'type' => 'Conferencia'
        ]);
    }
}