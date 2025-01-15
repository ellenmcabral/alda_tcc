<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $products = $request->user()->shop->products()->where('is_active', 1)->get();

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
        $product = Product::create([
            'name' => $request->name,
            'sale_price' => $request->sale_price,
            'description' => $request->description,
            'shop_id' => $request->user()->shop->id,
            'category_id' => $request->category_id,
        ]);

        $product->url = $product->formatName();

        if($request->option == 'stock') {
            $product->stock = $request->stock;
        }
        if($request->option == 'deadline') {
            $product->deadline = $request->deadline;
        }

        if($request->images) {
            foreach ($request->images as $key => $image) {
                $filename = $image->getClientOriginalName();

                $imageName = md5($filename . strtotime("now")) . "." . $image->extension();

                Storage::disk('s3')->put(
                    "img/products/" . $imageName, file_get_contents($image),
                    'public');

                $file = Storage::disk('s3')->url('img/products/' . $imageName);

                if($request->is_default == $key) {
                    $is_default = true;
                }
                else {
                    $is_default = false;
                }

                ProductImage::create([
                    'image' => $imageName,
                    'product_id' => $product->id,
                    'is_default' => $is_default,
                ]);
            }
        }

        $product->save();

        return redirect(route('artisan.products.index'))
            ->with('status', 'Produto adicionado!');
    }

    public function show(int $id): View
    {
        $product = Product::findOrFail($id);

        $productImages = $product->productImages()->orderBy('is_default', 'desc')->get();

        return view('products.show', [
            'product' => $product,
            'productImages' => $productImages,
        ]);
    }

    public function edit(Product $product): View
    {
        return view('artisan.products.edit', [
            'product' => $product,
            'productImages' => $product->productImages()->get(),
            'categories' => Category::orderBy('description', 'asc')->get(),
        ]);
    }

    public function update(Product $product, ProductRequest $request): RedirectResponse
    {
        $product->update([
            'name' => $request->name,
            'sale_price' => $request->sale_price,
            'description' => $request->description,
        ]);

        if($request->option == 'stock') {
            $product->stock = $request->stock;
        }
        if($request->option == 'deadline') {
            $product->deadline = $request->deadline;
        }

        $product->save();

        return redirect(route('artisan.products.edit', $product->id))
            ->with('status', 'Produto atualizado!');
    }

    public function delete(Product $product): RedirectResponse
    {
        //$productImages = ProductImage::where('product_id', $product->id)->get();

        //foreach ($productImages as $productImage) {
        //    Storage::disk('local')->delete('public/img/products/' . $productImage->image);
        //}

        $product->is_active = false;
        $product->save();

        return redirect(route('artisan.products.index'))->with([
            'status' => 'Produto excluído!',
        ]);
    }

    public function activate(Product $product): RedirectResponse
    {
        $product->is_active = true;
        $product->save();

        return redirect(route('artisan.products.deleted-products'))->with([
           'status' => 'Produto ativado!',
        ]);
    }
}
