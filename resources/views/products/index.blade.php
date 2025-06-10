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
        <tr>
            <td class="p-2 border">Picture</td>
            <td class="p-2 border">My product</td>
            <td class="p-2 border">600</td>
            <td class="p-2 border">500</td>
            <td class="p-2 border">this is descirption</td>
            <td class="p-2 border">5</td>
            <td class="p-2 border">Electronics</td>
            <td class="p-2 border text-center">
                <a href="" class="bg-blue-600 px-2 py-1 rounded text-white">Edit</a>
                <a href="" class="bg-red-600 px-2 py-1 rounded text-white">Delete</a>
            </td>
        </tr>

@endsection
