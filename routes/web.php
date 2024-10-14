<?php

use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Shop\ShopController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ShippingAddressController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('alda');


// CRIAR LOJA
Route::middleware(['auth', 'permission:create shop'])
    ->group(function () {
        Route::get('/shop/create', [ShopController::class, 'create'])
            ->name('shop.create');
        Route::post('/shop/create', [ShopController::class, 'store'])
            ->name('shop.store');
});

// ATIVAR LOJA
Route::middleware(['auth', 'permission:activate shop'])
        ->group(function () {
        Route::get('/shop/activate', [ShopController::class, 'activate'])
            ->name('shop.activate');
        Route::patch('/shop/activate', [ShopController::class, 'update'])
            ->name('shop.activate.update');
});

// CARRINHO
Route::get('/cart', [CartController::class, 'index'])
    ->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])
    ->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'delete'])
    ->name('cart.remove');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])
    ->name('cart.update');
Route::get('/cart/destroy', [CartController::class, 'destroy'])
    ->name('cart.destroy');

// PAGINAS DE LOJA / PRODUTO
Route::get('/shop/{url}', [ShopController::class, 'show'])
    ->name('shop.show');
Route::get('/products/{id}', [ProductController::class, 'show'])
    ->name('products.show');

// PESQUISAR PRODUTOS/LOJAS
Route::any('/search', [SearchController::class, 'search'])
    ->name('search');

// LISTA DE CATEGORIAS
Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories.index');

// LISTA DE PRODUTOS POR CATEGORIA
Route::get('/categories/{category}/products', [CategoryController::class, 'products'])
    ->name('categories.products.index');

// USUARIOS LOGADOS
Route::middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/home', function () {
            $categories = \App\Models\Category::all()->take(12);
            $products = \App\Models\Product::orderBy('id', 'desc')->take(3)->get();

            return view('home', [
                'categories' => $categories,
                'products' => $products
            ]);
        })->name('home');

        // PERFIL DO USUARIO
        Route::singleton('/profile', ProfileController::class)
            ->destroyable();

        Route::prefix('profile')
            ->name('profile.')
            ->group(function () {

                Route::get('password/edit', [PasswordController::class, 'edit'] )
                    ->name('password.edit');
                Route::patch('password', [PasswordController::class, 'update'] )
                    ->name('password.update');

                // EDITAR ENDEREÇO DE ENTREGA
                Route::resource('/shipping-addresses', ShippingAddressController::class)
                    ->except('show');
        });

        // CHECKOUT
        Route::get('/checkout', [CheckoutController::class, 'index'])
            ->name('checkout.index');

        // ENCOMENDAS REALIZADAS
        Route::resource('/commissions', CommissionController::class)
            ->except(['create', 'edit', 'update']);
});

Route::get('/mail', function () {
    $commission = App\Models\Commission::find(6);

    return new App\Mail\CommissionUpdated($commission);
});




