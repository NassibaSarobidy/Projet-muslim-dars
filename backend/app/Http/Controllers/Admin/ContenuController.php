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

        $audioPath = $request->file('audio')->store('audios');

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
        'type' => 'required|in:dars,khoutba'
    ]);

    $contenu->update([
        'titre' => $request->titre,
        'type' => $request->type
    ]);

    return response()->json([
        'message' => 'Contenu modifié'
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
