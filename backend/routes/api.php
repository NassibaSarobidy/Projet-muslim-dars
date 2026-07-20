<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContenuController;
use App\Http\Controllers\Admin\ContenuController as AdminContenuController;


// Utilisateur connecté
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// =====================
// PARTIE VISITEUR
// =====================

Route::get('/dars', [ContenuController::class, 'dars']);

Route::get('/khoutbas', [ContenuController::class, 'khoutbas']);


// =====================
// AUTHENTIFICATION ADMIN
// =====================

Route::post('/login', [AuthController::class, 'login']);


// =====================
// PARTIE ADMIN PROTEGEE
// =====================

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/admin/contenus', [AdminContenuController::class, 'store']);

});