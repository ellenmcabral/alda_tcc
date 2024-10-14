<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = \App\Models\Category::all();

        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    public function products(Category $category): View
    {
        $products = $category->products()
            ->paginate(10);

        return view('categories.products.index', [
            'category' => $category,
            'results' => $products,
        ]);
    }
}
