<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\View\View;

class ProductShowController extends Controller
{
    public function show($id): View
    {
        $product = Product::where('id', $id)->firstOrFail();

        return view('products.show', [
            'product' => $product,
            'shop' => $product->shop,
        ]);
    }
}
