<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CheckOutController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(HomeController::class)->group(function () {
    Route::middleware('api')->get('/traducciones/{traduccion}/{locale}' , 'traducciones')->name('traduccion.main');
    Route::middleware('api')->get('/categories/{locale}' , 'categories')->name('categories');
    Route::middleware('api')->get('/languages/{locale}' , 'languages')->name('languages');
    Route::middleware('api')->get('/banners/' , 'banners')->name('banners');
});

Route::controller(CheckOutController::class)->group(function () {
    Route::middleware('api')->post('/create-checkout-session' , 'checkout')->name('checkoutSession');
    Route::middleware('api')->post('/payment', 'payment')->name('checkout.payment');
    Route::middleware('api')->get('/payments/intent/{cart}', 'paymentIntent')->name('checkout.intent');
});

Route::controller(CarritoController::class)->group(function () {
    Route::middleware(['api'])->post('/cart/save' , 'saveCart')->name('save.cart');
});

Route::controller(ProductController::class)->group(function () {
    Route::middleware('api')->get('/reviews/{product}' , 'reviews')->name('reviews');
    Route::middleware('api')->post('/reviews/save' , 'reviewsSave');
    Route::middleware('api')->get('/images/{product}' , 'images')->name('images');
    Route::middleware('api')->get('/models/{product}' , 'modelsByProduct')->name('models.product');
    Route::middleware('api')->get('/colors/{product}' , 'colorsByModel')->name('colors.product');
    Route::middleware('api')->post('/product/inventario' , 'validateStock')->name('inventario');
    Route::middleware('api')->get('/product/inventario/{product}/{modelo}' , 'validateStockTest')->name('inventario.test');
    Route::middleware('api')->get('/product/colors/{product}/{model}' , 'colorsByModel')->name('colors.model');
    Route::middleware('api')->post('/detail/product/' , 'products')->name('all.products');
    Route::middleware('api')->get('/model/browser/{slug?}' , 'getModelsBrowser')->name('models.browser');

});



