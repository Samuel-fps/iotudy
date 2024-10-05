<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/all', [HomeController::class, 'all'])->name('home.all');

// admin
Route::get('admin', [AdminController::class, 'index'])->name('admin.index');;

Route::namespace('App\Http\Controllers')->prefix('admin')->group(function(){

    Route::resource('articles', 'ArticleController')
                    ->except('show')
                    ->names('articles');

    Route::resource('categories', 'CategoryController')
                    ->except('show')
                    ->names('categories');

    Route::resource('comments', 'CommentController')
                    ->only('index', 'destroy')
                    ->names('comments');

});

Route::resource('articles', ArticleController::class)
                ->except('show')
                ->names('articles');

Route::resource('categories', CategoryController::class)
                ->except('show')
                ->names('categories');

Route::resource('comments', CommentController::class)
                ->only('index', 'destroy')
                ->names('comments');

Route::resource('profiles', ProfileController::class)
                ->only('edit', 'update')
                ->names('profiles');

// See article
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

// See article by category
Route::get('category/{category}', [CategoryController::class, 'detail'])->name('categories.detail');

// Save comments
Route::post('/comment', [CommentController::class, 'store'])->name('comments.store');

Auth::routes();