<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContenuController extends Controller
{
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
}
