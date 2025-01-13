<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Artisan\Shop\ShopAddressController;
use App\Http\Controllers\Artisan\Shop\ShopCommissionController;
use App\Http\Controllers\Artisan\Shop\ShopCustomizationController;
use App\Http\Controllers\Artisan\Shop\ShopInformationController;
use App\Http\Controllers\Artisan\Shop\ShopEditController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// ADMIN
Route::middleware(['auth', 'role:admin'])
    ->name('admin.') //admin.users.edit
    ->prefix('admin')
    ->group(function () {
        Route::get('/inicio', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])
            ->name('index');

        Route::get('/usuarios', [UserController::class, 'index'])
            ->name('users.index');
        Route::get('/usuarios/{user}/editar', [UserController::class, 'edit'])
            ->name('users.edit');
        Route::patch('/usuarios/{user}', [UserController::class, 'update'])
            ->name('users.update');
        Route::delete('/usuarios/{user}', [UserController::class, 'destroy'])
            ->name('users.destroy');

        Route::get('/lojas', [ShopController::class, 'index'])
            ->name('shops.index');
        Route::get('/lojas/{shop}/editar', [ShopController::class, 'edit'])
            ->name('shops.edit');
        Route::patch('/lojas/{shop}', [ShopController::class, 'update'])
            ->name('shops.update');
        Route::delete('/lojas/{shop}', [ShopController::class, 'destroy'])
            ->name('shops.destroy');

        Route::resources([
           'roles' => RoleController::class,
           'permissions' => PermissionController::class,
        ]);
    });

// ARTESAO
Route::middleware(['auth', 'role:artisan'])
    ->name('artisan.') //artisan.shop.edit
    ->prefix('artesao')
    ->group(function () {

    Route::get('/inicio', [\App\Http\Controllers\Artisan\DashboardController::class, 'index'])
        ->name('index');

    // CONFIGURAR LOJA
    Route::get('/loja', [ShopEditController::class, 'edit'])
        ->name('shop.edit');
    Route::delete('/loja', [ShopEditController::class, 'destroy'])
        ->name('shop.destroy');

    Route::get('/loja/info', [ShopEditController::class, 'information'])
        ->name('shop.information');
    Route::patch('/loja/info', [ShopEditController::class, 'updateInformation'])
        ->name('shop.information.update');

    Route::get('/loja/personalizar', [ShopEditController::class, 'customization'])
        ->name('shop.customization');
    Route::patch('/loja/personalizar', [ShopEditController::class, 'updateCustomization'])
        ->name('shop.customization.update');

    Route::get('/loja/endereco', [ShopAddressController::class, 'edit'])
        ->name('shop.address.edit');
    Route::patch('/loja/endereco/editar', [ShopAddressController::class, 'update'])
        ->name('shop.address.update');
    Route::patch('/loja/endereco/remover', [ShopAddressController::class, 'remove'])
        ->name('shop.address.remove');

    // GERENCIAR ENCOMENDAS
    Route::get('/encomendas', [ShopCommissionController::class, 'index'])
        ->name('commissions.index');
    Route::get('/encomendas/{commission}', [ShopCommissionController::class, 'show'])
        ->name('commissions.show');
    Route::patch('/encomendas/{commission}', [ShopCommissionController::class, 'update'])
        ->name('commissions.update');

    // GERENCIAR PRODUTOS
    Route::get('/produtos', [ProductController::class, 'index'])
        ->name('products.index');

    Route::get('/produtos/excluidos', function () {

        $deletedProducts = \App\Models\Product::where('is_active', false)->paginate(15);

        return view('artisan.products.deleted-products', [
            'products' => $deletedProducts,
            'shop' => Auth::user()->shop,
        ]);
    })->name('products.deleted-products');

    Route::get('/produtos/adicionar', [ProductController::class, 'create'])
        ->name('products.create');
    Route::post('/produtos', [ProductController::class, 'store'])
        ->name('products.store');
    Route::get('/produtos/{product}', [ProductController::class, 'show'])
        ->name('products.show');
    Route::get('/produtos/{product}/editar', [ProductController::class, 'edit'])
        ->name('products.edit');
    Route::patch('/produtos/{product}', [ProductController::class, 'update'])
        ->name('products.update');
    Route::patch('/produtos/{product}/deletar', [ProductController::class, 'delete'])
        ->name('products.delete');

    Route::patch('/produtos/{product}/ativar', [ProductController::class, 'activate'])
        ->name('products.activate');
});
