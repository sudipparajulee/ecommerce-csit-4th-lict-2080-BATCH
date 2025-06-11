@extends('layouts.app')
@section('title', 'Create Product')
@section('content')
<form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <select name="category_id" id="" class="border border-gray-300 p-2 rounded w-full mb-4">
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <input type="text" name="name" placeholder="Product Name" class="border border-gray-300 p-2 rounded w-full mb-4" value="{{ old('name') }}">
        @error('name')
            <div class="text-red-500 mb-2 -mt-3">{{ $message }}</div>
        @enderror

        <input type="text" name="price" placeholder="Price" class="border border-gray-300 p-2 rounded w-full mb-4" value="{{ old('price') }}">
        @error('price')
            <div class="text-red-500 mb-2 -mt-3">{{ $message }}</div>
        @enderror

        <input type="text" name="discounted_price" placeholder="Discounted Price" class="border border-gray-300 p-2 rounded w-full mb-4" value="{{ old('discounted_price') }}">
        @error('discounted_price')
            <div class="text-red-500 mb-2 -mt-3">{{ $message }}</div>
        @enderror

        <textarea name="description" placeholder="Description" class="border border-gray-300 p-2 rounded w-full mb-4">{{ old('description') }}</textarea>
        @error('description')
            <div class="text-red-500 mb-2 -mt-3">{{ $message }}</div>
        @enderror

        <input type="text" name="stock" placeholder="Stock" class="border border-gray-300 p-2 rounded w-full mb-4" value="{{ old('stock') }}">
        @error('stock')
            <div class="text-red-500 mb-2 -mt-3">{{ $message }}</div>
        @enderror

        <input type="file" name="photopath" class="border border-gray-300 p-2 rounded w-full mb-4">
        @error('photopath')
            <div class="text-red-500 mb-2 -mt-3">{{ $message }}</div>
        @enderror


        <div class="flex justify-center">
            <button type="submit" class="bg-blue-500 px-4 py-2 rounded text-white">Create Product</button>
            <a href="{{route('products.index')}}" class="bg-gray-300 px-4 py-2 rounded text-black ml-2">Cancel</a>
        </div>
    </form>
@endsection
