<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('roles');
        
        // Filtro por rol
        if ($request->filled('role')) {
            $query->role($request->role);
        }
        
        // Búsqueda por nombre o email
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', "%{$request->search}%")
                  ->orWhere('last_name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
            });
        }
        
        $users = $query->paginate(15);
        $roles = Role::all();
        
        return view('admin.users.index', compact('users', 'roles'));
    }
    
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|exists:roles,name',
            'profile_type' => 'required|in:student,teacher',
            
            // Campos opcionales según el tipo
            'university_code' => 'nullable|string',
            'semester' => 'nullable|integer',
            'academic_degree' => 'nullable|string',
            'specialty' => 'nullable|string',
        ]);
        
        // Crear usuario
        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'profile_type' => $validated['profile_type'],
            'is_active' => true,
        ]);
        
        // Asignar rol
        $user->assignRole($validated['role']);
        
        // Crear perfil según tipo
        if ($validated['profile_type'] === 'student') {
            Student::create([
                'user_id' => $user->id,
                'university_code' => $request->university_code,
                'semester' => $request->semester,
            ]);
        } else {
            Teacher::create([
                'user_id' => $user->id,
                'academic_degree' => $request->academic_degree,
                'specialty' => $request->specialty,
            ]);
        }
        
        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario creado exitosamente.');
    }
    
    public function edit(User $user)
    {
        $user->load(['student', 'teacher', 'roles']);
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }
    
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|exists:roles,name',
            'is_active' => 'boolean',
        ]);
        
        $user->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'is_active' => $request->boolean('is_active'),
        ]);
        
        // Actualizar rol
        $user->syncRoles([$validated['role']]);
        
        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }
    
    public function destroy(User $user)
    {
        // No permitir eliminar al usuario actual
        if ($user->id === auth()->id()) {
            return back()->with('error', 'No puedes eliminar tu propia cuenta.');
        }
        
        $user->delete();
        
        return redirect()->route('admin.users.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }
    
    public function toggleStatus(User $user)
    {
        $user->update(['is_active' => !$user->is_active]);
        
        return back()->with('success', 'Estado del usuario actualizado.');
    }
    
    /**
     * Mostrar usuarios eliminados (papelera)
     */
    public function trash(Request $request)
    {
        $query = User::onlyTrashed()->with('roles');
        
        // Búsqueda en papelera
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', "%{$request->search}%")
                  ->orWhere('last_name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
            });
        }
        
        $users = $query->paginate(15);
        
        return view('admin.users.trash', compact('users'));
    }
    
    /**
     * Restaurar usuario eliminado
     */
    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        
        return redirect()->route('admin.users.trash')
            ->with('success', 'Usuario restaurado exitosamente.');
    }
    
    /**
     * Eliminar permanentemente usuario
     */
    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        
        // No permitir eliminar permanentemente al usuario actual
        if ($user->id === auth()->id()) {
            return back()->with('error', 'No puedes eliminar tu propia cuenta.');
        }
        
        $user->forceDelete();
        
        return redirect()->route('admin.users.trash')
            ->with('success', 'Usuario eliminado permanentemente.');
    }
}
