<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 0. LIMPIAR CACHÉ DE PERMISOS (Vital)
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. CREAR DATOS MAESTROS (Tipos y ROLES)
        // Esto debe ir ANTES de crear usuarios
        $this->call([
            ContentTypeSeeder::class,
            RoleManagerSeeder::class, // <--- AQUÍ DEBE ESTAR, AL PRINCIPIO
        ]);

        // 2. Usuarios DE PRUEBA (Fijos)
        // Admin
        $admin = User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'Sistema',
            'email' => 'admin@sistema.com',
            'profile_type' => 'admin',
        ]);
        
        $admin->assignRole('admin'); 

        // Docente de prueba
        User::factory()->docente()->create([
            'first_name' => 'Mario',
            'last_name' => 'Bros',
            'email' => 'docente@sistema.com',
        ]);

        // Estudiante de prueba
        User::factory()->estudiante()->create([
            'first_name' => 'Luigi',
            'last_name' => 'Verde',
            'email' => 'alumno@sistema.com',
        ]);

        // 3. Crear 10 Noticias
        \App\Models\Post::factory(10)->create([
            'content_type_id' => 1 // Fuerza que sean noticias
        ]);

        // 4. Crear 5 Eventos con sus Detalles
        $eventos = \App\Models\Post::factory(5)->event()->create();

        foreach ($eventos as $evento) {
            \App\Models\EventDetail::create([
                'post_id' => $evento->id,
                'start_date' => now()->addDays(rand(1, 30)),
                'end_date' => now()->addDays(rand(1, 30))->addHours(2),
                'location' => 'Sala de Conferencias ' . rand(1, 5),
                'max_attendees' => 50,
            ]);
        }

        // 5. RELLENO MASIVO
        User::factory()->count(10)->docente()->create();
        User::factory()->count(50)->estudiante()->create();
    }
}