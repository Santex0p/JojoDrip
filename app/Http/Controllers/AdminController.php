<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {

        $admin = Admin::where('id', Auth::id())->first()->toArray();

        $products = Product::all()->toArray();

        return view('admin-panel', ['admin' => $admin ?? null, 'products' => $products ?? null]);
    }
}
