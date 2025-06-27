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

    public function mycart()
    {
        $carts = Cart::where('user_id', auth()->id())
            ->get();
        //if the stock is less than the quantity in cart, update the quantity
        foreach($carts as $cart)
        {
            if($cart->quantity > $cart->product->stock)
            {
                $cart->quantity = $cart->product->stock;
                $cart->save();
            }
        }
        return view('mycart', compact('carts'));
    }

    public function destroy(Request $request, $id)
    {
        $cart = Cart::where('user_id', auth()->id())
            ->where('id', $id)
            ->first();
        if ($cart) {
            $cart->delete();
            return back()->with('success', 'Cart item removed successfully.');
        }
        return back()->with('success', 'Cart item not found.');
    }
}
