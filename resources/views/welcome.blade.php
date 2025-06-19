@extends('layouts.master')
@section('content')
    <div class="px-20 py-10">
        <h2 class="font-bold text-2xl border-l-4 border-blue-600 pl-2">Latest Products</h2>
        <div class="grid grid-cols-4 gap-4 mt-5">
            @foreach($latestproducts as $product)
            <a href="" class="border p-4 rounded-lg shadow hover:shadow-md hover:-translate-y-2 transition-all duration-300">
                <img src="{{asset('images/products/'.$product->photopath)}}" alt="Product Image" class="w-full h-48 object-cover mb-2">
                <h3 class="font-semibold">{{$product->name}}</h3>
                <p class="text-gray-600">
                    <span>Rs. 9000</span>
                    <span class="text-red-500 line-through">Rs. 12000</span>
                </p>
            </a>
            @endforeach
        </div>
    </div>
@endsection
