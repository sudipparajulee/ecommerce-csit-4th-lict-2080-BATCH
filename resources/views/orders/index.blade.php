@extends('layouts.app')
@section('title', 'Orders')
@section('content')
    <table class="w-full">
        <tr class="bg-gray-200">
            <th class="p-2 border border-gray-300">Order Date</th>
            <th class="p-2 border border-gray-300">Product Picture</th>
            <th class="p-2 border border-gray-300">Product Name</th>
            <th class="p-2 border border-gray-300">Price</th>
            <th class="p-2 border border-gray-300">Quantity</th>
            <th class="p-2 border border-gray-300">Total Amount</th>
            <th class="p-2 border border-gray-300">Customer Name</th>
            <th class="p-2 border border-gray-300">Phone</th>
            <th class="p-2 border border-gray-300">Address</th>
            <th class="p-2 border border-gray-300">Payment Method</th>
            <th class="p-2 border border-gray-300">Payment Status</th>
            <th class="p-2 border border-gray-300">Order Status</th>
            <th class="p-2 border border-gray-300">Action</th>
        </tr>
        @foreach($orders as $order)
        <tr>
            <td class="p-2 border">{{ $order->created_at }}</td>
            <td class="p-2 border">
                <img src="{{ asset('images/products/' . $order->product->photopath) }}" alt="Product Image" class="w-16 h-16 object-cover">
            </td>
            <td class="p-2 border">{{ $order->product->name }}</td>
            <td class="p-2 border">{{$order->price}}</td>
            <td class="p-2 border">{{ $order->quantity }}</td>
            <td class="p-2 border">{{ $order->price * $order->quantity }}</td>
            <td class="p-2 border">{{ $order->name }}</td>
            <td class="p-2 border">{{ $order->phone }}</td>
            <td class="p-2 border">{{ $order->address }}</td>
            <td class="p-2 border">{{ $order->payment_method }}</td>
            <td class="p-2 border">{{ $order->payment_status }}</td>
            <td class="p-2 border">{{ $order->order_status }}</td>
            <td class="p-2 border flex flex-wrap gap-2 min-w-48">
                <a href="{{route('orders.status',[$order->id,'Pending'])}}" class="px-1 bg-blue-600 text-white">Pe</a>
                <a href="{{route('orders.status',[$order->id,'Processing'])}}" class="px-1 bg-yellow-600 text-white">Pr</a>
                <a href="{{route('orders.status',[$order->id,'Delivered'])}}" class="px-1 bg-green-600 text-white">De</a>
                <a href="{{route('orders.status',[$order->id,'Cancelled'])}}" class="px-1 bg-red-600 text-white">Ca</a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
