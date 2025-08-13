<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookDistribution>
 */
class BookDistributionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $locations = [
            'Coffee Shop Downtown',
            'Central Library',
            'University Campus',
            'Local Bookstore',
            'Community Center',
            'Park Bench',
            'Train Station',
            'Office Building',
            'Neighborhood Cafe',
            'Friend\'s House'
        ];

        $statuses = ['pending', 'distributed', 'registered'];
        $status = fake()->randomElement($statuses);
        
        return [
            'book_id' => Book::factory(),
            'qr_code' => Str::random(20),
            'distribution_date' => $status !== 'pending' ? fake()->dateTimeBetween('-6 months', 'now') : null,
            'distribution_location' => $status !== 'pending' ? fake()->randomElement($locations) : null,
            'notes' => fake()->optional(0.6)->sentence(),
            'status' => $status,
        ];
    }

    public function pending()
    {
        return $this->state(fn () => [
            'status' => 'pending',
            'distribution_date' => null,
            'distribution_location' => null,
        ]);
    }

    public function distributed()
    {
        return $this->state(fn () => [
            'status' => 'distributed',
            'distribution_date' => fake()->dateTimeBetween('-3 months', 'now'),
            'distribution_location' => fake()->randomElement([
                'Coffee Shop Downtown', 'Central Library', 'University Campus'
            ]),
        ]);
    }

    public function registered()
    {
        return $this->state(fn () => [
            'status' => 'registered',
            'distribution_date' => fake()->dateTimeBetween('-3 months', '-1 week'),
            'distribution_location' => fake()->randomElement([
                'Coffee Shop Downtown', 'Central Library', 'University Campus'
            ]),
        ]);
    }
}
