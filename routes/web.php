<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\ToyController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

// Route::post('test', [AppController::class, 'test'])->name('test');

Route::controller(AppController::class)->group(function(){

    Route::get('/', 'home')->name('home');
    Route::get('product', 'menu')->name('product.menu');
    Route::get('search', 'search')->name('product.search');
    Route::get('product/filter/{category}', 'filterMenu')->name('product.filter');
    Route::get('about', 'about')->name('about');
    // Route::get('about', [AppController::class, 'about'])->name('about');

    Route::middleware('guest')->group(function (){
        Route::get('login', 'login')->name('login');
        Route::post('login', 'user_login')->name('user.login');

        Route::get('register', 'register')->name('register');
        Route::post('register', 'user_register')->name('user.register');
    });


    Route::middleware('auth')->group(function (){
        Route::post('logout', 'user_logout')->name('user.logout');
        Route::get('admin', 'admin')->name('admin.home')->middleware('admin');
        Route::get('admin/filter/{category}', 'filterAdmin')->name('admin.filter')->middleware('admin');
        Route::get('addFund', 'addMoney')->name('user.money');
        Route::post('addFund/money', 'money')->name('user.money.add');
    });
});

Route::get('order/clear', [ToyController::class, 'clearOrder'])->name('toy.order.clear');

Route::prefix('toy')->controller(ToyController::class)->group(function(){

    Route::get('detail/{toy}', 'detail')->name('product.detail');

    Route::middleware('admin')->group(function(){
        Route::get('create', 'create')->name('admin.create');
        Route::post('store', 'store')->name('toy.store');

        Route::get('edit/{toy}', 'edit')->name('toy.edit');
        Route::post('update/{toy}', 'update')->name('toy.update');

        Route::delete('delete/{toy}', 'delete')->name('toy.delete');
    });

    Route::middleware('auth')->group(function () {
        Route::get('order/{toy}', 'order')->name('toy.order'); //landing
        Route::post('oorder', 'addOrder')->name('detail.order'); //detail
        Route::delete('order/delete/{id}', 'deleteOrder')->name('toy.order.delete');
    });
});

Route::controller(CheckoutController::class)->group(function(){
    Route::get('cart', 'cart')->name('cart')->middleware('auth');
    Route::post('carte', 'Cartcheckout')->name('cart.checkout')->middleware('auth');
    Route::post('buy', 'checkout')->name('checkout');
});

Route::controller(InvoiceController::class)->group(function(){
    Route::get('invoice', 'index')->name('invoice')->middleware('auth');
});
