<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
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



Route::get('user/dashboard', [UserController::class,'index'])->name('user.index');
Route::get('user/edit', [UserController::class,'edit'])->name('user.edit');
Route::put('user/update', [UserController::class,'update'])->name('user.update');



Route::get('/', [AuthController::class,'index'])->name('auth.index');
Route::get('user/posts', [PostController::class, 'show'])->name('posts.show');
Route::get('user/posts/category/{category_id}', [PostController::class, 'showByCategoryId'])->name('posts.showByCategoryId');
Route::get('user/posts/search/', [PostController::class, 'showByTitle'])->name('posts.searchByTitle');
Route::get('user/posts/{id}/post/', [PostController::class, 'showByUserId'])->name('posts.showByUserId');
Route::middleware(['user'])->group(function () {
    Route::get('user/posts/create', [PostController::class, 'showFormCreatePost'])->name('posts.create');
    Route::post('user/posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('user/posts/{id}/edit', [PostController::class, 'showFormEditPost'])->name('posts.edit');
    Route::put('user/posts/{id}/update', [PostController::class, 'update'])->name('posts.update');
    Route::delete('user/posts/{id}/destroy', [PostController::class, 'destroy'])->name('posts.destroy');
});
Route::get('user/posts/{id}', [PostController::class, 'showById'])->name('posts.showById');


Route::get('/admin/posts', [PostController::class, 'index'])->name('posts.show');
Route::put('/posts/{id}', [PostController::class, 'updateStatus'])->name('posts.updateStatus')->withoutMiddleware('admin');

//Route Admin
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard.index');
    Route::get('/admin/posts', [AdminController::class, 'posts'])->name('admin.posts.index');
    Route::get('/admin/users', [AdminController::class, 'getAllUsers'])->name('admin.users.index');
    Route::get('/admin/posts/search', [AdminController::class, 'searchPosts'])->name('admin.posts.search');
    Route::get('/admin/users/search', [AdminController::class, 'searchUsers'])->name('admin.users.search');
    Route::get('/admin/posts/{id}', [AdminController::class, 'detailpost'])->name('admin.posts.detail');
    Route::post('/admin/users/{id}', [AdminController::class, 'updateUserStatus'])->name('admin.users.updateUserStatus');

    Route::get('/admin/contact', [AdminController::class, 'showContact'])->name('admin.contacts.index');
    Route::get('/admin/contact/{id}', [AdminController::class, 'showContactById'])->name('admin.contact.showById');
    Route::put('/admin/contact/{id}/update', [AdminController::class, 'updateContact'])->name('admin.contact.update');
    Route::delete('/admin/contact/{id}/delete', [AdminController::class, 'deleteContact'])->name('admin.contact.delete');
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

Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('contact', [ContactController::class, 'store'])->name('contact.store');



Route::get('/{id}', [AuthController::class, 'signin']);
