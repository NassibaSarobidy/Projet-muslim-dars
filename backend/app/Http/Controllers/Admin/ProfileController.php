<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\User;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        return response()->json($request->user());
    }

    public function update(Request $request)
{
    $user = $request->user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => [
            'required',
            'email',
            Rule::unique('users')->ignore($user->id),
        ],
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    $user->save();

    return response()->json([
        'message' => 'Profil mis à jour avec succès.',
        'user' => $user
    ]);
}

    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'password' => 'required|min:8|confirmed',
    ]);

    /** @var \App\Models\User $user */
    $user = Auth::user();

    // Vérifier l'ancien mot de passe
    if (!Hash::check($request->current_password, $user->password)) {
        return response()->json([
            'message' => 'L’ancien mot de passe est incorrect'
        ], 400);
    }

    // Modifier le mot de passe
    
   $user->update([
    'password' => Hash::make($request->password)
]);

    return response()->json([
        'message' => 'Mot de passe modifié avec succès'
    ]);
}
}