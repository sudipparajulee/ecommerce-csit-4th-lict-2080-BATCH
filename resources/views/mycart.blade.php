@extends('layouts.master')
@section('content')
    <div class="px-20 py-10">
        <h2 class="font-bold text-2xl border-l-4 border-blue-600 pl-2">My Cart</h2>
        <div class="mt-5">
            @if($carts->isEmpty())
                <p class="text-gray-500">Your cart is empty.</p>
            @else
                <div class="grid gap-5">
                    @foreach($carts as $cart)
                        <div class="flex shadow border p-4 rounded-lg items-center justify-between">
                            <a href="{{route('viewproduct',$cart->product_id)}}" class="flex">
                                <img src="{{asset('images/products/'.$cart->product->photopath)}}" alt="Product Image" class="w-24 h-24 object-cover mr-4">
                            <div class="flex-1">
                                <h3 class="font-semibold">{{$cart->product->name}}</h3>
                                <p class="text-gray-600">
                                    @if($cart->product->discounted_price != '')
                                        <span>Rs. {{$cart->product->discounted_price}}</span>
                                        <span class="text-red-500 line-through text-sm">Rs. {{$cart->product->price}}</span>
                                    @else
                                        <span>Rs. {{$cart->product->price}}</span>
                                    @endif
                                </p>
                                <p class="text-gray-500">Quantity: {{$cart->quantity}}</p>
                            </div>
                            </a>
                            <div class="flex flex-col gap-2">
                                <a href="{{route('checkout',$cart->id)}}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Checkout</a>
                                <form action="{{route('cart.destroy',$cart->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 w-full rounded hover:bg-red-600">Remove</button>
                                </form>
                            </div>
                        </div>

                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
