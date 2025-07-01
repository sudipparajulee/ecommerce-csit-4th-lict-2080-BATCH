<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $cartid = $request->cartid;
        $cart = Cart::find($cartid);
        $data = [
            'user_id' => auth()->id(),
            'product_id' => $cart->product_id,
            'price' => $cart->product->discounted_price != null ? $cart->product->discounted_price : $cart->product->price,
            'quantity' => $cart->quantity,
            'name' => $cart->user->name,
            'address' => 'Chitwan',
            'phone' => '89897',
        ];
        Order::create($data);
        $cart->delete();
        return redirect()->route('mycart')->with('success', 'Order placed successfully');
    }
}
