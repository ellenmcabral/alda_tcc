<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchType = $request->search_type;

        $searchText = $request->search_text;


        if($searchType != null) {
            if ($searchType == 'Produtos') {
                $results = Product::where('name', 'like', '%' . $searchText . '%')->paginate(10);
            } elseif ($searchType == 'Lojas') {
                $results = Shop::where('name', 'like', '%' . $searchText . '%')->paginate(10);
            }
        }

        return view('search', [
            'results' => $results,
            'searchText' => $searchText,
            'searchType' => $searchType,
            'categories' => Category::all(),
        ]);
    }
}
