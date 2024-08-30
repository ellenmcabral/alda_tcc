<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ProductListController extends Controller
{
    public function index(): View
    {
        return view('products');
    }
}
