<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;

//Route::get('/', [AuthController::class,'index']);
Route::resource('blog', BlogController::class);
Route::get('sign-in', [AuthController::class,'signin'])->name('sign-in');
Route::post('post-sign-in', [AuthController::class, 'login'])->name('login');

Route::get('sign-up', [AuthController::class,'signup'])->name('sign-up');
Route::post('post-sign-up', [AuthController::class,'register'])->name('register');

Route::get('logout', [AuthController::class,'logout'])->name('logout');



Route::get('/', [PostController::class,'index']);
Route::get('/posts', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/category/{category_id}', [PostController::class, 'showByCategoryId'])->name('posts.showByCategoryId');
Route::get('/posts/search/', [PostController::class, 'showByTitle'])->name('posts.searchByTitle');
Route::middleware(['user'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'showFormCreatePost'])->name('posts.create');
    Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/edit/{id}', [PostController::class, 'showFormEditPost'])->name('posts.edit');
    Route::put('/posts/update/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/destroy/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
});

//Route Categories
Route::middleware(['admin'])->group(function () {
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
});



Route::get('/{id}', [AuthController::class,'signin']);
