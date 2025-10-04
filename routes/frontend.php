<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Frontend\FrontendController;

Route::get('/', function () {
    return Inertia::render('HomeView');
});

Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'home')->name('frontend.home');
    Route::get('/about', 'about')->name('frontend.about');
    Route::get('/blog', 'blog')->name('frontend.blog');
    Route::get('/blog/{slug}', 'blogDetails')->name('frontend.blog.details');
    Route::get('/contact', 'contact')->name('frontend.contact');
    Route::get('/login', 'login')->name('frontend.login');
});