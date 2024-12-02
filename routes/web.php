<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::view('/','home.index')->name('home');
Route::redirect('/','products');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard',action: [DashboardController::class,'index'])->name(name: 'dashboard'); 
    Route::get('/product/{id}/details', [ProductController::class, 'getProductDetails'])->name('product.details');
    Route::resource('products',ProductController::class);
    Route::post('/logout',[AuthController::class,'logout'])->name('logout'); 
});


Route::middleware('guest')->group(function () {
    Route::view('/register','auth.register')->name('register');
    Route::post('/register',[AuthController::class,'register']); 

    Route::view('/login','auth.login')->name('login');
    Route::post('/login',[AuthController::class,'login']); 
});


