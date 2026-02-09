<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdAuth;
use App\Http\Controllers\Admin\AdminProperty;



Route::get('/admin/property/list', [AdminProperty::class,'pList'])->name('login');


// Route::post('/admin/checkLogin', [AdAuth::class,'prosrsslogin']);



