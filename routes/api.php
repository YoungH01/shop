<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
// use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!

*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->group(function(){
    Route::get('/cart/{id?}',[CartController::class,'index']);
    Route::get('/cart/remove/{id}',[CartController::class,'remove']);
    Route::post('logout', [UserController::class, 'logout']);
});
Route::post('/login',[UserController::class,'login']);
Route::post('/register',[UserController::class,'register']);
Route::get('/category',[ProductController::class,'getCategory']);
Route::get('/product',[ProductController::class,'getAllProducts']);
Route::get('/product/{id}',[ProductController::class,'getProduct']);

Route::post('/cart/order',[OrderController::class,'add']);
Route::post('/cart/store',[CartController::class,'add']);
Route::get('/profile/{id}/order',[OrderController::class,'index']);


