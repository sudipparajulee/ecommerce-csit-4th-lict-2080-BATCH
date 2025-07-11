<?php

namespace Database\Seeders;

use App\Models\Rating;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing users and products
        $users = User::all();
        $products = Product::all();

        if ($users->isEmpty() || $products->isEmpty()) {
            $this->command->info('No users or products found. Please create some first.');
            return;
        }

        $reviews = [
            'Excellent product! Highly recommended.',
            'Great quality and fast delivery.',
            'Good value for money.',
            'Nice product, satisfied with the purchase.',
            'Could be better but overall satisfied.',
            'Amazing quality, will buy again!',
            'Perfect! Exactly what I needed.',
            'Good product, quick shipping.',
            'Love it! Great customer service too.',
            'Decent product for the price.',
        ];

        // Create sample ratings
        foreach ($products as $product) {
            // Create 1-2 ratings per product (based on available users)
            $numberOfRatings = min(rand(1, 2), $users->count());
            $selectedUsers = $users->random($numberOfRatings);

            foreach ($selectedUsers as $user) {
                // Check if this user already rated this product
                $existingRating = Rating::where('user_id', $user->id)
                                       ->where('product_id', $product->id)
                                       ->first();

                if (!$existingRating) {
                    Rating::create([
                        'user_id' => $user->id,
                        'product_id' => $product->id,
                        'rating' => rand(3, 5), // Random rating between 3-5 stars
                        'review' => $reviews[array_rand($reviews)],
                    ]);
                }
            }
        }

        $this->command->info('Sample ratings created successfully!');
    }
}
