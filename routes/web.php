<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Vendor\VendorPageController;
use App\Http\Controllers\Vendor\VendorProfileController;
use App\Http\Controllers\Customer\CustomerProfileController;
use App\Http\Controllers\Customer\CustomerPageController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SubCategoriesController;
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

use App\Http\Controllers\EsewaController;

Route::get('/esewa/pay/{order}',
    [EsewaController::class,'pay'])
    ->name('esewa.pay');

Route::get('/esewa/success',
    [EsewaController::class,'success'])
    ->name('esewa.success');

Route::get('/esewa/failure',
    [EsewaController::class,'failure'])
    ->name('esewa.failure');


Route::get('/', [GuestController::class, 'getHomeItems'])->name('home');
Route::get('/autocomplete', [GuestController::class, 'autocomplete'])->name('autocomplete');

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart');

Route::put('/cart/update', [CartController::class, 'update'])->name('cart.update');

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

Route::delete('/cart/{id}', [CartController::class, 'destroy'])
    ->name('cart.destroy');

Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout');

Route::get('/products', function () {
    return view('product-category');
});

Route::get('/product', function () {
    return view('product');
});

Route::middleware(['auth', 'verified', 'rolemanager:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/attributes', [AdminPageController::class, 'attributes'])->name('attributes');
        Route::get('/categories', [AdminPageController::class, 'categories'])->name('categories');
        Route::get('/', [AdminPageController::class, 'index'])->name('dashboard');
        Route::get('/orders', [AdminPageController::class, 'orders'])->name('orders');
        Route::patch('/orders/{order}/status', [AdminPageController::class, 'updateItemStatus'])->name('orders.updateStatus');
        Route::get('/payments', [AdminPageController::class, 'payments'])->name('payments');
        Route::get('/settings', [AdminPageController::class, 'settings'])->name('settings');
        Route::get('/users', [AdminPageController::class, 'users'])->name('users');
        Route::get('/vendors', [AdminPageController::class, 'vendors'])->name('vendors');
        Route::get('/donations', [AdminPageController::class, 'donations'])->name('donations');
        Route::post('/categories/create', [CategoriesController::class, 'addCategory'])->name('createCategory');
        Route::get('/categories/{id}', [CategoriesController::class, 'showCategory'])->name('showCategory');
        Route::put('/categories/{id}', [CategoriesController::class, 'updateCategory'])->name('updateCategory');
        Route::delete('/categories/{id}', [CategoriesController::class, 'deleteCategory'])->name('deleteCategory');

});

Route::middleware(['auth', 'verified', 'rolemanager:vendor'])
    ->prefix('store')
    ->name('vendor.')
    ->group(function () {

        Route::get('/products/create', [VendorPageController::class, 'createProducts'])->name('createProducts');
        Route::get('/', [VendorPageController::class, 'index'])->name('dashboard');
        Route::get('/orders', [VendorPageController::class, 'orders'])->name('orders');
        Route::patch('/orders/{order}/status', [VendorPageController::class, 'updateItemStatus'])->name('orders.updateStatus');
        Route::get('/payments', [VendorPageController::class, 'payments'])->name('payments');
        Route::get('/products', [VendorPageController::class, 'products'])->name('products');
        Route::get('/subcategories/{categoryId}', [ProductsController::class, 'getSubCategories'])->name('getSubCategories');
        Route::post('/products/create', [ProductsController::class, 'store'])->name('createProduct');
        Route::get('/products/{product}/edit', [VendorPageController::class, 'editProduct'])->name('products.edit');
        Route::put('/products/{product}', [VendorPageController::class, 'updateProduct'])->name('products.update');
        Route::delete('/products/{product}', [VendorPageController::class, 'deleteProduct'])->name('products.delete');
        Route::get('/categories', [VendorPageController::class, 'categories'])->name('categories');
        Route::post('/categories/create', [SubCategoriesController::class, 'addCategory'])->name('createCategory');
        Route::put('/categories/{id}', [SubCategoriesController::class, 'updateCategory'])->name('updateCategory');
        Route::delete('/categories/{id}', [SubCategoriesController::class, 'deleteCategory'])->name('deleteCategory');
        Route::get('/settings', [VendorProfileController::class, 'edit'])
            ->name('settings');

        Route::put('/settings', [VendorProfileController::class, 'update'])
            ->name('updateProfile');
});


Route::middleware(['auth', 'verified', 'rolemanager:customer'])
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {
        Route::get('/orders', [CustomerPageController::class, 'orders'])->name('orders');
        Route::get('/payments', [CustomerPageController::class, 'payments'])->name('payments');
        Route::get('/donations', [CustomerPageController::class, 'donations'])->name('donations');
        // Route::get('/', [CustomerPageController::class, 'profile'])->name('profile');
        Route::get('/', [CustomerProfileController::class, 'edit'])
            ->name('profile');

        Route::put('/', [CustomerProfileController::class, 'update'])
            ->name('updateProfile');
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

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    Lfm::routes();
});

require __DIR__.'/auth.php';
Route::get('/{id}', [GuestController::class, 'productDetails'])->name('product');
