<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return response()->json([
        'message' => 'API Muslim Dars fonctionne'
    ]);
});

Route::get('/test-audio', function () {
    return response()->file(
        storage_path('app/public/audios/S2Yxeu0QxwZVpugTqVWQ9sdFW3FyPPRErZebPpGT.mp3')
    );
});