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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

////  API

// Products
Route::post('api/create_products', [App\Http\Controllers\ProductsController::class, 'create_products']);
Route::get('api/listproducts', [App\Http\Controllers\ProductsController::class, 'listproducts'])->name('listproducts');
Route::post('api/updateproducts', [App\Http\Controllers\ProductsController::class, 'updateproducts'])->name('updateproducts');
Route::post('api/deleteproducts', [App\Http\Controllers\ProductsController::class, 'deleteproducts'])->name('deleteproducts ');

// Business
Route::post('api/create_business', [App\Http\Controllers\BusinessController::class, 'create_business']);
Route::get('api/listbusiness', [App\Http\Controllers\BusinessController::class, 'listbusiness'])->name('listbusiness');

// User
Route::post('api/create_users', [App\Http\Controllers\UsersController::class, 'create_users']);
Route::get('api/listusers', [App\Http\Controllers\UsersController::class, 'listusers'])->name('listuser');
Route::post('api/select_business', [App\Http\Controllers\UsersController::class, 'select_business']);


