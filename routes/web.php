<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropertyController;

Route::get('/', [IndexController::class,'index']);
Route::get('/home', [IndexController::class,'index']);
Route::get('/auth/login', [AuthController::class,'formLogin'])->name('login');
Route::post('/auth/check', [AuthController::class,'prosrsslogin']);
Route::post('/auth/signUp', [AuthController::class,'signUp']);

Route::get('/property/add', [PropertyController::class,'show'])->middleware('auth');
Route::get('/property/getCategory/{any}', [PropertyController::class,'category']);

Route::post('/property/save', [PropertyController::class,'savetoDB'])->middleware('auth');