<?php

namespace App\Http\Controllers\Artisan\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductEditController extends Controller
{
    public function edit(Product $product): View
    {
        return view('artisan.products.edit', [
            'product' => $product,
            'categories' => Category::orderBy('description', 'asc')->get(),
        ]);
    }

    public function update(Product $product, Request $request): RedirectResponse
    {
        $product->fill($request->validate([
            'name' => ['required', 'string', 'min:3', 'max:150'],
            'sale_price' => ['required'],
            'category_id' => ['required'],
        ]));

        if($request->description == null) {
            $product->description = null;
        }

        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName()
                    . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/products'), $imageName);

            $product->image = $imageName;
        }

        $product->save();

        return redirect(route('artisan.products.edit', $product->id))
            ->with('status', 'profile-updated');
    }
}
