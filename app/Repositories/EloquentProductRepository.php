<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class EloquentProductRepository extends EloquentBaseRepository implements ProductRepositoryInterface
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function getProductsByShopId(int $id)
    {
        return Product::where('shop_id', $id)->orderBy('id', 'DESC')->paginate(10);
    }

    public function findProductByName(string $name)
    {
        return Product::where('name', $name)->first();
    }

    /*public function add(Request $request)
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
    }*/
}
