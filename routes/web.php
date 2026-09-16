<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SpecialController;
use Illuminate\Http\Request;


Route::get('/', [IndexController::class,'index']);
Route::get('/home', [IndexController::class,'index']);
Route::get('/special', [SpecialController::class, 'index'])->name('special');
Route::get('/auth/login', [AuthController::class,'formLogin'])->name('user.login');

Route::post('/auth/check', [AuthController::class,'prosrsslogin']);
Route::post('/auth/signUp', [AuthController::class,'signUp']);
Route::get('/auth/logout', [AuthController::class,'logout']);



Route::get('/page/faqs', [PageController::class,'faqs']);
Route::get('/page/about', [PageController::class,'about']);
Route::get('/page/contact', [PageController::class,'contact']);

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::post('/blog/{slug}/comment', [BlogController::class, 'storeComment'])->name('blog.comment');

Route::get('/catalog', [PropertyController::class, 'catalog'])->name('catalog');

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Browse by category
Route::get('/browse/apartment', [CategoryController::class, 'apartment'])->name('browse.apartment');
Route::get('/browse/{category}', [CategoryController::class, 'browse'])->name('browse.category');





Route::get('/agents', [AgentController::class, 'index'])->name('agents.index');
Route::get('/agent/{id}', [AgentController::class, 'show'])->name('agent.show');
Route::get('/agent/{id}/{a}', [AgentController::class, 'show'])->name('agent.sort');





Route::get('/raw-cookie', function () {
    return response('cookie test')
        ->withCookie(cookie(
            'MY_TEST_COOKIE',
            'hello',
            60
        ));
});


Route::get('/raw-cookie', function () {
    return response('cookie test')
        ->header('X-Test-Header', 'hello')
        ->withCookie(cookie('MY_TEST_COOKIE', 'hello', 60));
});

require __DIR__.'/user.php';
require __DIR__.'/property.php';

require __DIR__.'/admin.php';
require __DIR__.'/admin_property.php';
