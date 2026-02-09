<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;


Route::get('/', [IndexController::class,'index']);
Route::get('/home', [IndexController::class,'index']);
Route::get('/auth/login', [AuthController::class,'formLogin'])->name('login');

Route::post('/auth/check', [AuthController::class,'prosrsslogin']);
Route::post('/auth/signUp', [AuthController::class,'signUp']);
Route::get('/auth/logout', [AuthController::class,'logout']);





require __DIR__.'/user.php';
require __DIR__.'/property.php';

require __DIR__.'/admin.php';
require __DIR__.'/admin_property.php';
