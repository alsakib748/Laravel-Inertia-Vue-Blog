<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\CategoryController;

// Route::get('/', function () {
//     return Inertia::render('HomeView');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])
    ->group(function () {
        Route::get('/dashboard', function () {
            return Inertia::render('HomeView');
        })->name('dashboard');
    });


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::resource('categories', CategoryController::class)->names([
        'index' => 'categories.index',
        'create' => 'categories.create',
        'store' => 'categories.store',
        'show' => 'categories.show',
        'edit' => 'categories.edit',
        'update' => 'categories.update',
        'destroy' => 'categories.destroy'
    ]);

    Route::resource('tags', TagController::class)->names([
        'index' => 'tags.index',
        'create' => 'tags.create',
        'store' => 'tags.store',
        'show' => 'tags.show',
        'edit' => 'tags.edit',
        'update' => 'tags.update',
        'destroy' => 'tags.destroy'
    ]);

    Route::resource('posts', PostController::class)->names([
        'index' => 'posts.index',
        'create' => 'posts.create',
        'store' => 'posts.store',
        'show' => 'posts.show',
        'edit' => 'posts.edit',
        'update' => 'posts.update',
        'destroy' => 'posts.destroy'
    ]);

});

// Sidebar pages
Route::get('/tables', function () {
    return Inertia::render('TablesView');
});

Route::get('/forms', function () {
    return Inertia::render('FormsView');
});

Route::get('/ui', function () {
    return Inertia::render('UiView');
});

Route::get('/responsive', function () {
    return Inertia::render('ResponsiveView');
});

Route::get('/styles', function () {
    return Inertia::render('StyleView');
});

Route::get('/profile', function () {
    return Inertia::render('ProfileView');
});


// Jetstream and Fortify authentication routes are registered automatically by their service providers.

Route::get('/error', function () {
    return Inertia::render('ErrorView');
});
