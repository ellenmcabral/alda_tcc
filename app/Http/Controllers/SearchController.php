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
        try {
            $searchType = $request->input('search_type');

            $searchText = $request->input('search_text');

            if($searchType != null) {
                if($searchType == 'Produtos') {
                    $model = new Product();
                }
                elseif($searchType == 'Lojas') {
                    $model = new Shop();
                }
            }

            if($model) {
                $results = $model::where('name', 'like', '%' . $searchText . '%')->paginate(10);
            }

            return view('search', [
                'results' => $results,
                'searchText' => $searchText,
                'searchType' => $searchType,
                'categories' => Category::all(),
            ]);
        } catch(\Exception $e) {
            return back();
        }
    }
}
