<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index']);
Route::get('/dashboard', [IndexController::class, 'dashboard']);
Route::get('/login', [IndexController::class, 'login']);
