<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;

Route::resource('/blog', BlogController::class);
Route::get('sign-in', [AuthController::class,'signin'])->name('sign-in');
Route::post('post-sign-in', [AuthController::class, 'login'])->name('login');

Route::get('sign-up', [AuthController::class,'signup'])->name('sign-up');
Route::post('post-sign-up', [AuthController::class,'register'])->name('register');

Route::get('logout', [AuthController::class,'logout'])->name('logout');


Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::get('/', [AuthController::class,'index']);

Route::middleware(['user'])->group(function () {

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
