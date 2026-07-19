<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContenuController;
use App\Http\Controllers\AuthController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/dars', [ContenuController::class, 'dars']);

Route::get('/khoutbas', [ContenuController::class, 'khoutbas']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/login', function () {
    return view('login');
});