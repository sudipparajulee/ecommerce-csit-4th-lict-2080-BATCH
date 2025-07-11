<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * Store a rating for a product
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        // Check if user already rated this product
        $existingRating = Rating::where('user_id', Auth::id())
                               ->where('product_id', $request->product_id)
                               ->first();

        if ($existingRating) {
            // Update existing rating
            $existingRating->update([
                'rating' => $request->rating,
                'review' => $request->review,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Rating updated successfully!',
                'rating' => $existingRating
            ]);
        } else {
            // Create new rating
            $rating = Rating::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'rating' => $request->rating,
                'review' => $request->review,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Rating added successfully!',
                'rating' => $rating
            ]);
        }
    }

    /**
     * Get ratings for a product
     */
    public function getProductRatings(Product $product)
    {
        $ratings = $product->ratings()
                          ->with('user:id,name')
                          ->latest()
                          ->get();

        return response()->json([
            'ratings' => $ratings,
            'average_rating' => $product->average_rating,
            'total_ratings' => $product->total_ratings,
            'formatted_rating' => $product->formatted_rating
        ]);
    }

    /**
     * Get user's rating for a specific product
     */
    public function getUserRating(Product $product)
    {
        if (!Auth::check()) {
            return response()->json(['user_rating' => null]);
        }

        $userRating = Rating::where('user_id', Auth::id())
                           ->where('product_id', $product->id)
                           ->first();

        return response()->json(['user_rating' => $userRating]);
    }

    /**
     * Delete a rating
     */
    public function destroy(Rating $rating)
    {
        // Check if the rating belongs to the authenticated user
        if ($rating->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $rating->delete();

        return response()->json([
            'success' => true,
            'message' => 'Rating deleted successfully!'
        ]);
    }
}
