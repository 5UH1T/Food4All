<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Vendor\VendorPageController;
use App\Http\Controllers\Customer\CustomerPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified', 'rolemanager:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/attributes', [AdminPageController::class, 'attributes'])->name('attributes');
        Route::get('/categories', [AdminPageController::class, 'categories'])->name('categories');
        Route::get('/', [AdminPageController::class, 'index'])->name('dashboard');
        Route::get('/orders', [AdminPageController::class, 'orders'])->name('orders');
        Route::get('/payments', [AdminPageController::class, 'payments'])->name('payments');
        Route::get('/settings', [AdminPageController::class, 'settings'])->name('settings');
        Route::get('/users', [AdminPageController::class, 'users'])->name('users');
        Route::get('/vendors', [AdminPageController::class, 'vendors'])->name('vendors');

});

Route::middleware(['auth', 'verified', 'rolemanager:vendor'])
    ->prefix('vendor')
    ->name('vendor.')
    ->group(function () {

        Route::get('/products', [VendorPageController::class, 'products'])->name('products');
        Route::get('/categories', [VendorPageController::class, 'categories'])->name('categories');
        Route::get('/', [VendorPageController::class, 'index'])->name('dashboard');
        Route::get('/orders', [VendorPageController::class, 'orders'])->name('orders');
        Route::get('/payments', [VendorPageController::class, 'payments'])->name('payments');
        Route::get('/settings', [VendorPageController::class, 'settings'])->name('settings');
});


Route::middleware(['auth', 'verified', 'rolemanager:customer'])
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {
        Route::get('/orders', [CustomerPageController::class, 'orders'])->name('orders');
        Route::get('/payments', [CustomerPageController::class, 'payments'])->name('payments');
        Route::get('/', [CustomerPageController::class, 'profile'])->name('profile');
});

// Route::get('/vendor/dashboard', function () {
//     return view('vendor-dashboard');
// })->middleware(['auth', 'verified','rolemanager:vendor'])->name('vendor');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified','rolemanager:user'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
