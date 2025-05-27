<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Having;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class BasketController extends Controller
{

    public function index(Request $request) {

        $productsSQL = [];
        $sum = [];

        if (session()->has('products'))
        {
            foreach(session('products') as $key => $productID)
            {
                $productsSQL[] = Product::find($productID)->toArray();
            }


            foreach($productsSQL as $product)
            {
                $sum[] = $product['price'];
            }
            $sum = array_sum($sum);

        }

        return view('basket', ['products' => $productsSQL, 'index' => 0, 'session' => session('products'), 'sum' => $sum]);
    }

    public function addToBasket(Request $request) {
        $request->validate([
            'id-product' => 'required',
        ]);

        if (!session()->has('products'))
        {
            session(['products' =>[
                $request['id-product']]
            ]);
        }
        else
        {
            session()->push('products', $request['id-product']);
        }

        return back();
    }

    public function removeFromBasket(Request $request) {
        $request->validate([
            'index' => 'required',
        ]);

        session()->pull('products.' .$request['index']);

        session(['products' => array_values(session('products'))]);

        session()->save();

        return back();
    }

    public function removeAll()
    {
        session()->forget('products');

        return back();
    }

    public function buy(Request $request)
    {
        $data = $request->validate([
            'name' => 'string|required',
            'email' => 'email|required',
            'address' => 'required',
            'products' => 'string|required'
        ]);

        $products = json_decode($data['products'], true);
        $sum = [];

        foreach ($products as $product) {
            $sum[] = $product['price'];
        }

        $sum = array_sum($sum);


        $customerID = Customer::query()->insertGetId([
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            ]);

        $order = Order::query()->create([
            'customer_id' => $customerID,
            'quantity' => count($products),
            'status' => 'PENDING',
            'price' => $sum,
            'created_at' => now()
        ]);

        session()->forget('products');

        return view('purchase-completed', ['status' => $order['status']]);

    }

    public function changeStatus(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        Order::query()->where('id', $request->input('id'))->update(['status' => $request->input('status')]);
        return back();
    }
}
