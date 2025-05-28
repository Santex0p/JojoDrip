<?php
/// ETML
/// Author      : Santiago Escobar Toro
/// Date        : 2025-05-28
/// Description : Controller to retrieve and display admin, products, and orders data
namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display the admin panel.
     *
     * Retrieves the currently authenticated admin user, all products,
     * and all orders, then passes them as arrays to the 'admin-panel' view.
     *
     * @return \Illuminate\View\View  The view for the admin panel
     */
    public function index(): \Illuminate\View\View
    {
        // Retrieve the authenticated admin by their ID and convert to array
        $admin = Admin::where('id', Auth::id())->first()->toArray();
        // Fetch all products and convert result set to array
        $products = Product::all()->toArray();
        // Fetch all orders and convert result set to array
        $orders = Order::all()->toArray();
        // Pass data to the 'admin-panel' view; use null coalescing
        // in case any of the queries returned null
        return view('admin-panel', ['admin' => $admin ?? null, 'products' => $products ?? null , 'orders' => $orders ?? null]);
    }
}
