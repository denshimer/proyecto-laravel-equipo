<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoleRequest;
use Illuminate\Http\Request;

class RoleRequestController extends Controller
{
    /**
     * Listar todas las solicitudes
     */
    public function index(Request $request)
    {
        $query = RoleRequest::with(['user', 'reviewer']);

        // Filtros
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $requests = $query->latest()->paginate(15);
        
        $pendingCount = RoleRequest::where('status', 'pending')->count();

        return view('admin.role-requests.index', compact('requests', 'pendingCount'));
    }

    /**
     * Ver detalle de solicitud
     */
    public function show(RoleRequest $roleRequest)
    {
        $roleRequest->load(['user.student', 'reviewer']);
        return view('admin.role-requests.show', compact('roleRequest'));
    }

    /**
     * Aprobar solicitud
     */
    public function approve(RoleRequest $roleRequest)
    {
        if ($roleRequest->status !== 'pending') {
            return back()->with('error', 'Esta solicitud ya fue procesada.');
        }

        $roleRequest->update([
            'status' => 'approved',
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        return back()->with('success', 'Solicitud aprobada. El usuario debe completar su perfil de docente.');
    }

    /**
     * Rechazar solicitud
     */
    public function reject(Request $request, RoleRequest $roleRequest)
    {
        $validated = $request->validate([
            'admin_notes' => 'required|string|max:500',
        ], [
            'admin_notes.required' => 'Debes indicar el motivo del rechazo.',
        ]);

        if ($roleRequest->status !== 'pending') {
            return back()->with('error', 'Esta solicitud ya fue procesada.');
        }

        $roleRequest->update([
            'status' => 'rejected',
            'admin_notes' => $validated['admin_notes'],
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        return back()->with('success', 'Solicitud rechazada.');
    }
}
