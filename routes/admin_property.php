<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdAuth;
use App\Http\Controllers\Admin\AdminProperty;



Route::get('/admin/property/list', [AdminProperty::class,'pList'])->name('admin.property.list');
Route::get('/admin/property/view/{a}', [AdminProperty::class,'pView'])->name('admin.property.view');
Route::post('/admin/property/status/{id}', [AdminProperty::class,'updateStatus'])->name('admin.property.status');


// Route::post('/admin/checkLogin', [AdAuth::class,'prosrsslogin']);



