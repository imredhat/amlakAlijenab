<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/user/myADS', [UserController::class, 'myADS'])->middleware('auth');
Route::get('/user/profile', [UserController::class, 'Profile'])->middleware('auth');


Route::get('/user/update', [UserController::class, 'updateProfile']);
