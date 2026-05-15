<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminProperty;



Route::prefix('admin')->middleware('web')->group(function () {

    // مسیرهای مربوط به آگهی‌ها
    Route::get('/property/list', [AdminProperty::class, 'pList'])->name('admin.property.list');
    Route::get('/property', [AdminProperty::class, 'pList'])->name('admin.property.index');
    Route::get('/property/view/{id}', [AdminProperty::class, 'pView'])->name('admin.property.view');
    Route::post('/property/status/{id}', [AdminProperty::class, 'updateStatus'])->name('admin.property.updateStatus');

    // Route::get('/property/stats', [AdminProperty::class, 'getStats'])->name('admin.property.stats');

    Route::get('/property/edit/{id}', [AdminProperty::class, 'edit'])->name('admin.property.edit');
    Route::put('/property/update/{id}', [AdminProperty::class, 'update'])->name('admin.property.update');
    Route::delete('/property/delete/{id}', [AdminProperty::class, 'destroy'])->name('admin.property.destroy');
});
