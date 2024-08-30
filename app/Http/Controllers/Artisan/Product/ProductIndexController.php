<?php

namespace App\Http\Controllers\Artisan\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductIndexController extends Controller
{
    public function index(Request $request): View
    {
        $products = $request->user()->shop->products()->paginate(10);

        return view('artisan.products.index', [
            'shop' => $request->user()->shop,
            'products' => $products,
        ]);
    }
}
