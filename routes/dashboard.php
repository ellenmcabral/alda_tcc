<?php

use App\Http\Controllers\Admin\AdminIndexController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Artisan\ArtisanIndexController;
use App\Http\Controllers\Artisan\Product\ProductCreateController;
use App\Http\Controllers\Artisan\Product\ProductDeleteController;
use App\Http\Controllers\Artisan\Product\ProductEditController;
use App\Http\Controllers\Artisan\Product\ProductIndexController;
use App\Http\Controllers\Artisan\Shop\ShopAddressController;
use App\Http\Controllers\Artisan\Shop\ShopCommissionController;
use App\Http\Controllers\Artisan\Shop\ShopCustomizationController;
use App\Http\Controllers\Artisan\Shop\ShopInformationController;
use App\Http\Controllers\Artisan\Shop\ShopSettingsController;
use App\Http\Controllers\Product\ProductDetailsController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

// ADMIN

Route::middleware(['auth', 'role:admin'])
    ->name('admin.') //admin.users.edit
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [AdminIndexController::class, 'index'])->name('index');
        Route::resource('/users', UserController::class);
        Route::resource('/roles', RoleController::class);
        Route::resource('/permissions', PermissionController::class);
    });

// ARTESAO

Route::middleware(['auth', 'role:artisan'])
    ->name('artisan.') //artisan.shop.edit
    ->prefix('artisan')
    ->group(function () {

    Route::get('/home', [ArtisanIndexController::class, 'index'])->name('index');

    // CONFIGURAR LOJA
    Route::get('/shop/settings', [ShopSettingsController::class, 'settings'])->name('shop.settings');
    Route::delete('/shop', [ShopSettingsController::class, 'destroy'])->name('shop.destroy');

    Route::get('/shop/information', [ShopInformationController::class, 'edit'])->name('shop.information');
    Route::patch('/shop/information', [ShopInformationController::class, 'update'])->name('shop.information.update');

    Route::get('/shop/customization', [ShopCustomizationController::class, 'edit'])->name('shop.customization');

    Route::get('/shop/address', [ShopAddressController::class, 'edit'])->name('shop.address.edit');
    Route::patch('/shop/address/update', [ShopAddressController::class, 'update'])->name('shop.address.update');
    Route::patch('/shop/address/remove', [ShopAddressController::class, 'remove'])->name('shop.address.remove');

    // GERENCIAR ENCOMENDAS
    Route::resource('/commissions', ShopCommissionController::class)
        ->only(['index', 'show', 'update']);

    // GERENCIAR PRODUTOS
    Route::resource('/products', ProductDetailsController::class)
        ->except(['show']);

    Route::get('/products', [ProductIndexController::class, 'index'])->name('products.index');

    Route::get('/products/create', [ProductCreateController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductCreateController::class, 'store'])->name('products.store');

    Route::get('/products/{product}/edit', [ProductEditController::class, 'edit'])->name('products.edit');
    Route::patch('/products/{product}', [ProductEditController::class, 'update'])->name('products.update');

    Route::delete('/products/{product}', [ProductDeleteController::class, 'destroy'])->name('products.destroy');
});
