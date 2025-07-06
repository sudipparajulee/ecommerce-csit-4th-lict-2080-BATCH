<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $order = Order::create($data);
        $cart->delete();
        $this->sendNewOrderEmail($order->id);
        return redirect()->route('mycart')->with('success', 'Order placed successfully');
    }

    public function storeEsewa(Request $request, $cartid)
    {
        $data = $request->data;
        $data = base64_decode($data);
        $data = json_decode($data, true);
        if($data['status'] == 'COMPLETE')
        {
            $cart = Cart::find($cartid);
            $orderData = [
                'user_id' => auth()->id(),
                'product_id' => $cart->product_id,
                'price' => $cart->product->discounted_price != null ? $cart->product->discounted_price : $cart->product->price,
                'quantity' => $cart->quantity,
                'name' => $cart->user->name,
                'address' => 'Chitwan',
                'phone' => '89897',
                'payment_method' => 'eSewa',
                'payment_status' => 'Paid',
            ];
            $order = Order::create($orderData);
            $cart->delete();
            $this->sendNewOrderEmail($order->id);
            return redirect()->route('mycart')->with('success', 'Order placed successfully');
        } else {
            return redirect()->route('mycart')->with('success', 'Something went wrong');
        }
    }

    public function index()
    {
        $orders = Order::latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function updateStatus($orderid, $status)
    {
        $order = Order::find($orderid);
        $order->payment_status = $status == 'Delivered' ? 'Paid' : 'Pending';
        $order->order_status = $status;
        $order->save();
        //send email notification
        $this->sendEmail($orderid);
        return redirect()->back()->with('success', 'Order status updated successfully');
    }

    public function sendEmail($orderid)
    {
        $order = Order::find($orderid);
        $data = [
            'name' => $order->name,
            'status' => $order->order_status,
            'price' => $order->price * $order->quantity,
        ];
        Mail::send('emails.orderstatus', $data, function($message) use ($order){
            $message->to($order->user->email)
                    ->subject('Order Status Update Notification');
        });
    }

    public function sendNewOrderEmail($orderid)
    {
        $order = Order::find($orderid);
        $data = [
            'name' => $order->name,
            'price' => $order->price * $order->quantity,
        ];
        Mail::send('emails.neworder', $data, function($message) use ($order){
            $message->to($order->user->email)
                    ->subject('New Order Notification');
        });
    }
}
