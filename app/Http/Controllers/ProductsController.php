<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all()->toArray();
        return view('home', ['products' => $products ?? null]);
    }
    public function add(Request $request) {

        $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric|between:0,9999999999.99',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',
            'description' => 'required',
        ]);

        $imageName = time().'.'.$request->image->getClientOriginalName();

        $request->image->move(public_path('img'), $imageName); // To stock the image in img dir

        Product::query()->create([
            'photo' => $imageName,
            'name' => $request->input('name'),
            'category' => $request->input('category'),
            'price' => $request->input('price'),
            'description' => $request->input('description')
        ]);

        return redirect()->route('admin-home');
    }

    public function delete(Request $request) {
        Product::destroy($request->input('id'));
        return redirect()->route('admin-home');
    }

    public function update(Request $request) {

        if ($request->image) {
            $imageName = time() . '.' . $request->image->getClientOriginalName();
            $request->image->move(public_path('img'), $imageName);
            File::delete(public_path('img/') . $request->input('photo-name'));
        }

        Product::query()->where('id', $request->input('id'))->update([
            'photo' => $imageName ?? $request->input('photo-name'),
            'name' => $request->input('name'),
            'category' => $request->input('category'),
            'price' => $request->input('price'),
            'description' => $request->input('description')
        ]);

        return redirect()->route('detail-product', [$request->input('id'), $request->input('action')]);

    }

    public function editView(Request $request) {
        return redirect()->route('detail-product', $request->input('id'))->with('action', $request->input('action'));
    }

    public function details(Product $product, Request $request) {
        return view('product', ['product' => $product->toArray(), 'action' => $request->route('action')]);
    }
}
