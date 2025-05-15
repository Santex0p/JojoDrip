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
        if (Auth::check()) {
            $admin = Admin::where('id', Auth::id())->first()->toArray();
        }
        else
        {
            return redirect('auth');
        }

        $products = Product::all();

        return view('admin-panel', ['admin' => $admin ?? null, 'products' => $products ?? null]);
    }
}
