<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchType = $request->search_type;

        $searchText = $request->search_text;

        if ($searchType == 'Produtos') {
            $results = Product::where('name', 'like', '%' . $searchText . '%');
        }
        elseif ($searchType == 'Lojas') {
            $results = Shop::where('name', 'like', '%' . $searchText . '%');
        } else {
            return view('errors.404');
        }

        return view('search', [
            'results' => $results,
            'searchText' => $searchText,
            'searchType' => $searchType,
            'categories' => Category::orderBy('description', 'asc')->get(),
        ]);
    }
}
