<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Having;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function index() {

        $orderExample = Order::query()->where('id', 1)->first()->toArray();
        $customerExemple = Customer::query()->where('id', 1)->first()->toArray();
        $havingExample = Having::query()->where('id', 1)->first()->toArray();

        $var = Product::find(1)->orders;



        dd($var);

        return view('basket');
    }
}
