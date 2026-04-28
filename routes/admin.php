<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdAuth;
use App\Http\Controllers\Admin\Index;
use App\Http\Controllers\Admin\Sections;
use App\Http\Controllers\Admin\City;
use App\Http\Controllers\Admin\Page;

Route::get('/admin', [AdAuth::class, 'formLogin'])->name('login');
Route::get('/admin/login', [AdAuth::class, 'formLogin'])->name('login');
Route::get('/admin/forget', [AdAuth::class, 'forget'])->name('login');
Route::get('/admin/two_step', [AdAuth::class, 'two_step']);


Route::post('/admin/checkLogin', [AdAuth::class, 'prosrsslogin']);
Route::post('/admin/recover', [AdAuth::class, 'recover']);
Route::post('/admin/recover', [AdAuth::class, 'recover']);
Route::post('/admin/changepass', [AdAuth::class, 'changepass']);
Route::get('/admin/logout', [AdAuth::class, 'logout']);






Route::get('/admin/dashboard', [Index::class, 'dashboard']);

// sections
Route::get('/admin/sections', [Sections::class, 'index'])->name('sections.index');
Route::get('/admin/sections/create', [Sections::class, 'create'])->name('sections.create');
Route::post('/admin/sections/store', [Sections::class, 'store'])->name('sections.store');
Route::get('/admin/sections/{id}/edit', [Sections::class, 'edit'])->name('sections.edit');
Route::post('/admin/sections/{id}/update', [Sections::class, 'update'])->name('sections.update');


//City
Route::get('/admin/city', [City::class, 'index'])->name('city.index');
Route::get('/admin/city/create', [City::class, 'create'])->name('city.create');
Route::post('/admin/city/store', [City::class, 'store'])->name('city.store');
Route::get('/admin/city/{id}/edit', [City::class, 'edit'])->name('city.edit');
Route::post('/admin/city/update/{id}', [City::class, 'update'])->name('city.update');
Route::delete('/admin/city/{id}', [City::class, 'destroy'])->name('city.destroy');



// pages
Route::get('/admin/page/about', [Page::class, 'about']);
Route::post('/admin/page/about', [Page::class, 'UpdAbout'])->name('page.form');

Route::get('/admin/page/contact', [Page::class, 'contact']);
Route::post('/admin/page/contact', [Page::class, 'UpdContact']);
Route::post('/admin/page/contact_form', [Page::class, 'saveContactForm'])->name('contact.form');
