<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/profile', [AuthController::class, 'profile'])->middleware('auth')->name('profile');
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot.password');

// Admin routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('categories', AdminCategoryController::class);
        Route::resource('products', AdminProductController::class);
        Route::resource('blogs', AdminBlogController::class);
    });
});

// Public pages
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/team', [HomeController::class, 'team'])->name('team');
Route::get('/appointment', [HomeController::class, 'appointment'])->name('appointment');
Route::get('/blogs', [HomeController::class, 'blogs'])->name('blogs');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Product routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/add/{productId}', [CartController::class, 'store'])->name('cart.add');
Route::get('/cart/count', [CartController::class, 'count']);

// Checkout routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
// Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/order-received/{orderId}', [CheckoutController::class, 'received'])->name('order.received');

Route::get('/check-auth', [AuthController::class, 'checkAuth'])->name('auth.check');

Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/return', [CheckoutController::class, 'return'])->name('checkout.return');
Route::get('/checkout/success', function () {
    return view('checkout.success');
})->name('checkout.success');
Route::get('/checkout/failure', function () {
    return view('checkout.failure');
})->name('checkout.failure');

Route::delete('/admin/products/{productId}/images/{imageId}', [AdminProductController::class, 'destroyImage'])->name('admin.product.images.delete');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/edit-profile', [UserController::class, 'showEditProfileForm'])->name('edit-profile');
    Route::post('/edit-profile', [UserController::class, 'updateProfile']);
    Route::get('/change-password', [UserController::class, 'showChangePasswordForm'])->name('change-password');
    Route::post('/change-password', [UserController::class, 'updatePassword']);
    Route::get('/change-avatar', [UserController::class, 'showChangeAvatarForm'])->name('change-avatar');
    Route::post('/change-avatar', [UserController::class, 'updateAvatar']);
});
