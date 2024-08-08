<?php

use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\PaymentController;
use App\Http\Middleware\SessionRequestMiddleware;

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

Route::middleware(['payment'])->group(function(){
    Route::get('/success/{uid}', [PaymentController::class,'success']);
    Route::post('/pay', [PaymentController::class, 'pay'])->name('pay');
    Route::post('/payreq', [PaymentController::class, 'payreq']);
});

Route::withoutMiddleware(['web'])->group(function(){
    Route::post('/register', [LoginController::class, 'register']);
    Route::post('/users', [UsersController::class, 'register']);
});


