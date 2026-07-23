<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContenuController extends Controller
{
    /**
     * Afficher les dars pour les visiteurs
     */
    public function dars()
    {
        $dars = Contenu::where('type', 'dars')
            ->orderBy('created_at', 'desc')
            ->get();

       foreach ($dars as $dar) {
    $dar->audio = url(Storage::url($dar->audio));
}
        return response()->json($dars);
    }


    /**
     * Afficher les khoutbas pour les visiteurs
     */
    public function khoutbas()
    {
        $khoutbas = Contenu::where('type', 'khoutba')
            ->orderBy('created_at', 'desc')
            ->get();

      foreach ($khoutbas as $khoutba) {
    $khoutba->audio = url(Storage::url($khoutba->audio));
}

        return response()->json($khoutbas);
    }
}