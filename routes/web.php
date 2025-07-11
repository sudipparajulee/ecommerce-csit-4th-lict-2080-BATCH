<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

Route::get('/',[PagesController::class, 'index']);
Route::get('/viewproduct/{id}', [PagesController::class, 'viewproduct'])->name('viewproduct');
Route::get('/categoryproducts/{id}', [PagesController::class, 'categoryproducts'])->name('categoryproducts');
Route::get('/search', [PagesController::class, 'search'])->name('search');
Route::get('/search-suggestions', [PagesController::class, 'searchSuggestions'])->name('search.suggestions');

Route::middleware('auth')->group(function(){
    Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
    Route::get('/mycart', [CartController::class, 'mycart'])->name('mycart');
    Route::delete('/cart/{id}/destroy', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('/checkout/{cartid}', [PagesController::class, 'checkout'])->name('checkout');

    //Order
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/store-esewa/{cartid}', [OrderController::class, 'storeEsewa'])->name('order.esewa');

    Route::get('/myorders', [PagesController::class, 'myorder'])->name('myorders');
    Route::post('/order/cancel/{orderid}', [OrderController::class, 'cancelorder'])->name('order.cancel');

    // Rating routes
    Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
    Route::get('/products/{product}/ratings', [RatingController::class, 'getProductRatings'])->name('ratings.product');
    Route::get('/products/{product}/user-rating', [RatingController::class, 'getUserRating'])->name('ratings.user');
    Route::delete('/ratings/{rating}', [RatingController::class, 'destroy'])->name('ratings.destroy');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'isadmin'])->name('dashboard');

Route::middleware(['auth', 'isadmin'])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
    Route::get('/categories/{id}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/{id}/update', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products/{id}/destroy', [ProductController::class, 'destroy'])->name('products.destroy');

    //Order
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{orderid}/status/{status}', [OrderController::class, 'updateStatus'])->name('orders.status');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
