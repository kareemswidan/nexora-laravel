<?php

use App\Http\Controllers\AiController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

Route::get('/language/{locale}', function (string $locale) {
    abort_unless(in_array($locale, ['en', 'ar'], true), 404);
    session(['locale' => $locale]);
    return back();
})->name('language');

Route::get('/', [StoreController::class, 'home'])->name('home');
Route::get('/shop', [StoreController::class, 'shop'])->name('shop');
Route::get('/product/{product}', [StoreController::class, 'product'])->name('product');
Route::view('/about', 'about')->name('about');
Route::get('/ai', [AiController::class, 'index'])->name('ai');
Route::post('/ai', [AiController::class, 'recommend'])->name('ai.recommend');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/{product}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->middleware('throttle:10,1')->name('checkout.store');
Route::get('/order/success/{order}', [CheckoutController::class, 'success'])->middleware(['signed', 'throttle:30,1'])->name('order.success');
Route::get('/orders/track', [CheckoutController::class, 'trackForm'])->name('orders.track');
Route::post('/orders/track', [CheckoutController::class, 'track'])->middleware('throttle:10,1')->name('orders.find');

