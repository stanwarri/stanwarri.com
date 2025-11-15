<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $books = [
            ['title' => 'The Alchemist', 'author' => 'Paulo Coelho'],
            ['title' => 'Atomic Habits', 'author' => 'James Clear'],
            ['title' => 'The 7 Habits of Highly Effective People', 'author' => 'Stephen Covey'],
            ['title' => 'Think and Grow Rich', 'author' => 'Napoleon Hill'],
            ['title' => 'The Power of Now', 'author' => 'Eckhart Tolle'],
            ['title' => 'Man\'s Search for Meaning', 'author' => 'Viktor Frankl'],
            ['title' => 'The Lean Startup', 'author' => 'Eric Ries'],
            ['title' => 'Good to Great', 'author' => 'Jim Collins'],
            ['title' => 'The 4-Hour Workweek', 'author' => 'Tim Ferriss'],
            ['title' => 'How to Win Friends and Influence People', 'author' => 'Dale Carnegie'],
            ['title' => 'The Subtle Art of Not Giving a F*ck', 'author' => 'Mark Manson'],
            ['title' => 'Sapiens', 'author' => 'Yuval Noah Harari'],
        ];

        $book = fake()->randomElement($books);

        return [
            'title' => $book['title'],
            'author' => $book['author'],
            'isbn' => fake()->isbn13(),
            'description' => fake()->paragraph(3),
            'cover_image_url' => fake()->imageUrl(300, 450, 'books', true, $book['title']),
            'purchase_date' => fake()->dateTimeBetween('-1 year', 'now'),
            'purchase_price' => fake()->randomFloat(2, 10, 50),
            'quantity_purchased' => fake()->numberBetween(1, 10),
        ];
    }
}
