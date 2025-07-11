@extends('layouts.master')
@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Product Details Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
            <!-- Product Image -->
            <div class="space-y-4">
                <div class="aspect-w-1 aspect-h-1 w-full">
                    <img src="{{asset('images/products/'.$product->photopath)}}"
                         alt="{{$product->name}}"
                         class="w-full h-96 object-cover rounded-2xl shadow-lg">
                </div>
            </div>

            <!-- Product Info -->
            <div class="space-y-6">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">{{$product->name}}</h1>
                    <p class="text-gray-600">Category: <span class="font-medium">{{$product->category->name}}</span></p>
                </div>

                <!-- Rating Display -->
                <div class="flex items-center space-x-2">
                    <div class="flex items-center space-x-1">
                        @php
                            $averageRating = $product->average_rating;
                            $totalRatings = $product->total_ratings;
                        @endphp
                        @for($i = 1; $i <= 5; $i++)
                        <svg class="w-5 h-5 {{ $i <= floor($averageRating) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        @endfor
                    </div>
                    @if($totalRatings > 0)
                        <span class="text-lg font-semibold text-gray-700">{{ $product->formatted_rating }}</span>
                        <span class="text-gray-500">({{ $totalRatings }} {{ $totalRatings == 1 ? 'review' : 'reviews' }})</span>
                    @else
                        <span class="text-gray-500">No reviews yet</span>
                    @endif
                </div>

                <!-- Price -->
                <div class="space-y-2">
                    @if($product->discounted_price != '')
                    <div class="flex items-center space-x-3">
                        <span class="text-3xl font-bold text-blue-600">Rs. {{number_format($product->discounted_price)}}</span>
                        <span class="text-xl text-gray-500 line-through">Rs. {{number_format($product->price)}}</span>
                        @php
                            $discount = round((($product->price - $product->discounted_price) / $product->price) * 100);
                        @endphp
                        <span class="bg-red-500 text-white px-2 py-1 rounded-full text-sm font-bold">{{$discount}}% OFF</span>
                    </div>
                    @else
                    <span class="text-3xl font-bold text-gray-900">Rs. {{number_format($product->price)}}</span>
                    @endif
                    <p class="text-green-600 font-medium">In Stock: {{$product->stock}} items</p>
                </div>

                <!-- Add to Cart -->
                <form action="{{route('cart.store')}}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$product->id}}">

                    <div class="flex items-center space-x-4">
                        <label class="text-sm font-medium text-gray-700">Quantity:</label>
                        <div class="flex items-center border border-gray-300 rounded-lg">
                            <button type="button" onclick="decrement()" class="px-3 py-2 hover:bg-gray-100 transition-colors duration-200">-</button>
                            <input type="text" value="1" class="w-16 py-2 text-center border-x border-gray-300" name="quantity" id="quantity" readonly>
                            <button type="button" onclick="increment()" class="px-3 py-2 hover:bg-gray-100 transition-colors duration-200">+</button>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-4 px-8 rounded-xl transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                        </svg>
                        <span>Add to Cart</span>
                    </button>
                </form>

                <!-- Features -->
                <div class="grid grid-cols-3 gap-4 pt-6 border-t border-gray-200">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                                <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1V8a1 1 0 00-1-1h-3z"></path>
                            </svg>
                        </div>
                        <p class="text-sm font-medium">Free Delivery</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-2">
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <p class="text-sm font-medium">24/7 Support</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-2">
                            <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <p class="text-sm font-medium">Easy Return</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Description -->
        @if($product->description)
        <div class="mb-16">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Product Description</h2>
            <div class="bg-gray-50 rounded-xl p-6">
                <p class="text-gray-700 leading-relaxed">{{$product->description}}</p>
            </div>
        </div>
        @endif

        <!-- Ratings & Reviews Section -->
        <div class="space-y-8">
            <h2 class="text-2xl font-bold text-gray-900">Customer Reviews</h2>

            @auth
            <!-- Add Review Form -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Write a Review</h3>
                <form id="ratingForm" class="space-y-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$product->id}}">

                    <!-- Star Rating Input -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Your Rating</label>
                        <div class="flex items-center space-x-1" id="starRating">
                            @for($i = 1; $i <= 5; $i++)
                            <button type="button" data-rating="{{$i}}" class="star-btn focus:outline-none">
                                <svg class="w-8 h-8 text-gray-300 hover:text-yellow-400 transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            </button>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="selectedRating" required>
                    </div>

                    <!-- Review Text -->
                    <div>
                        <label for="review" class="block text-sm font-medium text-gray-700 mb-2">Your Review (Optional)</label>
                        <textarea name="review" id="review" rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                                  placeholder="Share your thoughts about this product..."></textarea>
                    </div>

                    <button type="submit" id="submitRating"
                            class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                        Submit Review
                    </button>
                </form>
            </div>
            @else
            <div class="bg-blue-50 rounded-xl p-6 text-center">
                <p class="text-blue-700">
                    <a href="{{route('login')}}" class="font-semibold hover:underline">Login</a> to write a review
                </p>
            </div>
            @endauth

            <!-- Reviews List -->
            <div id="reviewsList" class="space-y-6">
                <!-- Reviews will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Custom Notification Modal -->
    <div id="notificationModal" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 opacity-0 invisible transition-all duration-300">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all duration-300 scale-95" id="modalContent">
            <div class="p-6">
                <!-- Success Icon -->
                <div class="items-center justify-center w-16 h-16 mx-auto mb-4 bg-green-100 rounded-full" id="successIcon">
                    <svg class="w-8 h-8 text-green-600 mx-auto mt-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>

                <!-- Error Icon -->
                <div class="items-center justify-center w-16 h-16 mx-auto mb-4 bg-red-100 rounded-full opacity-0 invisible" id="errorIcon">
                    <svg class="w-8 h-8 text-red-600 mx-auto mt-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                </div>

                <!-- Modal Title -->
                <h3 class="text-xl font-bold text-center text-gray-900 mb-2" id="modalTitle">
                    Review Submitted!
                </h3>

                <!-- Modal Message -->
                <p class="text-center text-gray-600 mb-6" id="modalMessage">
                    Thank you for your feedback. Your review has been successfully submitted.
                </p>

                <!-- Action Button -->
                <button id="modalCloseBtn"
                        class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                    Continue Shopping
                </button>
            </div>
        </div>
    </div>

    <!-- Rating Validation Modal -->
    <div id="ratingValidationModal" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 opacity-0 invisible transition-all duration-300">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all duration-300 scale-95">
            <div class="p-6">
                <!-- Warning Icon -->
                <div class="items-center justify-center w-16 h-16 mx-auto mb-4 bg-yellow-100 rounded-full">
                    <svg class="w-8 h-8 text-yellow-600 mx-auto mt-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </div>

                <h3 class="text-xl font-bold text-center text-gray-900 mb-2">
                    Rating Required
                </h3>

                <p class="text-center text-gray-600 mb-6">
                    Please select a rating before submitting your review.
                </p>

                <button id="ratingValidationCloseBtn"
                        class="w-full bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                    Got it!
                </button>
            </div>
        </div>
    </div>

    <script>
        // Quantity controls
        let quantity = document.getElementById('quantity');
        function increment(){
            let currentValue = parseInt(quantity.value);
            if (currentValue < {{$product->stock}}) {
                quantity.value = currentValue + 1;
            }
        }
        function decrement(){
            let currentValue = parseInt(quantity.value);
            if (currentValue > 1) {
                quantity.value = currentValue - 1;
            }
        }        // Rating system
        document.addEventListener('DOMContentLoaded', function() {
            const starButtons = document.querySelectorAll('.star-btn');
            const selectedRatingInput = document.getElementById('selectedRating');
            const ratingForm = document.getElementById('ratingForm');
            let selectedRating = 0;

            // Modal elements
            const notificationModal = document.getElementById('notificationModal');
            const ratingValidationModal = document.getElementById('ratingValidationModal');
            const modalTitle = document.getElementById('modalTitle');
            const modalMessage = document.getElementById('modalMessage');
            const successIcon = document.getElementById('successIcon');
            const errorIcon = document.getElementById('errorIcon');

            // Modal functions
            function showNotificationModal(isSuccess = true, title = '', message = '') {
                modalTitle.textContent = title;
                modalMessage.textContent = message;

                if (isSuccess) {
                    successIcon.classList.remove('opacity-0', 'invisible');
                    errorIcon.classList.add('opacity-0', 'invisible');
                } else {
                    successIcon.classList.add('opacity-0', 'invisible');
                    errorIcon.classList.remove('opacity-0', 'invisible');
                }

                notificationModal.classList.add('flex');
                notificationModal.classList.remove('opacity-0', 'invisible');
                notificationModal.querySelector('#modalContent').classList.remove('scale-95');
                notificationModal.querySelector('#modalContent').classList.add('scale-100');
            }

            function hideNotificationModal() {
                notificationModal.classList.add('opacity-0', 'invisible');
                notificationModal.classList.remove('flex');
                notificationModal.querySelector('#modalContent').classList.add('scale-95');
                notificationModal.querySelector('#modalContent').classList.remove('scale-100');
            }

            function showRatingValidationModal() {
                ratingValidationModal.classList.add('flex');
                ratingValidationModal.classList.remove('opacity-0', 'invisible');
                ratingValidationModal.querySelector('div').classList.remove('scale-95');
                ratingValidationModal.querySelector('div').classList.add('scale-100');
            }

            function hideRatingValidationModal() {
                ratingValidationModal.classList.add('opacity-0', 'invisible');
                ratingValidationModal.classList.remove('flex');
                ratingValidationModal.querySelector('div').classList.add('scale-95');
                ratingValidationModal.querySelector('div').classList.remove('scale-100');
            }

            // Close modal events
            document.getElementById('modalCloseBtn').addEventListener('click', hideNotificationModal);
            document.getElementById('ratingValidationCloseBtn').addEventListener('click', hideRatingValidationModal);

            // Close modals when clicking backdrop
            notificationModal.addEventListener('click', function(e) {
                if (e.target === notificationModal) {
                    hideNotificationModal();
                }
            });

            ratingValidationModal.addEventListener('click', function(e) {
                if (e.target === ratingValidationModal) {
                    hideRatingValidationModal();
                }
            });

            // Star rating interaction
            starButtons.forEach(button => {
                button.addEventListener('click', function() {
                    selectedRating = parseInt(this.dataset.rating);
                    selectedRatingInput.value = selectedRating;
                    updateStarDisplay();
                });

                button.addEventListener('mouseover', function() {
                    const hoverRating = parseInt(this.dataset.rating);
                    highlightStars(hoverRating);
                });
            });

            document.getElementById('starRating').addEventListener('mouseleave', function() {
                updateStarDisplay();
            });

            function highlightStars(rating) {
                starButtons.forEach((button, index) => {
                    const star = button.querySelector('svg');
                    if (index < rating) {
                        star.classList.remove('text-gray-300');
                        star.classList.add('text-yellow-400');
                    } else {
                        star.classList.remove('text-yellow-400');
                        star.classList.add('text-gray-300');
                    }
                });
            }

            function updateStarDisplay() {
                highlightStars(selectedRating);
            }

            // Submit rating
            if (ratingForm) {
                ratingForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    if (selectedRating === 0) {
                        showRatingValidationModal();
                        return;
                    }

                    const formData = new FormData(this);
                    const submitButton = document.getElementById('submitRating');

                    submitButton.disabled = true;
                    submitButton.innerHTML = `
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Submitting...
                    `;

                    fetch('{{route("ratings.store")}}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showNotificationModal(
                                true,
                                'Thank You! 🎉',
                                data.message + ' Your feedback helps other customers make better decisions.'
                            );
                            document.getElementById('review').value = '';
                            selectedRating = 0;
                            selectedRatingInput.value = '';
                            updateStarDisplay();
                            loadReviews();

                            // Reload page after 3 seconds to update ratings display
                            setTimeout(() => {
                                location.reload();
                            }, 3000);
                        } else {
                            showNotificationModal(
                                false,
                                'Oops! Something went wrong',
                                data.message || 'There was an error submitting your review. Please try again.'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotificationModal(
                            false,
                            'Connection Error',
                            'Unable to submit your review. Please check your connection and try again.'
                        );
                    })
                    .finally(() => {
                        submitButton.disabled = false;
                        submitButton.innerHTML = 'Submit Review';
                    });
                });
            }

            // Load reviews
            function loadReviews() {
                fetch('{{route("ratings.product", $product->id)}}')
                    .then(response => response.json())
                    .then(data => {
                        displayReviews(data.ratings);
                    })
                    .catch(error => {
                        console.error('Error loading reviews:', error);
                    });
            }

            function displayReviews(reviews) {
                const reviewsList = document.getElementById('reviewsList');

                if (reviews.length === 0) {
                    reviewsList.innerHTML = `
                        <div class="text-center py-8 text-gray-500">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <p>No reviews yet. Be the first to review this product!</p>
                        </div>
                    `;
                    return;
                }

                const reviewsHTML = reviews.map(review => `
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-semibold">${review.user.name.charAt(0).toUpperCase()}</span>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900">${review.user.name}</h4>
                                    <div class="flex items-center space-x-1">
                                        ${[1,2,3,4,5].map(i => `
                                            <svg class="w-4 h-4 ${i <= review.rating ? 'text-yellow-400' : 'text-gray-300'}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        `).join('')}
                                    </div>
                                </div>
                            </div>
                            <span class="text-sm text-gray-500">${new Date(review.created_at).toLocaleDateString()}</span>
                        </div>
                        ${review.review ? `<p class="text-gray-700 leading-relaxed">${review.review}</p>` : ''}
                    </div>
                `).join('');

                reviewsList.innerHTML = reviewsHTML;
            }

            // Load reviews on page load
            loadReviews();
        });
    </script>
@endsection
