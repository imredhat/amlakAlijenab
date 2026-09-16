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
Route::get('/admin/login', [AdAuth::class, 'formLogin'])->name('admin.login');
Route::get('/admin/forget', [AdAuth::class, 'forget'])->name('admin.forget');
Route::get('/admin/two_step', [AdAuth::class, 'two_step']);


Route::post('/admin/checkLogin', [AdAuth::class, 'prosrsslogin']);
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
Route::get('/admin/page/contact-submissions', [Page::class, 'contactSubmissions'])->name('admin.contact.submissions');
Route::delete('/admin/page/contact-submissions/{id}/delete', [Page::class, 'deleteSubmission'])->name('admin.contact.delete');



Route::get('/admin/page/about', [AboutPage::class, 'edit'])->name('admin.about.edit');
Route::post('/admin/page/about', [AboutPage::class, 'update'])->name('admin.about.update');


// FAQs admin
// Route::get('/admin/faqs', [Faqs::class, 'index'])->name('faqs.index');
// Route::get('/admin/faqs/create', [Faqs::class, 'create'])->name('faqs.create');
// Route::post('/admin/faqs/store', [Faqs::class, 'store'])->name('faqs.store');
// Route::get('/admin/faqs/{id}/edit', [Faqs::class, 'edit'])->name('faqs.edit');
// Route::post('/admin/faqs/{id}/update', [Faqs::class, 'update'])->name('faqs.update');
// Route::delete('/admin/faqs/{id}', [Faqs::class, 'destroy'])->name('faqs.destroy');


Route::get('/admin/page/faqs', [FAQController::class, 'index'])->name('admin.faq.index');
Route::put('/admin/page/faqs', [FAQController::class, 'update'])->name('admin.faq.update');

Route::prefix('admin')->group(function () {
    Route::resource('neighborhood', NeighborhoodController::class);

    // Top Agents
    Route::get('/top-agents', [\App\Http\Controllers\Admin\TopAgentController::class, 'index'])->name('admin.top-agents.index');
    Route::post('/top-agents', [\App\Http\Controllers\Admin\TopAgentController::class, 'store'])->name('admin.top-agents.store');
    Route::post('/top-agents/update-order', [\App\Http\Controllers\Admin\TopAgentController::class, 'updateOrder'])->name('admin.top-agents.update-order');
    Route::delete('/top-agents/{id}', [\App\Http\Controllers\Admin\TopAgentController::class, 'destroy'])->name('admin.top-agents.destroy');

    // Users
    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/{id}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
    Route::post('/users/{id}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');
    Route::get('/users/{id}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('admin.users.show');
    Route::post('/users/{id}/toggle-agent', [\App\Http\Controllers\Admin\UserController::class, 'toggleAgent'])->name('admin.users.toggle-agent');
    Route::get('/users/{id}/properties', [\App\Http\Controllers\Admin\UserController::class, 'properties'])->name('admin.users.properties');
});


// Blog admin
Route::get('/admin/blog', [\App\Http\Controllers\Admin\BlogController::class, 'index'])->name('admin.blog.index');
Route::get('/admin/blog/create', [\App\Http\Controllers\Admin\BlogController::class, 'create'])->name('admin.blog.create');
Route::post('/admin/blog/store', [\App\Http\Controllers\Admin\BlogController::class, 'store'])->name('admin.blog.store');
Route::get('/admin/blog/{id}/edit', [\App\Http\Controllers\Admin\BlogController::class, 'edit'])->name('admin.blog.edit');
Route::post('/admin/blog/{id}/update', [\App\Http\Controllers\Admin\BlogController::class, 'update'])->name('admin.blog.update');
Route::post('/admin/blog/{id}/toggle-status', [\App\Http\Controllers\Admin\BlogController::class, 'toggleStatus'])->name('admin.blog.toggle');
Route::delete('/admin/blog/{id}', [\App\Http\Controllers\Admin\BlogController::class, 'destroy'])->name('admin.blog.destroy');

// Blog Comments admin
Route::get('/admin/blog/comments', [\App\Http\Controllers\Admin\BlogCommentController::class, 'index'])->name('admin.blog.comments');
Route::post('/admin/blog/comments/{id}/approve', [\App\Http\Controllers\Admin\BlogCommentController::class, 'approve'])->name('admin.blog.comments.approve');
Route::post('/admin/blog/comments/{id}/reject', [\App\Http\Controllers\Admin\BlogCommentController::class, 'reject'])->name('admin.blog.comments.reject');
Route::post('/admin/blog/comments/{id}/delete', [\App\Http\Controllers\Admin\BlogCommentController::class, 'delete'])->name('admin.blog.comments.delete');

// Upgrade Packages (Nardban)
Route::get('/admin/upgrade-packages', [\App\Http\Controllers\Admin\UpgradePackageController::class, 'index'])->name('admin.upgrade-packages.index');
Route::get('/admin/upgrade-packages/create', [\App\Http\Controllers\Admin\UpgradePackageController::class, 'create'])->name('admin.upgrade-packages.create');
Route::post('/admin/upgrade-packages', [\App\Http\Controllers\Admin\UpgradePackageController::class, 'store'])->name('admin.upgrade-packages.store');
Route::get('/admin/upgrade-packages/{id}/edit', [\App\Http\Controllers\Admin\UpgradePackageController::class, 'edit'])->name('admin.upgrade-packages.edit');
Route::put('/admin/upgrade-packages/{id}', [\App\Http\Controllers\Admin\UpgradePackageController::class, 'update'])->name('admin.upgrade-packages.update');
Route::delete('/admin/upgrade-packages/{id}', [\App\Http\Controllers\Admin\UpgradePackageController::class, 'destroy'])->name('admin.upgrade-packages.destroy');
