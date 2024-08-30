<?php

namespace App\Http\Controllers\Artisan\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductCreateController extends Controller
{
    public function create(Request $request): View
    {
        return view('artisan.products.create', [
            'shop_id' => $request->user()->shop->id,
            'categories' => Category::orderBy('description', 'asc')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => ['required'],
            'name' => ['required', 'string', 'alpha', 'min:3', 'max:150'],
            'sale_price' => ['required'],
            'category_id' => ['required'],
        ]);

        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName()
                    . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/products'), $imageName);
        } else {
            $imageName = 'product-image.jpg';
        }

        $product = Product::create([
            'name' => $request->name,
            'image' => $imageName,
            'url' => str_replace(' ', '-', $request->name),
            'sale_price' => $request->sale_price,
            'description' => $request->description,
            'shop_id' => $request->user()->shop->id,
            'category_id' => $request->category_id,
        ]);

        return redirect(route('artisan.products.index'));
    }
}
