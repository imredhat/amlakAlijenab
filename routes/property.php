<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\CatalogController;

Route::get('/property/add', [PropertyController::class,'show'])->middleware('check.auth');
Route::get('/property/getCategory/{any}', [PropertyController::class,'category']);
Route::post('/property/save', [PropertyController::class,'savetoDB'])->middleware('auth');


Route::get('/p/{a}/{b}', [PropertyController::class,'viewProperty']);

Route::get('/get-neighborhoods', [PropertyController::class, 'getNeighborhoods'])->name('get.neighborhoods');










// مسیرهای مربوط به آگهی‌ها
Route::get('/property/edit/{id}', [PropertyController::class, 'edit'])->name('property.edit');
Route::put('/property/update/{id}', [PropertyController::class, 'update'])->name('property.update');
Route::delete('/property/delete/{id}', [PropertyController::class, 'destroy'])->name('property.destroy');



// مسیرهای مربوط به عملیات روی آگهی‌ها
Route::delete('/property/delete/{id}', [PropertyController::class, 'destroy'])->name('property.destroy');
Route::post('/property/toggle-status/{id}', [PropertyController::class, 'toggleStatus'])->name('property.toggle.status');
Route::post('/property/toggle-feature/{id}', [PropertyController::class, 'toggleFeature'])->name('property.toggle.feature');






Route::get('/property/location/{slug}', [CatalogController::class, 'getPropertiesByLocation'])->name('property.location');
Route::get('/property/type/rent', [CatalogController::class, 'getRentProperties'])->name('property.rent');



