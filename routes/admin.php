<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdAuth;
use App\Http\Controllers\Admin\Index;
use App\Http\Controllers\Admin\Sections;
use App\Http\Controllers\Admin\City;
use App\Http\Controllers\Admin\Page;
use App\Http\Controllers\Admin\AboutPage;
use App\Http\Controllers\Admin\FAQController;
use App\Http\Controllers\Admin\NeighborhoodController;

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



Route::get('/admin/page/about', [AboutPage::class, 'edit'])->name('admin.about.edit');
Route::post('/admin/page/about', [AboutPage::class, 'update'])->name('admin.about.update');


// FAQs admin
// Route::get('/admin/faqs', [Faqs::class, 'index'])->name('faqs.index');
// Route::get('/admin/faqs/create', [Faqs::class, 'create'])->name('faqs.create');
// Route::post('/admin/faqs/store', [Faqs::class, 'store'])->name('faqs.store');
// Route::get('/admin/faqs/{id}/edit', [Faqs::class, 'edit'])->name('faqs.edit');
// Route::post('/admin/faqs/{id}/update', [Faqs::class, 'update'])->name('faqs.update');
// Route::delete('/admin/faqs/{id}', [Faqs::class, 'destroy'])->name('faqs.destroy');


Route::get('/admin/page/faqs', [FAQController::class, 'index'])->name('admin.faq');
Route::put('/admin/page/faqs', [FAQController::class, 'update'])->name('admin.faq');

// Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
// });



Route::prefix('admin')->group(function () {
    Route::resource('neighborhood', NeighborhoodController::class);
});