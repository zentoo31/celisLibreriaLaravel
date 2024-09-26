<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::post('/user/register', [UserController::class, 'registerUser']);
Route::post('/user/login', [UserController::class, 'loginUser']);
Route::get('/user/get-info', [UserController::class, 'getUserInfo']);