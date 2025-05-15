<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
            'photo' => public_path('img/'.$imageName),
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
}
