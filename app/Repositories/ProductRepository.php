<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductRepository
{
    public function add(Request $request): Product
    {
        $request->validate([
            'image' => ['required'],
            'name' => ['required', 'string', 'min:3', 'max:150'],
            'url' => ['alpha'],
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
            $imageName = 'no-image.jpg';
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

        return $product;
    }
}
