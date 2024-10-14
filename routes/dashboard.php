<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Artisan\Shop\ShopAddressController;
use App\Http\Controllers\Artisan\Shop\ShopCommissionController;
use App\Http\Controllers\Artisan\Shop\ShopCustomizationController;
use App\Http\Controllers\Artisan\Shop\ShopInformationController;
use App\Http\Controllers\Artisan\Shop\ShopSettingsController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// ADMIN
Route::middleware(['auth', 'role:admin'])
    ->name('admin.') //admin.users.edit
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])
            ->name('index');

        Route::resources([
           'users' => UserController::class,
           'roles' => RoleController::class,
           'permissions' => PermissionController::class,
        ]);
    });

// ARTESAO
Route::middleware(['auth', 'role:artisan'])
    ->name('artisan.') //artisan.shop.edit
    ->prefix('artisan')
    ->group(function () {

    Route::get('/home', [\App\Http\Controllers\Artisan\DashboardController::class, 'index'])
        ->name('index');

    // CONFIGURAR LOJA
    Route::get('/shop', [ShopSettingsController::class, 'settings'])
        ->name('shop.settings');
    Route::delete('/shop', [ShopSettingsController::class, 'destroy'])
        ->name('shop.destroy');

    Route::get('/shop/information', [ShopInformationController::class, 'edit'])
        ->name('shop.information');
    Route::patch('/shop/information', [ShopInformationController::class, 'update'])
        ->name('shop.information.update');

    Route::get('/shop/customization', [ShopCustomizationController::class, 'edit'])
        ->name('shop.customization');
    Route::patch('/shop/customization', [ShopCustomizationController::class, 'update'])
        ->name('shop.customization.update');

    Route::get('/shop/address', [ShopAddressController::class, 'edit'])
        ->name('shop.address.edit');
    Route::patch('/shop/address/update', [ShopAddressController::class, 'update'])
        ->name('shop.address.update');
    Route::patch('/shop/address/remove', [ShopAddressController::class, 'remove'])
        ->name('shop.address.remove');

    // GERENCIAR ENCOMENDAS
    Route::resource('/commissions', ShopCommissionController::class)
        ->only(['index', 'show', 'update']);

    // GERENCIAR PRODUTOS
    Route::resource('/products', ProductController::class)
        ->except(['show']);
});
