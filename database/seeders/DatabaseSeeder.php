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
        // User::factory(10)->create();
        // 1. Crear el rol de Admin
        $role = Role::create(['name' => 'admin']);

        // 2. Crear tu usuario
        $user = User::factory()->create([
            'name' => 'Merid Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        // 3. ¡El momento mágico! Asignar el rol (esto llena la tabla puente)
        $user->assignRole($role);
    }
}
