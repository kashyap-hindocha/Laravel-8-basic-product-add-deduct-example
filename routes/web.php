<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyCRUDController;
use App\Http\Controllers\ProductController;

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

// Route::get('/products', function () {
//     return view('products.index');
// });
 
Route::any('/', [ProductController::class, 'index'])->name('index-products');
Route::any('/products/create', [ProductController::class, 'create'])->name('create-product');
Route::any('/products/store', [ProductController::class, 'store'])->name('store-product');
Route::any('/products/order', [ProductController::class, 'order'])->name('order-product');
Route::any('/products/delete', [ProductController::class, 'destroy'])->name('delete-product');
 

 
