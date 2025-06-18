@extends('layouts.app')
@section('title', 'Products')
@section('content')
    <div class="flex justify-end mb-4">
        <a href="{{route('products.create')}}" class="bg-amber-600 px-2 py-1 rounded text-white">Add Product</a>
    </div>

    <table class="w-full">
        <tr class="bg-gray-200">
            <th class="p-2 border border-gray-300">Picture</th>
            <th class="p-2 border border-gray-300">Product Name</th>
            <th class="p-2 border border-gray-300">Price</th>
            <th class="p-2 border border-gray-300">Discounted Price</th>
            <th class="p-2 border border-gray-300">Description</th>
            <th class="p-2 border border-gray-300">Stock</th>
            <th class="p-2 border border-gray-300">Category</th>
            <th class="p-2 border border-gray-300">Action</th>
        </tr>
        @foreach($products as $product)
        <tr>
            <td class="p-2 border">
                <img src="{{asset('images/products/'.$product->photopath)}}" alt="" class="h-16 hover:rotate-45 transition-all duration-300">
            </td>
            <td class="p-2 border">{{$product->name}}</td>
            <td class="p-2 border">{{$product->price}}</td>
            <td class="p-2 border">{{$product->discounted_price ?? '--'}}</td>
            <td class="p-2 border">{{$product->description}}</td>
            <td class="p-2 border">{{$product->stock}}</td>
            <td class="p-2 border">{{$product->category->name}}</td>
            <td class="p-2 border text-center">
                <a href="{{route('products.edit',$product->id)}}" class="bg-blue-600 px-2 py-1 rounded text-white">Edit</a>
                <a href="{{route('products.destroy',$product->id)}}" onclick="return confirm('Are you sure to Delete?')" class="bg-red-600 px-2 py-1 rounded text-white">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
