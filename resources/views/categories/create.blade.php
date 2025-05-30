@extends('layouts.app')
@section('title', 'Create Category')
@section('content')
    <form action="{{route('categories.store')}}" method="POST">
        @csrf
        <input type="number" name="order" placeholder="Order" class="border border-gray-300 p-2 rounded w-full mb-4">
        <input type="text" name="name" placeholder="Category Name" class="border border-gray-300 p-2 rounded w-full mb-4">
        <div class="flex justify-center">
            <button type="submit" class="bg-blue-500 px-4 py-2 rounded text-white">Create Category</button>
            <a href="{{route('categories.index')}}" class="bg-gray-300 px-4 py-2 rounded text-black ml-2">Cancel</a>
        </div>
    </form>
@endsection
