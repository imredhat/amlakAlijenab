<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class,'index']);
Route::get('/auth/login', [AuthController::class,'formLogin']);
Route::post('/auth/check', [AuthController::class,'prosrsslogin']);
Route::post('/auth/signUp', [AuthController::class,'prosrsslogin']);

