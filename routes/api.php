<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\PaymentController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::middleware(['web'])->group(function(){
    Route::get('/events',[EventsController::class, 'dashboard']);
    Route::get('/events/{id}',[EventsController::class, 'receipt']);
    Route::post('/events', [EventsController::class,'addEvent']);
    Route::patch('/events', [EventsController::class,'updEvent']);
    Route::delete('/events/{id}', [EventsController::class,'delEvent']);

    Route::get('/login', [LoginController::class, 'login']);
    Route::get('/logout', [LoginController::class, 'logout']);

    Route::get('/users/{id}', [UsersController::class, 'user']);
    Route::patch('/users/{id}', [UsersController::class, 'userUpdate']);

    Route::get('/logs/{id}', [LogsController::class, 'userlogs']);
});

Route::get('/success/{uid}/{eventId}', [PaymentController::class,'success']);
Route::post('/pay', [PaymentController::class, 'pay']);

Route::withoutMiddleware(['web'])->group(function(){
    Route::post('/register', [LoginController::class, 'register'])->withoutMiddleware('web');
    Route::post('/users', [UsersController::class, 'register']);
});


