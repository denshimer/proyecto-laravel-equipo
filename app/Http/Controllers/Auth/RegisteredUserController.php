<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validaciones Generales
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:student,teacher'], // Solo permitimos estos dos valores

            // Validaciones Condicionales
            // El RU debe ser único solo si no es nulo
            'university_code' => ['nullable', 'string', 'unique:students,university_code'],
        ]);

        // 2. Iniciar Transacción (Todo o nada)
        DB::transaction(function () use ($request) {

            // A. Crear el Usuario Base
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'profile_type' => $request->role,
                'is_active' => true,
            ]);

            // B. Crear el Perfil Específico
            if ($request->role === 'student') {

                // Asignar Rol Spatie
                $user->assignRole('estudiante');

                // Crear Registro en tabla 'students'
                $user->student()->create([
                    'university_code' => $request->university_code, // Puede ser null (Externo)
                    'semester' => $request->semester,
                ]);
            } elseif ($request->role === 'teacher') {

                // Asignar Rol Spatie
                $user->assignRole('docente');

                // Crear Registro en tabla 'teachers'
                $user->teacher()->create([
                    'academic_degree' => $request->academic_degree ?? 'Ing.',
                    'specialty' => $request->specialty,
                    'phone' => $request->phone,
                ]);
            }

            // C. Disparar evento de registro
            event(new Registered($user));

            // D. Loguear al usuario automáticamente
            Auth::login($user);
        });

        // 3. Redirigir al Dashboard
        // (Laravel 11 usa la ruta 'dashboard' por defecto, o RouteServiceProvider::HOME)
        return redirect(route('dashboard', absolute: false));
    }
}
