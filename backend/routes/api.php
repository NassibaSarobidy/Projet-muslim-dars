<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContenuController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/dars', [ContenuController::class, 'dars']);

Route::get('/khoutbas', [ContenuController::class, 'khoutbas']);
