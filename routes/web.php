<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;
use app\Http\Middleware\AdminMiddleware;


// Trang chính
Route::get('/', function () {
    return view('pages.index');
})->name('home');

// Đăng nhập
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/auth-login', [UserController::class, 'auth_login'])->name('auth.login');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::get('logout', [UserController::class, 'logout'])->name('logout');

// Admin
Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/index', [AdminController::class, 'index'])->name('admin.index');
    //users
    Route::get('/all_users', [UserController::class, 'all_users'])->name('admin.all_users');
    Route::get('edit/{email}', [UserController::class, 'edit_user'])->name('admin.edit_user');
    Route::post('update/{email}', [UserController::class, 'update_user'])->name('admin.update_user');
    Route::get('remove/{email}', [UserController::class, 'remove_user'])->name('admin.remove_user');
    Route::get('add_user', [UserController::class, 'add_user'])->name('admin.add_user');
    Route::post('save_add_user', [UserController::class, 'save_add_user'])->name('admin.save_add_user');
    // categories
    Route::get('categories', [CategoriesController::class, 'all_categories'])->name('admin.all_categories');
    Route::get('categories/create', [CategoriesController::class, 'create_category'])->name('admin.create_category');
    Route::post('categories', [CategoriesController::class, 'store_category'])->name('admin.store_category');
    Route::get('categories/edit/{id}', [CategoriesController::class, 'edit_category'])->name('admin.edit_category');
    Route::put('categories/{id}', [CategoriesController::class, 'update_category'])->name('admin.update_category');
    Route::get('categories/{id}', [CategoriesController::class, 'remove_category'])->name('admin.remove_category');
    // product
    Route::get('/all_products', [ProductController::class, 'index'])->name('admin.all_products');
    Route::get('/add_product', [ProductController::class, 'create'])->name('admin.create_product');
    Route::post('/store_product', [ProductController::class, 'store'])->name('admin.store_product');
    Route::get('/edit_product/{id}', [ProductController::class, 'edit'])->name('admin.edit_product');
    Route::post('/update_product/{id}', [ProductController::class, 'update'])->name('admin.update_product');
    Route::delete('/delete_product/{id}', [ProductController::class, 'destroy'])->name('admin.delete_product');
});



