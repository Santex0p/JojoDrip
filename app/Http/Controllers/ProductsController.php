<?php
/// ETML
/// Author      : Santiago Escobar Toro
/// Date        : 2025-05-28
/// Description : Controller to manage product listing and CRUD actions
///
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    /**
     * Display all products on the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = Product::all()->toArray();
        return view('home', ['products' => $products ?? null]);
    }
    /**
     * Create a new product.
     *
     * Validates input, handles image upload, and inserts the new record.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request): \Illuminate\Http\RedirectResponse
    {

        // Validate product fields and optional image upload
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric|between:0,9999999999.99',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',
            'description' => 'required',
        ]);

        // Generate a unique filename and move uploaded image to public/img
        $imageName = time().'.'.$request->image->getClientOriginalName();

        $request->image->move(public_path('img'), $imageName); // To stock the image in img dir

        // Insert product record
        Product::query()->create([
            'photo' => $imageName,
            'name' => $data['name'],
            'category' => $data['category'],
            'price' => $data['price'],
            'description' => $data['description']
        ]);

        // Redirect to product detail with 'created' action
        return redirect()->route('admin-home');
    }

    /**
     * Delete a product and its associated image file.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'id' => 'required',
        ]);

        // Find the product or fail with 404
        $product = Product::find($request->input('id'));

        // Remove the image file if it exists
        File::delete(public_path('img/') . $product['photo']);

        // Delete the product record
        Product::destroy($request->input('id'));

        // Redirect back to home
        return redirect()->route('admin-home');
    }

    /**
     * Update an existing product.
     *
     * Validates input, handles optional image replacement, and updates the record.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {

        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric|between:0,9999999999.99',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif',
            'description' => 'required',
            'photo-name' => 'required'
        ]);

        // If a new image was uploaded, delete old file and store the new one
        if ($request->image) {
            $imageName = time() . '.' . $request->image->getClientOriginalName();
            $request->image->move(public_path('img'), $imageName);
            File::delete(public_path('img/') . $data['photo-name']);
        }

        // Update only the provided fields
        Product::query()->where('id', $request->input('id'))->update([
            'photo' => $imageName ?? $data['photo-name'],
            'name' =>  $data['name'],
            'category' =>  $data['category'],
            'price' => $data['price'],
            'description' => $data['description']
        ]);

        return redirect()->route('detail-product', [$request->input('id'), $request->input('action')]);

    }

    /**
     * Prepare product edit view.
     *
     * Validates input and redirects to detail route with action flag.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function editView(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'id' => 'required',
            'action' => 'required',
        ]);
        return redirect()->route('detail-product', $request->input('id'))->with('action', $request->input('action'));
    }

    /**
     * Show a single product’s details.
     *
     * @param  Product  $product
     * @param  Request  $request
     * @return \Illuminate\View\View
     */
    public function details(Product $product, Request $request): \Illuminate\View\View
    {
        // Using action to know when updating or basic view
        return view('product', ['product' => $product->toArray(), 'action' => $request->route('action')]);
    }
}
