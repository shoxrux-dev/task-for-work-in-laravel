<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EntryProductController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
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

Route::group(['middleware' => ['role:admin'], 'prefix' => 'dashboard'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/category-create', [CategoryController::class, 'create'])->name('category-create');
    Route::post('/category-create', [CategoryController::class, 'upload'])->name('category-upload');
    Route::get('/category-edit/{id}', [CategoryController::class, 'edit'])->name('category-edit');
    Route::post('/category-update/{id}', [CategoryController::class, 'update'])->name('category-update');
    Route::get('/category-delete/{id}', [CategoryController::class, 'delete'])->name('category-delete');

    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::get('/product-create', [ProductController::class, 'create'])->name('product-create');
    Route::post('/product-create', [ProductController::class, 'upload'])->name('product-upload');
    Route::get('/product-edit/{id}', [ProductController::class, 'edit'])->name('product-edit');
    Route::post('/product-update/{id}', [ProductController::class, 'update'])->name('product-update');
    Route::get('/product-delete/{id}', [ProductController::class, 'delete'])->name('product-delete');

    Route::get('/entry-product', [EntryProductController::class, 'index'])->name('entry-product');
    Route::get('/entry-product-create', [EntryProductController::class, 'create'])->name('entry-product-create');
    Route::post('/entry-product-create', [EntryProductController::class, 'upload'])->name('entry-product-upload');

    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
    Route::get('/order', [OrderController::class, 'index'])->name('order');
    Route::get('/order-create', [OrderController::class, 'create'])->name('order-create');
    Route::post('/order-create', [OrderController::class, 'upload'])->name('order-upload');

    Route::post('/order-search', [OrderController::class, 'search'])->name('order-search');

});
