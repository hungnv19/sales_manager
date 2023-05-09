<?php

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
    return view('admin.layouts.admin');
});


// Route::prefix('admin')->group(function () {
//     return view('admin.layouts.client');
//     Route::get('dashboard', [HomeController::class, 'index'])->name('home.index');
//     Route::resource('user', UserController::class);
//     Route::resource('category', CategoryController::class);
//     Route::resource('product', ProductController::class);
//     Route::resource('stock', StockController::class);
// });