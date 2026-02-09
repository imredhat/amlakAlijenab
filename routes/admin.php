<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdAuth;
use App\Http\Controllers\Admin\Index;

Route::get('/admin', [AdAuth::class,'formLogin'])->name('login');
Route::get('/admin/login', [AdAuth::class,'formLogin'])->name('login');
Route::get('/admin/forget', [AdAuth::class,'forget'])->name('login');
Route::get('/admin/two_step', [AdAuth::class,'two_step']);


Route::post('/admin/checkLogin', [AdAuth::class,'prosrsslogin']);
Route::post('/admin/recover', [AdAuth::class,'recover']);
Route::post('/admin/recover', [AdAuth::class,'recover']);
Route::post('/admin/changepass', [AdAuth::class, 'changepass']);
Route::get('/admin/logout', [AdAuth::class, 'logout']);






Route::get('/admin/dashboard', [Index::class,'dashboard']);
