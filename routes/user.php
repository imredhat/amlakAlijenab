<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User;

Route::get('/user/myADS', [User::class, 'myADS'])->middleware('auth');
