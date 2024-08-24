<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display all the products from the shop.
     */
    public function index(Request $request): View
    {
        $products = $request->user()->shop->products()->paginate(10);

        return view('products.index', [
            'shop' => $request->user()->shop,
            'products' => $products,
        ]);
    }

    /**
     * Display the products details.
     */
    public function show(Product $product): View
    {
       return view('products.show', [
            'product' => Product::where('id', $product->id)->firstOrFail(),
            'shop' => $product->shop,
        ]);
    }

    /**
     * Display the page to create a product.
     */
    public function create(Request $request): View
    {
        return view('products.create', [
            'shop_id' => $request->user()->shop->id,
            'categories' => Category::orderBy('description', 'asc')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => ['required'],
            'name' => ['required', 'string', 'min:3', 'max:150'],
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
            'sale_price' => $request->sale_price,
            'description' => $request->description,
            'shop_id' => $request->user()->shop->id,
            'category_id' => $request->category_id,
        ]);

        return redirect(route('artisan.products.index'));
    }

    /**
     * Display the products edit page.
     */
    public function edit(Product $product): View
    {
        return view('products.edit', [
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

    /**
     * Delete the shop's product.
     */
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
