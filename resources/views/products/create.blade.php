@extends('layouts.app')
@section('title', 'Create Product')
@section('content')
<form action="{{route('products.store')}}" method="POST">
        @csrf
        <select name="category_id" id="" class="border border-gray-300 p-2 rounded w-full mb-4">
            <option value="">Electronics</option>
            <option value="">Grocerries</option>
        </select>
        <input type="text" name="name" placeholder="Product Name" class="border border-gray-300 p-2 rounded w-full mb-4" value="{{ old('name') }}">
        @error('name')
            <div class="text-red-500 mb-2 -mt-3">{{ $message }}</div>
        @enderror
        <div class="flex justify-center">
            <button type="submit" class="bg-blue-500 px-4 py-2 rounded text-white">Create Product</button>
            <a href="{{route('products.index')}}" class="bg-gray-300 px-4 py-2 rounded text-black ml-2">Cancel</a>
        </div>
    </form>
@endsection
