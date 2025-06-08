@extends('layouts.app')
@section('title', 'Edit Category')
@section('content')
    <form action="{{route('categories.update',$category->id)}}" method="POST">
        @csrf
        <input type="text" name="order" class="border border-gray-300 p-2 rounded w-full mb-4" value="{{ $category->order }}">
        @error('order')
            <div class="text-red-500 mb-2 -mt-3">{{ $message }}</div>
        @enderror
        <input type="text" name="name" placeholder="Category Name" class="border border-gray-300 p-2 rounded w-full mb-4" value="{{ $category->name }}">
        @error('name')
            <div class="text-red-500 mb-2 -mt-3">{{ $message }}</div>
        @enderror
        <div class="flex justify-center">
            <button type="submit" class="bg-blue-500 px-4 py-2 rounded text-white">Update Category</button>
            <a href="{{route('categories.index')}}" class="bg-gray-300 px-4 py-2 rounded text-black ml-2">Cancel</a>
        </div>
    </form>
@endsection
