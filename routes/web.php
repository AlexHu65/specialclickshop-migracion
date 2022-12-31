<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\DashboardController;
 

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home.index');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/products/categories/{slug?}', 'index')->name('categories.detail');
    Route::get('/products', 'shop')->name('shop');
    Route::get('/offers', 'offers')->name('special.offers');
    Route::get('/products/categories/models/{slug?}', 'models')->name('categoriesModels.detail');
    Route::get('/products/{slug}', 'detail')->name('product.detail');
    Route::get('/products/categories/model/{id}', 'shop')->name('model.shop');
    Route::post('/products/comment', 'comment')->name('product.comment');
    Route::get('/search/', 'search')->name('search.index');
    
});

Route::controller(CheckOutController::class)->group(function () {
    Route::get('/success/{carrito}', 'success')->name('success')->middleware('verified')->middleware('auth');
});

Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index')->middleware('verified')->middleware('auth');
});

Route::controller(BlogController::class)->group(function () {
    Route::get('/blog', 'index')->name('blog');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
});

Route::controller(CarritoController::class)->group(function () {
    Route::get('/cart', 'index')->name('carrito.detail');
});

Route::controller(LanguageController::class)->group(function () {
    Route::get('/lang/{lang}', 'switchLang')->name('lang.switch');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
