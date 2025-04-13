<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckLogin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;



Route::resource('/blog', BlogController::class);
Route::get('sign-in', [AuthController::class,'signin'])->name('sign-in');
Route::post('post-sign-in', [AuthController::class, 'login'])->name('login');

Route::get('sign-up', [AuthController::class,'signup'])->name('sign-up');
Route::post('post-sign-up', [AuthController::class,'register'])->name('register');

Route::middleware([CheckLogin::class])->group(function () {
    Route::get('/', [AuthController::class,'index']);
    Route::get('logout', [AuthController::class,'logout'])->name('logout');
    Route::get('/{id}', [AuthController::class,'signin']);
});
