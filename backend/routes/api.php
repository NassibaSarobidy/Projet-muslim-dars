<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContenuController;
use App\Http\Controllers\Admin\ContenuController as AdminContenuController;
use App\Http\Controllers\Admin\ProfileController as ProfileController;


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

    Route::get('/admin/contenus', [AdminContenuController::class, 'index']);

    Route::post('/admin/contenus', [AdminContenuController::class, 'store']);

    Route::put('/admin/contenus/{id}', [AdminContenuController::class, 'update']);

    Route::delete('/admin/contenus/{id}', [AdminContenuController::class, 'destroy']);

     // Profil
    Route::get('/admin/profile', [ProfileController::class, 'show']);
    Route::put('/admin/profile', [ProfileController::class, 'update']);
     Route::put('/admin/profile/password', [ProfileController::class, 'updatePassword']);


});

