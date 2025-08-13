<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/team', [HomeController::class, 'team'])->name('team');
Route::get('/appointment', [HomeController::class, 'appointment'])->name('appointment');
Route::get('/products', [HomeController::class, 'products'])->name('products');
Route::get('/blogs', [HomeController::class, 'blogs'])->name('blogs');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/admin/users', [HomeController::class, 'users'])->name('admin.users')->middleware('admin');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/login', [AuthController::class, 'login'])->name('login');

