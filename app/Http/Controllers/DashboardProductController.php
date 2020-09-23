<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\ProductRequest;
use App\ProductGallery;
use Illuminate\Support\Str;

class DashboardProductController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::with(['galleries', 'category'])
            ->where('users_id', Auth::user()->id)->get();

        return view('pages.dashboard-products', [
            'products'  => $products
        ]);
    }

    public function detail(Request $request, $id)
    {
        $product = Product::with(['galleries', 'user', 'category'])->findOrFail($id);
        $categories = Category::all();
        return view('pages.dashboard-products-detail', [
            'product'   => $product,
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.dashboard-products-create', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['users_id'] = Auth::user()->id;
        $data['slug'] = Str::slug($request->name);
        $product = Product::create($data);

        $gallery = [
            'products_id'   => $product->id,
            'photos'        => $request->file('photo')->store('assets/product', 'public')
        ];

        ProductGallery::create($gallery);
        return redirect()->route('dashboard-product');
    }

    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $item = Product::findOrFail($id);
        $data['slug'] = Str::slug($request->name);
        $item->update($data);
        return redirect()->route('dashboard-product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Product::findOrFail($id);
        $item->delete();

        return redirect()->route('product.index');
    }

    public function uploadGallery(Request $request)
    {

        $data = $request->all();

        $data['photos'] = $request->file('photos')->store('assets/product', 'public');
        ProductGallery::create($data);

        return redirect()->route('dashboard-product-detail', $request->products_id);
    }

    public function deleteGallery(Request $request, $id)
    {
        $item = ProductGallery::findOrFail($id);
        $item->delete();

        return redirect()->route('dashboard-product-detail', $item->products_id);
    }
}
