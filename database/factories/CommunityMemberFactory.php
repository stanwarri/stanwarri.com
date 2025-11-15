<?php

namespace Database\Factories;

use App\Models\BookDistribution;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommunityMember>
 */
class CommunityMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $howFoundOptions = [
            'Friend recommendation',
            'Found it in a café',
            'Library book exchange',
            'Gift from stranger',
            'Found on park bench',
            'Office book sharing',
            'Community event',
            'Random encounter',
        ];

        $interestOptions = [
            'Self-improvement',
            'Business & Entrepreneurship',
            'Psychology & Philosophy',
            'Technology & Innovation',
            'Literature & Fiction',
            'Health & Wellness',
            'History & Politics',
            'Science & Nature',
            'Travel & Culture',
            'Arts & Creativity',
        ];

        $messages = [
            'This book came at the perfect time in my life. Thank you for sharing!',
            'Really enjoyed the practical advice. Looking forward to applying these concepts.',
            'What a thoughtful way to build community! Loved the book.',
            'The insights in this book were eye-opening. Grateful for the experience.',
            'Amazing initiative! The book resonated with me deeply.',
            'Thank you for the unexpected gift. This made my day!',
            'Such a unique way to connect with others. The book was fantastic.',
            'Really appreciate the thoughtfulness behind this project.',
        ];

        return [
            'book_distribution_id' => BookDistribution::factory()->registered(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->optional(0.7)->phoneNumber(),
            'message' => fake()->optional(0.8)->randomElement($messages),
            'how_found' => fake()->randomElement($howFoundOptions),
            'interests' => fake()->randomElements($interestOptions, fake()->numberBetween(1, 4)),
            'registered_at' => fake()->dateTimeBetween('-3 months', 'now'),
        ];
    }
}
