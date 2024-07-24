<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

Route::get('/', [IndexController::class, 'index']);
Route::get('/dashboard', [IndexController::class, 'dashboard']);
Route::get('/login', [IndexController::class, 'login']);
Route::get('/test', [LoginController::class, 'test']);
