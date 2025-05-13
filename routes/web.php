<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;

//Route::get('/', [AuthController::class,'index']);
Route::get('sign-in', [AuthController::class,'signin'])->name('sign-in');
Route::post('post-sign-in', [AuthController::class, 'login'])->name('login');

Route::get('sign-up', [AuthController::class, 'signup'])->name('sign-up');
Route::post('post-sign-up', [AuthController::class, 'register'])->name('register');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');



Route::get('user', [UserController::class,'index'])->name('user.index');
Route::get('user/edit', [UserController::class,'edit'])->name('user.edit');
Route::post('user/image', [UserController::class,'image'])->name('user.image');
Route::put('user/update', [UserController::class,'update'])->name('user.update');



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
Route::get('/posts/{id}', [PostController::class, 'showById'])->name('posts.showById');

Route::get('/admin/posts', [PostController::class, 'index'])->name('posts.show');

//Route Dashboard
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard.index');
    Route::get('/admin/posts', [AdminController::class, 'posts'])->name('admin.posts.index');
});


//Route Categories
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/admin/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    Route::get('/admin/categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/admin/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
});


//Route Comments
Route::middleware(['user'])->group(function () {
    Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
    Route::get('/comments/create', [CommentController::class, 'create'])->name('comments.create');
    Route::post('/posts/{id}', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
    // Route::get('/posts/{id}', [CommentController::class, 'getCommentsByPostId'])->name('comments.getCommentsByPostId');

    // Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
});




Route::get('/{id}', [AuthController::class, 'signin']);
