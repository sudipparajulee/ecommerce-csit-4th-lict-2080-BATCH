<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('order', 'asc')->get();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'discounted_price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'category_id' => 'required',
            'stock' => 'required|integer',
            'photopath' => 'required|image'
        ]);

        //handle file upload
        $file = $request->file('photopath');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/products/'), $filename);
        $data['photopath'] = $filename;

        Product::create($data);
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
