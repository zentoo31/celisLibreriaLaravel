<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout']);
Route::get('/auth/is-logged', [AuthController::class, 'isLogged']);
Route::get('/user/get-info', [UserController::class, 'getUserInfo']);