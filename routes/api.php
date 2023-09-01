<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});

Route::middleware(['jwt.verify'])->group(function () {
    
    Route::get('products',[ProductController::class,'index']);
    Route::get('products_sort',[ProductController::class,'sort_products']);
    Route::get('product/{id}',[ProductController::class,'show']);
    Route::post('product/create',[ProductController::class,'store']);
    Route::delete('product/{id}',[ProductController::class,'destroy']);
    Route::post('product/{id}', [ProductController::class,'edit']);
    Route::get('search',[ProductController::class,'products_search']);
    Route::resource('orders', OrderController::class);
    Route::resource('categories', CategoryController::class);
    Route::get('admin_orders',[OrderController::class,'getAdminOrders'])->name('admin.orders');
    Route::post('order/make/{id}', [OrderController::class, 'make_order'])->name('order.make');
    Route::get('users',[UserController::class,'index'])->name('users.index');
    Route::get('admin/{id}',[UserController::class,'make_admin'])->name('user.admin');
    
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
