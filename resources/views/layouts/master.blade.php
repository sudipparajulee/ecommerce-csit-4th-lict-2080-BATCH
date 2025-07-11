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

    <!-- Modern Top Bar -->
    <div class="bg-gradient-to-r from-slate-800 to-slate-900 text-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-2 text-sm">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="text-gray-300">Free shipping on orders over $50</span>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    @auth
                        <div class="flex items-center space-x-2">
                            <div class="w-6 h-6 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                                <span class="text-white text-xs font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                            <span class="text-gray-300">Hi, <span class="text-white font-medium">{{auth()->user()->name}}</span></span>
                        </div>
                    @endauth
                    <a href="{{route('mycart')}}" class="flex items-center space-x-1 text-gray-300 hover:text-white transition-colors duration-300">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                        </svg>
                        <span>My Cart</span>
                    </a>
                    <a href="{{route('myorders')}}" class="flex items-center space-x-1 text-gray-300 hover:text-white transition-colors duration-300">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v6a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 2a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                        </svg>
                        <span>My Orders</span>
                    </a>
                    @auth
                        <form action="{{route('logout')}}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="flex items-center space-x-1 text-gray-300 hover:text-red-400 transition-colors duration-300">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Logout</span>
                            </button>
                        </form>
                    @else
                        <a href="{{route('login')}}" class="flex items-center space-x-1 text-gray-300 hover:text-green-400 transition-colors duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Login</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Modern Main Navigation -->
    <nav class="bg-white shadow-lg border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo Section -->
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                        <span class="text-white font-bold text-lg">E</span>
                    </div>
                    <div>
                        <h2 class="font-bold text-2xl bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            EcommercePro
                        </h2>
                        <p class="text-xs text-gray-500 -mt-1">Shop with confidence</p>
                    </div>
                </div>

                <!-- Search Section -->
                <div class="flex-1 max-w-2xl mx-8">
                    <form action="{{route('search')}}" method="GET" class="relative">
                        <div class="relative flex items-center">
                            <input type="search"
                                   id="searchInput"
                                   minlength="2"
                                   required
                                   name="search"
                                   value="{{request('search')}}"
                                   placeholder="Search for products, brands, and more..."
                                   autocomplete="off"
                                   class="w-full pl-12 pr-4 py-3 text-gray-700 bg-gray-50 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 shadow-sm hover:bg-white">
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <button type="submit"
                                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-6 py-2 rounded-lg transition-all duration-300 shadow-md hover:shadow-lg flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="hidden sm:inline">Search</span>
                            </button>
                        </div>

                        <!-- Search Suggestions Dropdown -->
                        <div id="searchSuggestions" class="absolute top-full left-0 right-0 mt-1 bg-white rounded-xl shadow-xl border border-gray-200 z-50 max-h-96 overflow-y-auto hidden">
                            <div id="suggestionsList" class="p-2">
                                <!-- Suggestions will be loaded here -->
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Navigation Links -->
                <div class="flex items-center space-x-6">
                    <a href="/" class="flex items-center space-x-1 text-gray-700 hover:text-blue-600 transition-colors duration-300 font-medium">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        <span>Home</span>
                    </a>

                    <!-- Categories Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center space-x-1 text-gray-700 hover:text-blue-600 transition-colors duration-300 font-medium">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                            </svg>
                            <span>Categories</span>
                            <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div class="absolute top-full left-0 mt-2 w-64 bg-white rounded-xl shadow-xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <div class="p-2">
                                @foreach ($categories as $category)
                                    <a href="{{route('categoryproducts',$category->id)}}"
                                       class="px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-colors duration-200 flex items-center space-x-3">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                        <span>{{$category->name}}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @yield('content')

    <!-- Modern Footer -->
    <footer class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Main Footer Content -->
            <div class="py-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-lg">E</span>
                        </div>
                        <h3 class="text-xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
                            EcommercePro
                        </h3>
                    </div>
                    <p class="text-gray-300 text-sm leading-relaxed">
                        Your trusted partner for quality products and exceptional shopping experience.
                        Discover amazing deals and premium products.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-blue-600 hover:bg-blue-700 rounded-full flex items-center justify-center transition-colors duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-blue-800 hover:bg-blue-900 rounded-full flex items-center justify-center transition-colors duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-pink-600 hover:bg-pink-700 rounded-full flex items-center justify-center transition-colors duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.097.118.112.221.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24c6.624 0 11.99-5.367 11.99-11.987C24.007 5.367 18.641.001 12.017.001z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-red-600 hover:bg-red-700 rounded-full flex items-center justify-center transition-colors duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-white">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-gray-300 hover:text-white transition-colors duration-300 flex items-center space-x-2">
                            <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
                            <span>Home</span>
                        </a></li>
                        @foreach ($categories->take(4) as $category)
                        <li><a href="{{route('categoryproducts',$category->id)}}" class="text-gray-300 hover:text-white transition-colors duration-300 flex items-center space-x-2">
                            <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
                            <span>{{$category->name}}</span>
                        </a></li>
                        @endforeach
                    </ul>
                </div>

                <!-- Customer Service -->
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-white">Customer Service</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-300 flex items-center space-x-2">
                            <span class="w-1.5 h-1.5 bg-purple-500 rounded-full"></span>
                            <span>Contact Us</span>
                        </a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-300 flex items-center space-x-2">
                            <span class="w-1.5 h-1.5 bg-purple-500 rounded-full"></span>
                            <span>Shipping Info</span>
                        </a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-300 flex items-center space-x-2">
                            <span class="w-1.5 h-1.5 bg-purple-500 rounded-full"></span>
                            <span>Returns & Exchanges</span>
                        </a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-300 flex items-center space-x-2">
                            <span class="w-1.5 h-1.5 bg-purple-500 rounded-full"></span>
                            <span>Size Guide</span>
                        </a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-300 flex items-center space-x-2">
                            <span class="w-1.5 h-1.5 bg-purple-500 rounded-full"></span>
                            <span>FAQ</span>
                        </a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-white">Stay Updated</h4>
                    <p class="text-gray-300 text-sm">Subscribe to get special offers, free giveaways, and updates.</p>
                    <div class="space-y-3">
                        <div class="flex">
                            <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-2 bg-slate-700 border border-slate-600 rounded-l-lg text-white placeholder-gray-400 focus:outline-none focus:border-blue-500 transition-colors duration-300">
                            <button class="px-6 py-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 rounded-r-lg transition-all duration-300 font-medium">
                                Subscribe
                            </button>
                        </div>
                        <div class="flex items-center space-x-2 text-xs text-gray-400">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span>We respect your privacy</span>
                        </div>
                    </div>
                    <div class="pt-4">
                        <h5 class="text-sm font-medium text-white mb-2">Contact Info</h5>
                        <div class="space-y-1 text-sm text-gray-300">
                            <p class="flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                </svg>
                                <span>info@ecommercepro.com</span>
                            </p>
                            <p class="flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                                </svg>
                                <span>+1 (555) 123-4567</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="border-t border-slate-700 py-6">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <div class="text-gray-300 text-sm">
                        <p>&copy; 2025 EcommercePro. All rights reserved. Built with ❤️ for amazing shopping experiences.</p>
                    </div>
                    <div class="flex flex-wrap items-center space-x-6 text-sm">
                        <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">Privacy Policy</a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">Terms of Service</a>
                        <a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">Cookie Policy</a>
                        <div class="flex items-center space-x-3">
                            <span class="text-gray-400 text-xs">Payments:</span>
                            <div class="flex space-x-2">
                                <div class="w-8 h-6 bg-blue-600 rounded flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">V</span>
                                </div>
                                <div class="w-8 h-6 bg-red-600 rounded flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">M</span>
                                </div>
                                <div class="w-8 h-6 bg-yellow-500 rounded flex items-center justify-center">
                                    <span class="text-white text-xs font-bold">P</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Search Suggestions JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const suggestionsContainer = document.getElementById('searchSuggestions');
            const suggestionsList = document.getElementById('suggestionsList');
            let searchTimeout;

            searchInput.addEventListener('input', function() {
                const query = this.value.trim();

                clearTimeout(searchTimeout);

                if (query.length < 2) {
                    hideSuggestions();
                    return;
                }

                searchTimeout = setTimeout(() => {
                    fetchSuggestions(query);
                }, 300); // Debounce for 300ms
            });

            searchInput.addEventListener('focus', function() {
                const query = this.value.trim();
                if (query.length >= 2) {
                    fetchSuggestions(query);
                }
            });

            // Hide suggestions when clicking outside
            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !suggestionsContainer.contains(e.target)) {
                    hideSuggestions();
                }
            });

            function fetchSuggestions(query) {
                fetch(`{{route('search.suggestions')}}?query=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        displaySuggestions(data);
                    })
                    .catch(error => {
                        console.error('Error fetching suggestions:', error);
                        hideSuggestions();
                    });
            }

            function displaySuggestions(suggestions) {
                suggestionsList.innerHTML = '';

                if (suggestions.length === 0) {
                    suggestionsList.innerHTML = `
                        <div class="px-4 py-3 text-gray-500 text-center">
                            <svg class="w-8 h-8 mx-auto mb-2 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-sm">No products found</p>
                        </div>
                    `;
                } else {
                    suggestions.forEach(product => {
                        const suggestionItem = document.createElement('a');
                        suggestionItem.href = product.url;
                        suggestionItem.className = 'flex items-center space-x-3 px-4 py-3 hover:bg-blue-50 rounded-lg transition-colors duration-200 border-b border-gray-100 last:border-b-0';

                        suggestionItem.innerHTML = `
                            <div class="flex-shrink-0 w-12 h-12 bg-gray-200 rounded-lg overflow-hidden">
                                ${product.image ?
                                    `<img src="${product.image}" alt="${product.name}" class="w-full h-full object-cover">` :
                                    `<div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>`
                                }
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">${product.name}</p>
                                <p class="text-sm text-blue-600 font-semibold">$${product.price}</p>
                            </div>
                            <div class="flex-shrink-0">
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        `;

                        suggestionsList.appendChild(suggestionItem);
                    });
                }

                showSuggestions();
            }

            function showSuggestions() {
                suggestionsContainer.classList.remove('hidden');
            }

            function hideSuggestions() {
                suggestionsContainer.classList.add('hidden');
            }

            // Handle keyboard navigation
            searchInput.addEventListener('keydown', function(e) {
                const suggestions = suggestionsList.querySelectorAll('a');
                if (suggestions.length === 0) return;

                let currentIndex = -1;
                suggestions.forEach((item, index) => {
                    if (item.classList.contains('bg-blue-100')) {
                        currentIndex = index;
                        item.classList.remove('bg-blue-100');
                    }
                });

                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    currentIndex = currentIndex < suggestions.length - 1 ? currentIndex + 1 : 0;
                    suggestions[currentIndex].classList.add('bg-blue-100');
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    currentIndex = currentIndex > 0 ? currentIndex - 1 : suggestions.length - 1;
                    suggestions[currentIndex].classList.add('bg-blue-100');
                } else if (e.key === 'Enter' && currentIndex >= 0) {
                    e.preventDefault();
                    suggestions[currentIndex].click();
                } else if (e.key === 'Escape') {
                    hideSuggestions();
                }
            });
        });
    </script>
</body>
</html>
