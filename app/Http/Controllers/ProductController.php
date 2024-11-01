<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $products = $request->user()->shop->products()->orderBy('id', 'desc')->paginate(10);

        return view('artisan.products.index', [
            'shop' => $request->user()->shop,
            'products' => $products,
        ]);
    }

    public function create(): View
    {
        return view('artisan.products.create', [
            'categories' => Category::orderBy('description', 'asc')->get(),
        ]);
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        $defaultImage = md5($request->images[0]->getClientOriginalName()
                . strtotime("now")) . "." . $request->images[0]->extension();

        $product = Product::create([
            'name' => $request->name,
            'image' => $defaultImage,
            'sale_price' => $request->sale_price,
            'description' => $request->description,
            'shop_id' => $request->user()->shop->id,
            'category_id' => $request->category_id,
        ]);

        if($request->images) {
            foreach ($request->images as $image) {
                $requestImage = $image;

                $imageName = md5($requestImage->getClientOriginalName()
                        . strtotime("now")) . "." . $requestImage->extension();

                $requestImage->move(public_path('img/products'), $imageName);

                ProductImage::create([
                    'image' => $imageName,
                    'product_id' => $product->id,
                ]);
            }
        }

        return redirect(route('artisan.products.index'))
            ->with('status', 'Produto adicionado com sucesso');
    }

    public function show(int $id): View
    {
        $product = Product::findOrFail($id);

        return view('products.show', [
            'product' => $product,
            'shop' => $product->shop,
        ]);
    }

    public function edit(Product $product): View
    {
        return view('artisan.products.edit', [
            'product' => $product,
            'categories' => Category::orderBy('description', 'asc')->get(),
        ]);
    }

    public function update(Product $product, ProductRequest $request): RedirectResponse
    {
        if($request->hasFile('image')) {
            $requestImage = $request->image;

            $imageName = md5($requestImage->getClientOriginalName()
                    . strtotime("now")) . "." . $requestImage->extension();

            $requestImage->move(public_path('img/products'), $imageName);
        } else {
            $imageName = $product->image;
        }

        $product->update([
            'name' => $request->name,
            'image' => $imageName,
            'sale_price' => $request->sale_price,
            'description' => $request->description,
        ]);

        return redirect(route('artisan.products.edit', $product->id))
            ->with('status', 'Produto atualizado com sucesso');
    }

    public function destroy(Product $product): RedirectResponse
    {
        File::delete(public_path('img/products').'/'.$product->image);

        $product->delete();

        return redirect(route('artisan.products.index'))->with([
            'status' => 'Produto excluído com sucesso',
        ]);
    }
}
