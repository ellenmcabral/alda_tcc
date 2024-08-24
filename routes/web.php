<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Commission\CartController;
use App\Http\Controllers\Commission\CheckoutController;
use App\Http\Controllers\Commission\CommissionController;
use App\Http\Controllers\Product\CategoryProductController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Shop\ShopActivateController;
use App\Http\Controllers\Shop\ShopAddressController;
use App\Http\Controllers\Shop\ShopCommissionController;
use App\Http\Controllers\Shop\ShopController;
use App\Http\Controllers\Shop\ShopCustomizationController;
use App\Http\Controllers\Shop\ShopInformationController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ProfileInformationController;
use App\Http\Controllers\User\ShippingAddressController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('alda');


// USUARIO COMUM

Route::middleware(['auth', 'permission:create shop'])->group(function () {
    // CRIAR LOJA
    Route::get('/shop/create', [ShopController::class, 'create'])->name('shops.create');
    Route::post('/shop/create', [ShopController::class, 'store'])->name('shops.store');
});

Route::middleware(['auth', 'permission:activate shop'])->group(function () {
    // ATIVAR LOJA
    Route::get('/shop/activate', [ShopActivateController::class, 'form'])->name('shops.activate-form');
    Route::patch('/shop/activate', [ShopActivateController::class, 'activate'])->name('shops.activate');
});

// DESLOGADO

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'delete'])->name('cart.remove');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/destroy', [CartController::class, 'destroy'])->name('cart.destroy');

Route::get('/shop/{url}', [ShopController::class, 'show'])->name('shops.show');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// ADMIN

Route::middleware(['auth', 'role:admin'])
    ->name('admin.') //admin.users.edit
    ->prefix('admin')
    ->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::resource('/users', UserController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);
});

// TODOS
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', function () {
        $categories = \App\Models\Category::all()->take(10);
        $products = \App\Models\Product::orderBy('id', 'desc')->take(3)->get();

        return view('home', [
            'categories' => $categories,
            'products' => $products
        ]);
    })->name('home');

    Route::get('/categories', function () {
        $categories = \App\Models\Category::all();

        return view('categories.index', ['categories' => $categories]);
    })->name('categories.index');

    // PESQUISAR PRODUTOS/LOJAS
    Route::get('/search', [SearchController::class, 'search'])->name('search-results');

    Route::get('/categories/{category}/products', [CategoryProductController::class, 'index'])->name('categories.products.index');
    Route::get('/shops', [ShopController::class, 'index'])->name('shops.index');

    // EDITAR PERFIL DO USUARIO
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::get('/profile/password', [PasswordController::class, 'edit'] )->name('profile.password.edit');
    Route::get('/profile/information', [ProfileInformationController::class, 'edit'] )->name('profile.information.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // EDITAR ENDEREÇO DE ENTREGA
    Route::get('/profile/shipping-addresses', [ShippingAddressController::class, 'index'] )->name('profile.shipping-address.index');
    Route::get('/profile/shipping-address/create', [ShippingAddressController::class, 'create'] )->name('profile.shipping-address.create');
    Route::post('/profile/shipping-address', [ShippingAddressController::class, 'store'])->name('shipping-address.store');
    Route::get('/profile/shipping-address/{id}/edit', [ShippingAddressController::class, 'edit'])->name('profile.shipping-address.edit');
    Route::patch('/profile/shipping-address/{id}', [ShippingAddressController::class, 'update'])->name('shipping-address.update');
    Route::delete('/profile/shipping-address/{id}', [ShippingAddressController::class, 'destroy'])->name('shipping-address.destroy');

    // CHECKOUT
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

    // ENCOMENDAS REALIZADAS
    Route::resource('/commissions', CommissionController::class)
        ->only(['store', 'index', 'show', 'destroy']);
});

Route::get('/mail', function () {
    $commission = App\Models\Commission::find(6);

    return new App\Mail\CommissionUpdated($commission);
});

// ARTESAO
Route::middleware(['auth', 'role:artisan'])
    ->name('artisan.') //artisan.shops.edit
    ->prefix('artisan')
    ->group(function () {

    Route::get('/home', [\App\Http\Controllers\Artisan\IndexController::class, 'index'])->name('index');

    // CONFIGURAR LOJA
    Route::get('/shop', [ShopController::class, 'edit'])->name('shops.edit');
    Route::delete('/shop', [ShopController::class, 'destroy'])->name('shops.destroy');

    Route::get('/shop/information', [ShopInformationController::class, 'edit'])->name('shops.information.edit');
    Route::patch('/shop/information', [ShopInformationController::class, 'update'])->name('shops.information.update');

    Route::get('/shop/customization', [ShopCustomizationController::class, 'edit'])->name('shops.customization.edit');

    Route::get('/shop/address', [ShopAddressController::class, 'edit'])->name('shops.address.edit');
    Route::patch('/shop/address/update', [ShopAddressController::class, 'update'])->name('shops.address.update');
    Route::patch('/shop/address/remove', [ShopAddressController::class, 'remove'])->name('shops.address.remove');

    // GERENCIAR ENCOMENDAS
    Route::resource('/commissions', ShopCommissionController::class)
        ->only(['index', 'show', 'update']);

    // GERENCIAR PRODUTOS
    Route::resource('/products', ProductController::class)
        ->except(['show']);


});

require __DIR__.'/auth.php';


