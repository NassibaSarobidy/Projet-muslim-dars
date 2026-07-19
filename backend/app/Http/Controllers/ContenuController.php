<?php

namespace App\Http\Controllers;

use App\Models\Contenu;
use Illuminate\Http\Request;

class ContenuController extends Controller
{
    public function dars()
    {
        $dars = Contenu::where('type', 'dars')->get();

        return response()->json($dars);
    }


    public function khoutbas()
    {
        $khoutbas = Contenu::where('type', 'khoutba')->get();

        return response()->json($khoutbas);
    }
}