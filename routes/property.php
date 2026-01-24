<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;

Route::get('/property/add', [PropertyController::class,'show'])->middleware('auth');
Route::get('/property/getCategory/{any}', [PropertyController::class,'category']);
Route::post('/property/save', [PropertyController::class,'savetoDB'])->middleware('auth');


Route::get('/p/{a}/{b}', [PropertyController::class,'viewProperty']);