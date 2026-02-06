<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reiniciar caché de permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. LISTA DE PERMISOS
        $permissions = [
            'manage system',     // Para el Dev
            'manage content',    // Para la Directiva (Crear noticias, borrar eventos ajenos)
            'create events',     // Para Docentes y Directiva
            'register events',   // Para Estudiantes (con o sin RU)
            'verify users',      // Para validar registros si fuera necesario
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2. CREACIÓN DE ROLES

        // A. DEV (Super Admin)
        $roleDev = Role::firstOrCreate(['name' => 'dev']);
        $roleDev->givePermissionTo(Permission::all());

        // B. ADMIN (Directiva Sociedad)
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleAdmin->givePermissionTo([
            'manage content',
            'create events',
            'verify users',
            'register events' // También pueden inscribirse
        ]);

        // C. DOCENTE
        $roleDocente = Role::firstOrCreate(['name' => 'docente']);
        $roleDocente->givePermissionTo([
            'create events', // Solo los suyos (se valida por Policy, no por permiso)
            'register events'
        ]);

        // D. ESTUDIANTE
        $roleEstudiante = Role::firstOrCreate(['name' => 'estudiante']);
        $roleEstudiante->givePermissionTo([
            'register events'
        ]);
    }
}
