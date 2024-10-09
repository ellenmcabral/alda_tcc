<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use App\Models\Product;
use App\Models\ShippingAddress;
use App\Models\Shop;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function ($trail) {
   $trail->push('Início', route('home'));
});

Breadcrumbs::for('profile', function ($trail) {
    $trail->parent('home');
    $trail->push('Minha Conta', route('profile.show'));
});

Breadcrumbs::for('profile.edit', function ($trail) {
    $trail->parent('profile');
    $trail->push('Dados Pessoais', route('profile.edit'));
});

Breadcrumbs::for('profile.password.edit', function ($trail) {
    $trail->parent('profile');
    $trail->push('Editar Senha', route('profile.password.edit'));
});


Breadcrumbs::for('shipping-addresses.index', function ($trail) {
    $trail->parent('profile');
    $trail->push('Endereços de Entrega', route('profile.shipping-addresses.index'));
});

Breadcrumbs::for('shipping-addresses.create', function ($trail) {
    $trail->parent('shipping-addresses.index');
    $trail->push('Adicionar Endereço', route('profile.shipping-addresses.create'));
});

Breadcrumbs::for('shipping-addresses.edit', function ($trail, $address) {
    $trail->parent('shipping-addresses.index');
    $trail->push('Editar Endereço', route('profile.shipping-addresses.edit', $address));
});

Breadcrumbs::for('cart', function ($trail) {
    $trail->parent('home');
    $trail->push('Sacola de Compras', route('cart'));
});

Breadcrumbs::for('checkout', function ($trail) {
    $trail->parent('cart');
    $trail->push('Finalizar Pedido', route('checkout.index'));
});

Breadcrumbs::for('commissions.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Meus Pedidos', route('commissions.index'));
});

Breadcrumbs::for('commissions.show', function ($trail, $commission) {
    $trail->parent('commissions.index');
    $trail->push('Detalhes do Pedido', route('commissions.show', $commission));
});

Breadcrumbs::for('shop.search', function ($trail) {
    $trail->parent('home');
    $trail->push("Lojas", route('search', ['search_type' => 'Lojas', 'search_text' => '']));
});

Breadcrumbs::for('shop.show', function ($trail, Shop $shop) {
    $trail->parent('shop.search');
    $trail->push($shop->name, route('shop.show', $shop->url));
});

Breadcrumbs::for('categories.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Categorias', route('categories.index'));
});

Breadcrumbs::for('categories.products.index', function ($trail, $category) {
    $trail->parent('categories.index');
    $trail->push($category->description, route('categories.products.index', $category));
});

Breadcrumbs::for('products.show', function ($trail, $category, $product) {
    $trail->parent('categories.products.index', $category);
    $trail->push($product->name, route('products.show', $product));
});

// Admin

Breadcrumbs::for('admin', function (BreadcrumbTrail $trail) {
    $trail->push('Painel de Controle do Admin', route('admin.index'));
});

Breadcrumbs::for('users', function($trail) {
   $trail->parent('admin');
   $trail->push('Usuários', route('admin.users.index'));
});

Breadcrumbs::for('users.create', function($trail) {
   $trail->parent('users');
   $trail->push('Novo Usuário', route('admin.users.create'));
});

Breadcrumbs::for('users.edit', function($trail, $user) {
   $trail->parent('users');
   $trail->push("Editar Usuário '" . $user . "'", route('admin.users.edit', $user));
});

Breadcrumbs::for('permissions', function($trail) {
    $trail->parent('admin');
    $trail->push('Permissões', route('admin.permissions.index'));
});

Breadcrumbs::for('permissions.create', function($trail) {
    $trail->parent('permissions');
    $trail->push('Criar Permissão', route('admin.permissions.create'));
});

// Artesão

Breadcrumbs::for('artisan.index', function($trail) {
    $trail->push('Painel de Controle', route('artisan.index'));
});

Breadcrumbs::for('shop.settings', function($trail) {
    $trail->parent('artisan.index');
    $trail->push("Configurações", route('artisan.shop.settings'));
});

Breadcrumbs::for('shop.information', function($trail) {
    $trail->parent('shop.settings');
    $trail->push("Informações", route('artisan.shop.information'));
});

Breadcrumbs::for('shop.customization', function($trail) {
    $trail->parent('shop.settings');
    $trail->push("Personalização", route('artisan.shop.customization'));
});

Breadcrumbs::for('shop.address.create', function($trail) {
    $trail->parent('shop.settings');
    $trail->push("Adicionar Endereço", route('artisan.shop.address.edit'));
});

Breadcrumbs::for('shop.address.edit', function($trail) {
    $trail->parent('shop.settings');
    $trail->push("Endereço", route('artisan.shop.address.edit'));
});

Breadcrumbs::for('shop.commissions.index', function ($trail) {
    $trail->parent('artisan.index');
    $trail->push('Encomendas', route('artisan.commissions.index'));
});

Breadcrumbs::for('shop.commissions.show', function ($trail, $commission) {
    $trail->parent('shop.commissions.index');
    $trail->push('Detalhes da Encomenda', route('artisan.commissions.show', $commission));
});

Breadcrumbs::for('products', function($trail) {
    $trail->parent('artisan.index');
    $trail->push('Produtos', route('artisan.products.index'));
});

Breadcrumbs::for('products.create', function($trail) {
    $trail->parent('products');
    $trail->push('Adicionar Produto', route('artisan.products.create'));
});

Breadcrumbs::for('products.edit', function($trail, $product) {
    $trail->parent('products');
    $trail->push("Editar Produto", route('artisan.products.edit', $product));
});
