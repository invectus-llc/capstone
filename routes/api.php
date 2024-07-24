<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EventsController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::get('/events',[EventsController::class, 'dashboard']);
Route::post('/events', [EventsController::class,'addEvent']);
Route::patch('/events', [EventsController::class,'updEvent']);

Route::post('/login', [LoginController::class, 'register']);
Route::get('/login', [LoginController::class, 'login']);

Route::post('/users', [UsersController::class, 'register']);
