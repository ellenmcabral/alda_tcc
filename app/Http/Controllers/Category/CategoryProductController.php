<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\View\View;

class CategoryProductController extends Controller
{
    public function index(Category $category): View
    {
        $products = $category->products()
            ->paginate(10);

        return view('categories.products.index', [
            'category' => $category,
            'results' => $products,
        ]);
    }
}
