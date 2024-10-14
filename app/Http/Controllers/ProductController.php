<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $products = $request->user()->shop->products()->orderBy('id', 'DESC')->paginate(10);

        return view('artisan.products.index', [
            'shop' => $request->user()->shop,
            'products' => $products,
        ]);
    }

    public function create(Request $request): View
    {
        return view('artisan.products.create', [
            'shop_id' => $request->user()->shop->id,
            'categories' => Category::orderBy('description', 'asc')->get(),
        ]);
    }

    public function store(Request $request, ProductRepository $repository): RedirectResponse
    {
        $product = $repository->add($request);

        return redirect(route('artisan.products.index'))
            ->with('status', 'Produto adicionado com sucesso');
    }

    public function show($id): View
    {
        $product = Product::where('id', $id)->firstOrFail();

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

    public function destroy(Product $product, Request $request): RedirectResponse
    {
        $request->validateWithBag('productDeletion', [
            'password' => ['required', 'current_password'],
        ]);
        File::delete(public_path('img/products').'/'.$product->image);

        $product->delete();

        return redirect(route('artisan.products.index'));
    }
}
