<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::prefix('user')->middleware('check.auth')->group(function (): void {
    Route::get('/myADS', [UserController::class, 'myADS']);
    Route::get('/profile', [UserController::class, 'Profile']);
    Route::get('/nardban/{property_id?}', [UserController::class, 'nardban']);
    Route::post('/nardban/activate', [UserController::class, 'nardbanActivate']);
    Route::get('/favorite', [UserController::class, 'favorite'])->name('user.favorite');
    Route::post('/favorite/toggle', [UserController::class, 'toggleFavorite'])->name('user.favorite.toggle');
    Route::match(['put', 'post'], '/update', [UserController::class, 'updateProfile']);
});
