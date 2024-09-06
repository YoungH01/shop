<?php

use App\Http\Controllers\Admins\AdminController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['isLogin'])->group(function () {
    Route::get('/login',[LoginController::class,'index'])->name('login.layout');
    Route::post('/login',[LoginController::class,'login'])->name('login.implement');
});

Route::prefix('dashboard')->middleware('admin')->group(function(){
    Route::get('/',[DashboardController::class,'index'])->name('dashboard.layout');
    Route::post('/',[DashboardController::class,'logout'])->name('logout');
    Route::prefix('customer')->group(function(){
        Route::get('/',[CustomerController::class,'index'])->name('customer.view');
        Route::get('/add',[CustomerController::class,'addView'])->name('customer.add.view');
        Route::post('/add',[CustomerController::class,'addImplement'])->name('customer.add.implement');
        Route::post('/{id}',[CustomerController::class,'remove'])->name('customer.remove');
        Route::get('/update/{id}',[CustomerController::class,'updateView'])->name('customer.update.view');
        Route::post('/update/{id}',[CustomerController::class,'updateImplement'])->name('customer.update.implement');
        Route::get('/detail/{id}',[CustomerController::class,'detail'])->name('customer.detail');
    });

    Route::prefix('product')->group(function(){
        Route::get('/',[ProductController::class,'index'])->name('product.view');
        Route::get('/add',[ProductController::class,'addView'])->name('product.add.view');
        Route::post('/add',[ProductController::class,'addImplement'])->name('product.add.implement');
        Route::post('/{id}',[ProductController::class,'removeProduct'])->name('product.remove');
        Route::get('/update/{id}',[ProductController::class,'updateView'])->name('product.update.view');
        Route::post('/update/action/{id}',[ProductController::class,'updateImplement'])->name('product.update.implement');
    });

    Route::prefix('category')->group(function(){
         Route::get('/',[CategoryController::class,'index'])->name('category.view');
         Route::get('/add',[CategoryController::class,'addView'])->name('category.add.view');
         Route::post('/add',[CategoryController::class,'addImplement'])->name('category.add.implement');
         Route::post('/{category}',[CategoryController::class,'remove'])->name('category.remove');
         Route::get('/update/{category}',[CategoryController::class,'updateView'])->name('category.update.view');
         Route::post('/update/{category}',[CategoryController::class,'updateImplement'])->name('category.update.implement');
    });

    Route::prefix('orders')->group(function(){
        Route::get('/',[OrderController::class,'index'])->name('orders.view');
    });
    
    Route::prefix('admin')->middleware('isSuperAdmin')->group(function(){
        Route::get('/',[AdminController::class,'index'])->name('admins.view');
        Route::get('/add',[AdminController::class,'addView'])->name('admins.add.view');
        Route::post('/add',[AdminController::class,'addImplement'])->name('admins.add.implement');
        Route::post('/{id}',[AdminController::class,'remove'])->name('admins.remove');
        Route::get('/update/{id}',[AdminController::class,'updateView'])->name('admins.update.view');
        Route::post('/update/{id}',[AdminController::class,'updateImplement'])->name('admins.update.implement');
    });
});