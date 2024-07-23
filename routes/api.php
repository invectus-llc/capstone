<?php

use App\Http\Controllers\EventsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::get('/events',[EventsController::class, 'dashboard']);
Route::post('/events', [EventsController::class,'addEvent']);
Route::post('/login', [LoginController::class, 'register']);
Route::post('/users', [UsersController::class, 'register']);
