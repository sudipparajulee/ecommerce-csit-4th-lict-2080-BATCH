<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $latestproducts = Product::latest()->take(4)->get();
        return view('welcome', compact('latestproducts'));
    }

    public function viewproduct($id)
    {
        $product = Product::findOrFail($id);
        return view('viewproduct', compact('product'));
    }

    public function categoryproducts($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->get();
        return view('categoryproducts', compact('category', 'products'));
    }

    public function checkout($cartid)
    {
        $cart = Cart::findOrFail($cartid);
        return view('checkout', compact('cart'));
    }
}
