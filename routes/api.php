<?php

use App\Http\Controllers\Api\ProductController;
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
Route::get('products',[ProductController::class,'index']);
Route::get('product/{id}',[ProductController::class,'show']);
Route::post('product/create',[ProductController::class,'store']);
Route::delete('product/{id}',[ProductController::class,'destroy']);
Route::post('product/{id}', [ProductController::class,'edit']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
