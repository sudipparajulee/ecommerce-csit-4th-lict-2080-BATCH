<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'data' => $products,
            'success' => true,
        ]);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json([
            'data' => $product,
            'success' => true,
        ]);
    }
}
