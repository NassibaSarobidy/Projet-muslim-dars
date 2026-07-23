<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ContenuController extends Controller
{
    public function index()
{
    $contenus = Contenu::orderBy('created_at', 'desc')->get();

    return response()->json($contenus);
}


    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'audio' => 'required|file|mimes:mp3,wav,ogg',
            'type' => 'required|in:dars,khoutba'
        ]);

        $audioPath = $request->file('audio')->store('audios', 'public');

        Contenu::create([
            'titre' => $request->titre,
            'audio' => $audioPath,
            'type' => $request->type,
           'user_id' => Auth::id()
        ]);

        return response()->json([
            'message' => 'Contenu ajouté avec succès'
        ]);
    }

    public function update(Request $request, $id)
{
    
    $contenu = Contenu::findOrFail($id);

    $request->validate([
        'titre' => 'required',
        'type' => 'required|in:dars,khoutba',
        'audio' => 'nullable|file|mimes:mp3,wav,ogg'
    ]);

    // Si un nouveau fichier est envoyé
    if ($request->hasFile('audio')) {

        // Supprimer l'ancien fichier
        if (Storage::exists($contenu->audio)) {
            Storage::delete($contenu->audio);
        }

        // Enregistrer le nouveau
        $contenu->audio = $request->file('audio')->store('audios', 'public');
    }

    $contenu->titre = $request->titre;
    $contenu->type = $request->type;

    $contenu->save();

    return response()->json([
        'message' => 'Contenu modifié avec succès',
        'contenu' => $contenu
    ]);
}



    public function destroy($id)
{
        $contenu = Contenu::findOrFail($id);

        if (Storage::exists($contenu->audio)) {
            Storage::delete($contenu->audio);
    }

        $contenu->delete();

        return response()->json([
            'message' => 'Contenu supprimé avec succès'
    ]);
}
}
