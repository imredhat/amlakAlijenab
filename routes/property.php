<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\CatalogController;

Route::middleware('check.auth')->group(function (): void {
    Route::get('/property/add', [PropertyController::class, 'show']);
    Route::get('/property/getCategory/{any}', [PropertyController::class, 'category']);
    Route::post('/property/save', [PropertyController::class, 'savetoDB']);
});


Route::get('/p/{a}/{b}', [PropertyController::class,'viewProperty']);

Route::get('/get-neighborhoods', [PropertyController::class, 'getNeighborhoods'])->name('get.neighborhoods');










// مسیرهای مربوط به آگهی‌ها
Route::get('/property/edit/{id}', [PropertyController::class, 'edit'])->name('property.edit');
Route::put('/property/update/{id}', [PropertyController::class, 'update'])->name('property.update');
Route::delete('/property/delete/{id}', [PropertyController::class, 'destroy'])->name('property.destroy');
Route::get('/property/delete/{id}', [PropertyController::class, 'destroyGet']);



// مسیرهای مربوط به عملیات روی آگهی‌ها
Route::post('/property/toggle-status/{id}', [PropertyController::class, 'toggleStatus'])->name('property.toggle.status');
Route::post('/property/toggle-feature/{id}', [PropertyController::class, 'toggleFeature'])->name('property.toggle.feature');






Route::get('/property/location/{slug}', [CatalogController::class, 'getPropertiesByLocation'])->name('property.location');
Route::get('/city/{slug}', [CatalogController::class, 'getPropertiesByCity'])->name('property.city');
Route::get('/property/type/rent', [CatalogController::class, 'getRentProperties'])->name('property.rent');
Route::get('/property/type/sale', [CatalogController::class, 'getSaleProperties'])->name('property.sale');
Route::get('/property/type/under-100m', [CatalogController::class, 'getUnder100mProperties'])->name('property.under100m');
Route::get('/property/type/above-100m', [CatalogController::class, 'getAbove100mProperties'])->name('property.above100m');
Route::get('/property/type/view-sea', [CatalogController::class, 'getViewSeaProperties'])->name('property.view.sea');
Route::get('/property/type/view-jungle', [CatalogController::class, 'getViewJungleProperties'])->name('property.view.jungle');



