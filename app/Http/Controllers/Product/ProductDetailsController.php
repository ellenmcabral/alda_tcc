<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class ProductDetailsController extends Controller
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
