<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::orderBy('description', 'asc')->get();

        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    public function products(Category $category): View
    {
        $products = $category->products()->get();

        return view('categories.products.index', [
            'category' => $category,
            'results' => $products,
        ]);
    }
}
