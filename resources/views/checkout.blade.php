@extends('layouts.master')
@section('content')
    <div class="px-20 py-10">
        <h2 class="font-bold text-2xl border-l-4 border-blue-600 pl-2">Checkout</h2>
        <div class="mt-5">
                <div class="grid gap-5">
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
                                <a href="" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Cash on Delivery</a>
                                <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
                                <input type="hidden" id="amount" name="amount" value="100" required>
                                <input type="hidden" id="tax_amount" name="tax_amount" value ="0" required>
                                <input type="hidden" id="total_amount" name="total_amount" value="110" required>
                                <input type="hidden" id="transaction_uuid" name="transaction_uuid" value="241028" required>
                                <input type="hidden" id="product_code" name="product_code" value ="EPAYTEST" required>
                                <input type="hidden" id="product_service_charge" name="product_service_charge" value="0" required>
                                <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="0" required>
                                <input type="hidden" id="success_url" name="success_url" value="https://developer.esewa.com.np/success" required>
                                <input type="hidden" id="failure_url" name="failure_url" value="https://developer.esewa.com.np/failure" required>
                                <input type="hidden" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
                                <input type="hidden" id="signature" name="signature" value="i94zsd3oXF6ZsSr/kGqT4sSzYQzjj1W/waxjWyRwaME=" required>
                                <input class="bg-green-600 text-white px-3 py-2 rounded-lg cursor-pointer" value="Pay with eSewa" type="submit">
                                </form>
                            </div>
                        </div>
                </div>
        </div>
    </div>

    @php
        $totalamount = $cart->product->discounted_price != '' ? $cart->product->discounted_price * $cart->quantity : $cart->product->price * $cart->quantity;
        $transaction_uuid = time() . rand(1000, 9999);
        $message = "total_amount=$totalamount,transaction_uuid=$transaction_uuid,product_code=EPAYTEST";
        $secret = '8gBm/:&EnhH.1/q';
        $signature = hash_hmac('sha256', $message, $secret, true);
        $signature = base64_encode($signature);
    @endphp
    <script>
        document.getElementById('amount').value = '{{ $totalamount }}';
        document.getElementById('total_amount').value = '{{ $totalamount }}';
        document.getElementById('transaction_uuid').value = '{{ $transaction_uuid }}';
        document.getElementById('signature').value = '{{ $signature }}';
    </script>
@endsection
