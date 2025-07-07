@extends('layouts.master')
@section('content')
<div class="px-20 py-10">
        <h2 class="font-bold text-2xl border-l-4 border-blue-600 pl-2">My Orders</h2>
        <div class="mt-5">
            @if($orders->isEmpty())
                <p class="text-gray-500">You have no orders.</p>
            @else
                <table class="w-full">
                    <tr>
                        <th class="border px-4 py-2">Order Date</th>
                        <th class="border px-4 py-2">Product Picture</th>
                        <th class="border px-4 py-2">Product Name</th>
                        <th class="border px-4 py-2">Quantity</th>
                        <th class="border px-4 py-2">Price</th>
                        <th class="border px-4 py-2">Total Amount</th>
                        <th class="border px-4 py-2">Payment Method</th>
                        <th class="border px-4 py-2">Payment Status</th>
                        <th class="border px-4 py-2">Order Status</th>
                        <th class="border px-4 py-2">Action</th>
                    </tr>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="border px-4 py-2">{{ $order->created_at }}</td>
                            <td class="border px-4 py-2">
                                <img src="{{ asset('images/products/' . $order->product->photopath) }}" alt="Product Image" class="w-24 h-24 object-cover">
                            </td>
                            <td class="border px-4 py-2">{{ $order->product->name }}</td>
                            <td class="border px-4 py-2">{{ $order->quantity }}</td>
                            <td class="border px-4 py-2">
                                {{$order->price}}
                            </td>
                            <td class="border px-4 py-2">
                                {{ $order->quantity * $order->price }}
                            </td>
                            <td class="border px-4 py-2">{{ $order->payment_method }}</td>
                            <td class="border px-4 py-2">{{ $order->payment_status }}</td>
                            <td class="border px-4 py-2">{{ $order->order_status }}</td>
                            <td class="border px-4 py-2 text-center">
                                @if($order->order_status == 'Pending')
                                    <form action="{{route('order.cancel',$order->id)}}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Cancel Order</button>
                                    </form>
                                @else
                                    <span class="text-gray-500">N/A</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
</div>
@endsection
