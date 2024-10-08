<?php

use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryProductListController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Commission\CommissionDeleteController;
use App\Http\Controllers\Commission\CommissionDetailsController;
use App\Http\Controllers\Commission\CommissionListController;
use App\Http\Controllers\Commission\CommissionStoreController;
use App\Http\Controllers\Product\ProductListController;
use App\Http\Controllers\Product\ProductDetailsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Shop\ShopActivateController;
use App\Http\Controllers\Shop\ShopCreateController;
use App\Http\Controllers\Shop\ShopDetailsController;
use App\Http\Controllers\Shop\ShopListController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ProfileInformationController;
use App\Http\Controllers\User\ShippingAddressController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('alda');


// CRIAR LOJA

Route::middleware(['auth', 'permission:create shop'])->group(function () {
    Route::get('/shop/create', [ShopCreateController::class, 'create'])->name('shop.create');
    Route::post('/shop/create', [ShopCreateController::class, 'store'])->name('shop.store');
});

// ATIVAR LOJA

Route::middleware(['auth', 'permission:activate shop'])->group(function () {
    Route::get('/shop/activate', [ShopActivateController::class, 'activate'])->name('shop.activate');
    Route::patch('/shop/activate', [ShopActivateController::class, 'update'])->name('shop.activate.update');
});

// CARRINHO

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'delete'])->name('cart.remove');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/destroy', [CartController::class, 'destroy'])->name('cart.destroy');

// PAGINAS DE LOJA / PRODUTO

Route::get('/shop/{url}', [ShopDetailsController::class, 'show'])->name('shop.show');
Route::get('/products/{id}', [ProductDetailsController::class, 'show'])->name('products.show');

Route::get('/categories', function () {
    $categories = \App\Models\Category::all();

    return view('categories.index', [
        'categories' => $categories
    ]);
})->name('categories.index');

// PESQUISAR PRODUTOS/LOJAS
Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/categories/{category}/products', [CategoryProductListController::class, 'index'])->name('categories.products.index');

// USUARIOS LOGADOS

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', function () {
        $categories = \App\Models\Category::all()->take(12);
        $products = \App\Models\Product::orderBy('id', 'desc')->take(3)->get();

        return view('home', [
            'categories' => $categories,
            'products' => $products
        ]);
    })->name('home');

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

    //Route::resource('/commissions', CommissionController::class)
    //    ->only(['store', 'index', 'show', 'destroy']);

    Route::post('/commissions', [CommissionStoreController::class, 'store'])->name('commissions.store');
    Route::get('/commissions', [CommissionListController::class, 'index'])->name('commissions.index');
    Route::get('/commissions/{commission}', [CommissionDetailsController::class, 'show'])->name('commissions.show');
    Route::delete('/commissions/{commission}', [CommissionDeleteController::class, 'destroy'])->name('commissions.destroy');

});

Route::get('/mail', function () {
    $commission = App\Models\Commission::find(6);

    return new App\Mail\CommissionUpdated($commission);
});




