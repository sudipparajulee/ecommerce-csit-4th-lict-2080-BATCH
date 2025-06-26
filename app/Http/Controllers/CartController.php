<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);
        $data['user_id'] = auth()->id();
        //if already in cart, update quantity
        $existingCart = Cart::where('user_id', $data['user_id'])
            ->where('product_id', $data['product_id'])
            ->first();
        if ($existingCart) {
            $existingCart->quantity = $data['quantity'];
            $existingCart->save();
            return back()->with('success', 'Cart updated successfully.');
        }
        Cart::create($data);
        return back()->with('success', 'Product added to cart successfully.');
    }
}
