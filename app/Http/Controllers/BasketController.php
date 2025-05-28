<?php
/// ETML
/// Author      : Santiago Escobar Toro
/// Date        : 2025-05-28
/// Description : Controller to manage shopping basket (view, add, remove, purchase, status change)

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
    /**
     * Display the basket contents and total price.
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): \Illuminate\View\View
    {

        $productsSQL = [];
        $sum = [];

        // If there are products in session, load each and convert to array
        if (session()->has('products'))
        {
            foreach(session('products') as $key => $productID)
            {
                $productsSQL[] = Product::find($productID)->toArray();
            }

            // Calculate total price
            foreach($productsSQL as $product)
            {
                $sum[] = $product['price'];
            }
            $sum = array_sum($sum);

        }

        return view('basket', ['products' => $productsSQL, 'index' => 0, 'session' => session('products'), 'sum' => $sum]);
    }

    /**
     * Add a product to the basket.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToBasket(Request $request): \Illuminate\Http\RedirectResponse
    {
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

    /**
     * Remove a product from the basket by its index.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeFromBasket(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'index' => 'required',
        ]);

        session()->pull('products.' .$request['index']);

        session(['products' => array_values(session('products'))]);

        session()->save();

        return back();
    }

    /**
     * Clear all products from the basket.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeAll(): \Illuminate\Http\RedirectResponse
    {
        session()->forget('products');

        return back();
    }

    /**
     * Complete the purchase: validate input, save customer and order, then clear the basket.
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */
    public function buy(Request $request)
    {
        $data = $request->validate([
            'name' => 'string|required',
            'email' => 'email|required',
            'address' => 'required',
            'products' => 'string|required'
        ]);

        $products = json_decode($data['products'], true);
        // Calculate total price
        $sum = [];

        foreach ($products as $product) {
            $sum[] = $product['price'];
        }

        $sum = array_sum($sum);

        // Insert new customer and retrieve its ID
        $customerID = Customer::query()->insertGetId([
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            ]);
        // Create an order with PENDING status
        $order = Order::query()->create([
            'customer_id' => $customerID,
            'quantity' => count($products),
            'status' => 'PENDING',
            'price' => $sum,
            'created_at' => now()
        ]);

        // Clear the basket
        session()->forget('products');

        return view('purchase-completed', ['status' => $order['status']]);

    }
    /**
     * Change the status of an existing order.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeStatus(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'id' => 'required',
        ]);
        // Update the order’s status
        Order::query()->where('id', $request->input('id'))->update(['status' => $request->input('status')]);
        return back();
    }
}
