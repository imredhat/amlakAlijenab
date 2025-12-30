<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class,'index']);
Route::get('/login', [AuthController::class,'formLogin']);

Route::post('/check', [AuthController::class,'prosrsslogin']);

