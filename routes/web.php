<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\UserMiddleware;

Route::get('/', [IndexController::class, 'index']);
Route::get('/dashboard', [IndexController::class, 'dashboard'])->name('dashboard')->middleware(UserMiddleware::class);
Route::get('/login', [IndexController::class, 'login'])->name('login');
Route::get('/test', [LoginController::class, 'test']);


