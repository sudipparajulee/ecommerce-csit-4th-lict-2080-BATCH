@extends('layouts.app')
@section('title', 'Categories')
@section('content')
    <div class="flex justify-end mb-4">
        <a href="{{route('categories.create')}}" class="bg-amber-600 px-2 py-1 rounded text-white">Add Category</a>
    </div>
    <table class="w-full">
        <tr class="bg-gray-200">
            <th class="p-2 border border-gray-300">Order</th>
            <th class="p-2 border border-gray-300">Category Name</th>
            <th class="p-2 border border-gray-300">Action</th>
        </tr>
        @foreach($categories as $category)
        <tr class="text-center">
            <td class="p-2 border">{{$category->order}}</td>
            <td class="p-2 border">{{$category->name}}</td>
            <td class="p-2 border">
                <a href="{{route('categories.edit',$category->id)}}" class="bg-indigo-500 text-white px-2 py-1 rounded">Edit</a>
                <a href="{{route('categories.destroy',$category->id)}}" onclick="return confirm('Are you sure to delete?')" class="bg-red-500 text-white px-2 py-1 rounded">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
