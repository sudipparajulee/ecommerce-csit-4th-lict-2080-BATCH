@extends('layouts.master')
@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-blue-600 via-purple-600 to-blue-800 text-white py-20">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">
                Welcome to EcommercePro
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-blue-100 max-w-3xl mx-auto">
                Discover amazing products, unbeatable prices, and exceptional quality. Your perfect shopping experience starts here.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button class="bg-white text-blue-600 px-8 py-4 rounded-full font-semibold hover:bg-blue-50 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    Shop Now
                </button>
                <button class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold hover:bg-white hover:text-blue-600 transition-all duration-300">
                    Explore Categories
                </button>
            </div>
        </div>
    </div>

    <!-- Latest Products Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <div class="inline-flex items-center space-x-2 bg-blue-50 px-4 py-2 rounded-full mb-4">
                <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                </svg>
                <span class="text-blue-600 font-medium text-sm">Featured Collection</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Latest Products
            </h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Discover our newest arrivals and trending products, carefully curated for your lifestyle.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($latestproducts as $product)
            <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100">
                <!-- Product Image Container -->
                <div class="relative overflow-hidden rounded-t-2xl">
                    <div class="aspect-w-1 aspect-h-1 w-full h-64 bg-gray-200">
                        <img src="{{asset('images/products/'.$product->photopath)}}"
                             alt="{{$product->name}}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>

                    <!-- Discount Badge -->
                    @if($product->discounted_price != '')
                    @php
                        $discount = round((($product->price - $product->discounted_price) / $product->price) * 100);
                    @endphp
                    <div class="absolute top-3 left-3">
                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                            -{{$discount}}%
                        </span>
                    </div>
                    @endif

                    <!-- Quick Actions -->
                    <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="flex flex-col space-y-2">
                            <button class="w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-blue-50 transition-colors duration-300">
                                <svg class="w-5 h-5 text-gray-600 hover:text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <button class="w-10 h-10 bg-white rounded-full shadow-lg flex items-center justify-center hover:bg-blue-50 transition-colors duration-300">
                                <svg class="w-5 h-5 text-gray-600 hover:text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Overlay for hover effect -->
                    <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                </div>

                <!-- Product Info -->
                <div class="p-6">
                    <div class="mb-3">
                        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors duration-300">
                            {{$product->name}}
                        </h3>

                        <!-- Rating Stars -->
                        <div class="flex items-center space-x-1 mb-3">
                            @php
                                $averageRating = $product->average_rating;
                                $totalRatings = $product->total_ratings;
                            @endphp
                            @for($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 {{ $i <= floor($averageRating) ? 'text-yellow-400' : ($i - 0.5 <= $averageRating ? 'text-yellow-400' : 'text-gray-300') }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            @endfor
                            <span class="text-sm text-gray-500 ml-2">
                                @if($totalRatings > 0)
                                    ({{ $product->formatted_rating }} - {{ $totalRatings }} {{ $totalRatings == 1 ? 'review' : 'reviews' }})
                                @else
                                    (No reviews yet)
                                @endif
                            </span>
                        </div>
                    </div>

                    <!-- Price Section -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-2">
                            @if($product->discounted_price != '')
                            <span class="text-2xl font-bold text-blue-600">Rs. {{number_format($product->discounted_price)}}</span>
                            <span class="text-lg text-gray-500 line-through">Rs. {{number_format($product->price)}}</span>
                            @else
                            <span class="text-2xl font-bold text-gray-900">Rs. {{number_format($product->price)}}</span>
                            @endif
                        </div>
                    </div>

                    <!-- Action Button -->
                    <a href="{{route('viewproduct',$product->id)}}"
                       class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg flex items-center justify-center space-x-2 group">
                        <span>View Details</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- View All Products Button -->
        <div class="text-center mt-12">
            <a href="#" class="inline-flex items-center space-x-2 bg-white border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white px-8 py-4 rounded-full font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                <span>View All Products</span>
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
    </div>
@endsection
