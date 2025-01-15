<?php

use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ShippingAddressController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('alda');


// CRIAR LOJA
Route::middleware(['auth', 'permission:create shop'])
    ->group(function () {
        Route::get('/loja/criar', [ShopController::class, 'create'])
            ->name('shop.create');
        Route::post('/loja/criar', [ShopController::class, 'store'])
            ->name('shop.store');
});

// ATIVAR LOJA
Route::middleware(['auth', 'permission:activate shop'])
        ->group(function () {
        Route::get('/loja/ativar', [ShopController::class, 'activate'])
            ->name('shop.activate');
        Route::patch('/loja/ativar', [ShopController::class, 'update'])
            ->name('shop.activate.update');
});

// CARRINHO
Route::get('/sacola', [CartController::class, 'index'])
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
Route::get('/loja/{url}', [ShopController::class, 'show'])
    ->name('shop.show');
Route::get('/produto/{id}', [ProductController::class, 'show'])
    ->name('products.show');

// PESQUISAR PRODUTOS/LOJAS
Route::any('/busca', [SearchController::class, 'search'])
    ->name('search');

// LISTA DE CATEGORIAS
Route::get('/categorias', [CategoryController::class, 'index'])
    ->name('categories.index');

// LISTA DE PRODUTOS POR CATEGORIA
Route::get('/categorias/{category}/produtos', [CategoryController::class, 'products'])
    ->name('categories.products.index');

// USUARIOS LOGADOS
Route::middleware(['auth'])
    ->group(function () {
        Route::get('/inicio', function () {
            $categories = \App\Models\Category::query()->inRandomOrder()->limit(12)->get();
            $products = \App\Models\Product::orderBy('id', 'desc')->take(3)->get();

            return view('home', [
                'categories' => $categories,
                'products' => $products
            ]);
        })->name('home');

        // PERFIL DO USUARIO
        Route::get('/conta', [ProfileController::class, 'show'])
            ->name('profile.show');
        Route::get('/conta/dados', [ProfileController::class, 'edit'])
            ->name('profile.edit');
        Route::patch('/conta', [ProfileController::class, 'update'])
            ->name('profile.update');
        Route::delete('/conta', [ProfileController::class, 'destroy'])
            ->name('profile.destroy');

        Route::prefix('conta')
            ->name('profile.')
            ->group(function () {

                // SENHA
                Route::get('senha', [PasswordController::class, 'edit'] )
                    ->name('password.edit');
                Route::patch('senha', [PasswordController::class, 'update'] )
                    ->name('password.update');

                // ENDEREÇO DE ENTREGA
                Route::get('/enderecos', [ShippingAddressController::class, 'index'])
                    ->name('shipping-addresses.index');
                Route::get('/enderecos/adicionar', [ShippingAddressController::class, 'create'])
                    ->name('shipping-addresses.create');
                Route::post('/enderecos', [ShippingAddressController::class, 'store'])
                    ->name('shipping-addresses.store');
                Route::get('/enderecos/{shippingAddress}/editar', [ShippingAddressController::class, 'edit'])
                    ->name('shipping-addresses.edit');
                Route::patch('/enderecos/{shippingAddress}', [ShippingAddressController::class, 'update'])
                    ->name('shipping-addresses.update');
                Route::delete('/enderecos/{shippingAddress}', [ShippingAddressController::class, 'destroy'])
                    ->name('shipping-addresses.destroy');
        });

        // CHECKOUT
        Route::get('/checkout', [CheckoutController::class, 'index'])
            ->name('checkout.index');

        // ENCOMENDAS REALIZADAS
        Route::get('/pedidos', [CommissionController::class, 'index'])
            ->name('commissions.index');
        Route::get('/pedidos/{commission}', [CommissionController::class, 'show'])
            ->name('commissions.show');
        Route::post('/pedidos', [CommissionController::class, 'store'])
            ->name('commissions.store');
        Route::delete('/pedidos/{commission}', [CommissionController::class, 'destroy'])
            ->name('commissions.destroy');
});

Route::get('/mail', function () {
    $commission = App\Models\Commission::find(6);

    return new App\Mail\CommissionUpdated($commission);
});




