<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\View\View;

class CategoryProductListController extends Controller
{
    public function index(Category $category): View
    {
        $products = $category->products()
            ->paginate(10);

        return view('categories.products.index', [
            'category' => $category,
            'products' => $products,
        ]);
    }
}
