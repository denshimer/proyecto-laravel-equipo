<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $user->load(['student', 'teacher']);
        
        return view('profile.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Actualizar perfil de estudiante
        if ($user->profile_type === 'student' && $user->student) {
            $user->student->update([
                'university_code' => $request->input('university_code'),
                'semester' => $request->input('semester'),
                'phone' => $request->input('phone'),
                'birthdate' => $request->input('birthdate'),
            ]);
        } 
        
        // Actualizar perfil de docente
        elseif ($user->profile_type === 'teacher' && $user->teacher) {
            $user->teacher->update([
                'academic_degree' => $request->input('academic_degree'),
                'specialty' => $request->input('specialty'),
                'phone' => $request->input('phone'),
                'bio' => $request->input('bio'),
                'website_url' => $request->input('website_url'),
            ]);
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account (Soft Delete).
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Usar soft delete en lugar de delete permanente
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('success', 'Tu cuenta ha sido desactivada.');
    }
}
