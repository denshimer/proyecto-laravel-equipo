<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\RoleRequest;
use Illuminate\Http\Request;

class RoleRequestController extends Controller
{
    /**
     * Mostrar formulario para solicitar rol de docente
     */
    public function create()
    {
        // Verificar si ya tiene una solicitud pendiente
        $existingRequest = RoleRequest::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->first();

        return view('student.role-request.create', compact('existingRequest'));
    }

    /**
     * Enviar solicitud de rol de docente
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'justification' => 'required|string|min:50|max:1000',
        ], [
            'justification.required' => 'Debes explicar por qué quieres ser docente.',
            'justification.min' => 'La justificación debe tener al menos 50 caracteres.',
            'justification.max' => 'La justificación no puede exceder 1000 caracteres.',
        ]);

        // Verificar que no tenga solicitud pendiente O aprobada sin completar
        $existingPending = RoleRequest::where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existingPending) {
            if ($existingPending->status === 'pending') {
                return back()->with('error', 'Ya tienes una solicitud pendiente de revisión.');
            }
            if ($existingPending->status === 'approved') {
                return redirect()->route('student.role-request.complete')
                    ->with('info', 'Tu solicitud ya fue aprobada. Completa tu perfil de docente.');
            }
        }

        // Crear solicitud
        RoleRequest::create([
            'user_id' => auth()->id(),
            'requested_role' => 'docente',
            'justification' => $validated['justification'],
            'status' => 'pending',
        ]);

        return redirect()->route('home')->with('success', 'Solicitud enviada. Un administrador la revisará pronto.');
    }

    /**
     * Ver estado de mi solicitud
     */
    public function show()
    {
        $request = RoleRequest::where('user_id', auth()->id())
            ->with('reviewer')
            ->latest()
            ->first();

        return view('student.role-request.show', compact('request'));
    }

    /**
     * Completar datos de docente (después de aprobación)
     */
    public function completeProfile()
    {
        $user = auth()->user();

        // Verificar que tiene solicitud aprobada
        $approvedRequest = RoleRequest::where('user_id', $user->id)
            ->where('status', 'approved')
            ->where('requested_role', 'docente')
            ->first();

        if (!$approvedRequest) {
            return redirect()->route('home')->with('error', 'No tienes una solicitud aprobada.');
        }

        // Verificar que no sea docente ya
        if ($user->hasRole('docente')) {
            return redirect()->route('home')->with('info', 'Ya eres docente.');
        }

        return view('student.role-request.complete-profile');
    }

    /**
     * Guardar datos de docente y convertir usuario
     */
    public function storeProfile(Request $request)
    {
        $validated = $request->validate([
            'academic_degree' => 'required|string|max:50',
            'specialty' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ], [
            'academic_degree.required' => 'El grado académico es obligatorio.',
            'specialty.required' => 'La especialidad es obligatoria.',
            'phone.required' => 'El teléfono es obligatorio.',
        ]);

        $user = auth()->user();

        // Verificar solicitud aprobada
        $approvedRequest = RoleRequest::where('user_id', $user->id)
            ->where('status', 'approved')
            ->first();

        if (!$approvedRequest || $user->hasRole('docente')) {
            return redirect()->route('home');
        }

        // Crear perfil de docente
        $user->teacher()->create([
            'academic_degree' => $validated['academic_degree'],
            'specialty' => $validated['specialty'],
            'phone' => $validated['phone'],
        ]);

        // Cambiar rol
        $user->removeRole('estudiante');
        $user->assignRole('docente');
        $user->update(['profile_type' => 'teacher']);

        return redirect()->route('dashboard')->with('success', '¡Felicidades! Ahora eres docente.');
    }
}
