<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('landing');
    })->name('dashboard');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home',[HomeController::class,'home_dashboard'])->name('home.dashboard');
    Route::resource('category',CategoryController::class);
    Route::resource('order',OrderController::class);
    Route::get('admin',[OrderController::class,'getAdminOrders'])->name('admin.orders');
    Route::post('order/make/{id}', [OrderController::class, 'make_order'])->name('order.make');
    Route::get('create',[ProductController::class,'create'])->name('products.create');
    Route::get('products', [ProductController::class,'index'])->name('product.dashboard');
    Route::get('products/make_order/{id}',[ProductController::class,'make_order'])->name('products.make_order');
    Route::post('products/search',[ProductController::class,'search'])->name('product.search');
    Route::post('shop/search',[ProductController::class,'shop_search'])->name('shop.search');
    Route::get('products/{id}', [ProductController::class,'show'])->name('product');
    // Route::get('products/create',[ProductController::class,'create'])->name('products.create');
    Route::delete('products/delete/{id}',[ProductController::class,'destroy'])->name('products.delete');
    Route::get('products/update/{id}',[ProductController::class,'update'])->name('products.update');
    Route::put('products/edit/{id}',[ProductController::class,'edit'])->name('products.edit');
    Route::post('products/store',[ProductController::class,'store'])->name('products.store');
    
    Route::get('shop',[ProductController::class,'shop'])->name('products.shop');
    Route::get('users',[UserController::class,'index'])->name('users.index');
    Route::get('category/update/{id}',[CategoryController::class,'update'])->name('category.update');
    Route::put('category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
    Route::get('admin/{id}',[UserController::class,'make_admin'])->name('user.admin');
});
