<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @include('layouts.alert')
    @php
        $categories = \App\Models\Category::orderBy('order', 'asc')->get();
    @endphp
    <div class="bg-red-500 flex justify-end gap-4 px-12 py-2 text-white text-xs">
        @auth
            <p>HI, {{auth()->user()->name}}</p>
        @endauth
        <a href="{{route('mycart')}}">My Cart</a>
        <a href="{{route('myorders')}}">My Orders</a>
        @auth
            <form action="{{route('logout')}}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{route('login')}}">Login</a>
        @endauth

    </div>
    <nav class="flex justify-between items-center bg-blue-600 py-3 px-12 text-white">
        <h2 class="font-bold text-xl">LOGO</h2>
        <form action="{{route('search')}}" method="GET">
            <input type="search" minlength="2" required name="search" value="{{request('search')}}" placeholder="Search products..." class="px-4 py-2 w-72 text-black rounded">
            <button type="submit" class="bg-white text-blue-600 px-4 py-2 rounded">Search</button>
        </form>
        <div class="flex gap-4">
            <a href="/">Home</a>
            @foreach ($categories as $category)
                <a href="{{route('categoryproducts',$category->id)}}">{{$category->name}}</a>
            @endforeach
        </div>
    </nav>
    @yield('content')
    <footer class="bg-gray-700 text-white py-3 px-12">
        <div class="text-center">
            <p>&copy; 2025 My Company</p>
        </div>
    </footer>
</body>
</html>
