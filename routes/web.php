<?php

use App\Http\Controllers\PaymentCallbackController;
use App\Livewire\Afiliasi\IndexAfiliasi;
use App\Livewire\Authentication\Daftar;
use App\Livewire\Dashboard\IndexDashboard;
use App\Livewire\DigitalProduct\CheckoutDigitalProduct;
use App\Livewire\DigitalProduct\CreateDigitalProduct;
use App\Livewire\DigitalProduct\IndexDigitalProduct;
use App\Livewire\DigitalProduct\InvoiceDigitalProduct;
use App\Livewire\DigitalProduct\ReadDigitalProduct;
use App\Livewire\DigitalProduct\TransactionDigitalProduct;
use App\Livewire\DigitalProduct\UpdateDigitalProduct;
use App\Livewire\Member\CreateMember;
use App\Livewire\Member\IndexMember;
use App\Livewire\Member\ReadMember;
use App\Livewire\Member\UpdateMember;
use App\Livewire\Transaksi\IndexTransaksi;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware(['auth'])->group(function () {
    Route::get('/', IndexDashboard::class)->name('home');
    Route::get('dashboard', IndexDashboard::class)->name('dashboard');

    foreach (glob(__DIR__ . '/partials/*.php') as $file) {
        require $file;
    }

    Route::prefix('digital-products')->name('digital-products.')->group(function() {
        Route::get('/', IndexDigitalProduct::class)->name('index');
        Route::get('/create', CreateDigitalProduct::class)->name('create');
        Route::get('/read/{id}', ReadDigitalProduct::class)->name('read');
        Route::get('/update/{id}', UpdateDigitalProduct::class)->name('update');
        Route::delete('/{id}', [IndexDigitalProduct::class, 'destroy'])->name('delete');
        Route::get('/checkout/{id}', CheckoutDigitalProduct::class)->name('checkout');
        Route::get('/transaction/{id}/reference/{ref}', TransactionDigitalProduct::class)->name('transaction');
        Route::get('/invoice/{reference}', InvoiceDigitalProduct::class)->name('invoice');
    });

    Route::prefix('members')->name('members.')->group(function() {
        Route::get('/', IndexMember::class)->name('index');
        Route::get('/create', CreateMember::class)->name('create');
        Route::get('/read/{id}', ReadMember::class)->name('read');
        Route::get('/update/{id}', UpdateMember::class)->name('update');
        Route::delete('/{id}', [IndexMember::class, 'destroy'])->name('delete');
    });

    Route::prefix('transactions')->name('transactions.')->group(function() {
        Route::get('/', IndexTransaksi::class)->name('index');
    });

    Route::prefix('affiliations')->name('affiliations.')->group(function() {
        Route::get('/', IndexAfiliasi::class)->name('index');
    });


    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
