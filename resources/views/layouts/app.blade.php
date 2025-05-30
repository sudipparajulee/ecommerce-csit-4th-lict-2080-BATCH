<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        @include('layouts.alert')
        <div class="flex bg-gray-100">
            <div class="w-52 bg-amber-500 text-white h-screen">
                <img src="{{asset('logo.png')}}" alt="" class="my-4 mx-auto">
                <div class="mt-4">
                    <a href="/dashboard" class="block pl-3 py-2 hover:bg-amber-600 font-bold text-lg border-b">Dashboard</a>
                    <a href="{{route('categories.index')}}" class="block pl-3 py-2 hover:bg-amber-600 font-bold text-lg border-b">Categories</a>
                    <a href="" class="block pl-3 py-2 hover:bg-amber-600 font-bold text-lg border-b">Products</a>
                    <a href="" class="block pl-3 py-2 hover:bg-amber-600 font-bold text-lg border-b">Orders</a>
                    <a href="" class="block pl-3 py-2 hover:bg-amber-600 font-bold text-lg border-b">Users</a>
                    <a href="" class="block pl-3 py-2 hover:bg-amber-600 font-bold text-lg border-b">Logout</a>
                </div>
            </div>
            <div class="flex-1 p-4">
                <h1 class="font-bold text-2xl">@yield('title')</h1>
                <hr class="h-1 bg-blue-500 mb-4">
                <div class="bg-white rounded-lg shadow p-4">@yield('content')</div>
            </div>
        </div>
    </body>
</html>
