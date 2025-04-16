<?php

use App\Livewire\Plan\CreatePlan;
use App\Livewire\Plan\IndexPlan;
use App\Livewire\Plan\ReadPlan;
use App\Livewire\Plan\UpdatePlan;
use App\Livewire\Product\CreateProduct;
use App\Livewire\Product\IndexProduct;
use App\Livewire\Product\ReadProduct;
use App\Livewire\Product\UpdateProduct;
use App\Livewire\Subscription\CreateSubscription;
use App\Livewire\Subscription\IndexSubscription;
use App\Livewire\Subscription\ReadSubscription;
use App\Livewire\Subscription\UpdateSubscription;
use Illuminate\Support\Facades\Route;

Route::prefix('database')->group(function() {
    Route::prefix('products')->name('products.')->group(function() {
        Route::get('/', IndexProduct::class)->name('index');
        Route::get('/create', CreateProduct::class)->name('create');
        Route::get('/read/{id}', ReadProduct::class)->name('read');
        Route::get('/update/{id}', UpdateProduct::class)->name('update');
        Route::delete('/{id}', [IndexProduct::class, 'destroy'])->name('delete');
    });
    Route::prefix('plans')->name('plans.')->group(function() {
        Route::get('/', IndexPlan::class)->name('index');
        Route::get('/create', CreatePlan::class)->name('create');
        Route::get('/read/{id}', ReadPlan::class)->name('read');
        Route::get('/update/{id}', UpdatePlan::class)->name('update');
        Route::delete('/{id}', [IndexPlan::class, 'destroy'])->name('delete');
    });
    Route::prefix('subscriptions')->name('subscriptions.')->group(function() {
        Route::get('/', IndexSubscription::class)->name('index');
        Route::get('/create', CreateSubscription::class)->name('create');
        Route::get('/read/{id}', ReadSubscription::class)->name('read');
        Route::get('/update/{id}', UpdateSubscription::class)->name('update');
        Route::delete('/{id}', [IndexSubscription::class, 'destroy'])->name('delete');
    });
});
