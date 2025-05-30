@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-blue-100 p-4 rounded-lg shadow">
            <h2 class="font-bold text-xl">Total Categories</h2>
            <p class="text-3xl font-bold">44</p>
        </div>
        <div class="bg-red-100 p-4 rounded-lg shadow">
            <h2 class="font-bold text-xl">Total Products</h2>
            <p class="text-3xl font-bold">55</p>
        </div>
        <div class="bg-green-100 p-4 rounded-lg shadow">
            <h2 class="font-bold text-xl">Total Orders</h2>
            <p class="text-3xl font-bold">120</p>
        </div>
        <div class="bg-yellow-100 p-4 rounded-lg shadow">
            <h2 class="font-bold text-xl">Pending Orders</h2>
            <p class="text-3xl font-bold">44</p>
        </div>
        <div class="bg-green-100 p-4 rounded-lg shadow">
            <h2 class="font-bold text-xl">Processing Orders</h2>
            <p class="text-3xl font-bold">55</p>
        </div>
        <div class="bg-blue-100 p-4 rounded-lg shadow">
            <h2 class="font-bold text-xl">Delivered Orders</h2>
            <p class="text-3xl font-bold">120</p>
        </div>
    </div>

    </div>
@endsection
