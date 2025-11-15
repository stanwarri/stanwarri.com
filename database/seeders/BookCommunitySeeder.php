<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookDistribution;
use App\Models\CommunityMember;
use Illuminate\Database\Seeder;

class BookCommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('🎯 Creating Books...');

        // Create specific popular books
        $popularBooks = [
            [
                'title' => 'The Alchemist',
                'author' => 'Paulo Coelho',
                'description' => 'A magical story about following your dreams and finding your personal legend.',
                'quantity_purchased' => 5,
                'purchase_price' => 15.99,
            ],
            [
                'title' => 'Atomic Habits',
                'author' => 'James Clear',
                'description' => 'The life-changing million-copy bestseller on how tiny changes can make a big difference.',
                'quantity_purchased' => 8,
                'purchase_price' => 18.99,
            ],
            [
                'title' => 'The 7 Habits of Highly Effective People',
                'author' => 'Stephen Covey',
                'description' => 'Powerful lessons in personal change and leadership principles.',
                'quantity_purchased' => 3,
                'purchase_price' => 16.50,
            ],
        ];

        $books = collect();
        foreach ($popularBooks as $bookData) {
            $book = Book::create([
                'title' => $bookData['title'],
                'author' => $bookData['author'],
                'isbn' => fake()->isbn13(),
                'description' => $bookData['description'],
                'cover_image_url' => 'https://via.placeholder.com/300x450/4A90E2/FFFFFF?text='.urlencode($bookData['title']),
                'purchase_date' => fake()->dateTimeBetween('-6 months', '-1 month'),
                'purchase_price' => $bookData['purchase_price'],
                'quantity_purchased' => $bookData['quantity_purchased'],
            ]);
            $books->push($book);
        }

        // Create some additional random books
        $additionalBooks = Book::factory(4)->create();
        $books = $books->merge($additionalBooks);

        $this->command->info("✅ Created {$books->count()} books");

        $this->command->info('📦 Creating Book Distributions...');

        $totalDistributions = 0;
        foreach ($books as $book) {
            // Create distributions for some of the quantity (not all)
            $distributionsToCreate = fake()->numberBetween(1, $book->quantity_purchased - 1);

            // Create distributions with different statuses
            $pendingCount = max(1, intval($distributionsToCreate * 0.3));
            $distributedCount = max(1, intval($distributionsToCreate * 0.4));
            $registeredCount = $distributionsToCreate - $pendingCount - $distributedCount;

            // Pending distributions
            BookDistribution::factory($pendingCount)
                ->pending()
                ->create(['book_id' => $book->id]);

            // Distributed but not registered
            BookDistribution::factory($distributedCount)
                ->distributed()
                ->create(['book_id' => $book->id]);

            // Registered distributions (these will have community members)
            $registeredDistributions = BookDistribution::factory($registeredCount)
                ->registered()
                ->create(['book_id' => $book->id]);

            $totalDistributions += $distributionsToCreate;

            $this->command->info("  📖 {$book->title}: {$distributionsToCreate} distributions ({$pendingCount} pending, {$distributedCount} distributed, {$registeredCount} registered)");
        }

        $this->command->info("✅ Created {$totalDistributions} distributions");

        $this->command->info('👥 Creating Community Members...');

        // Get all registered distributions and create community members for them
        $registeredDistributions = BookDistribution::where('status', 'registered')->get();

        foreach ($registeredDistributions as $distribution) {
            CommunityMember::create([
                'book_distribution_id' => $distribution->id,
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'phone' => fake()->optional(0.7)->phoneNumber(),
                'message' => fake()->optional(0.8)->randomElement([
                    'This book came at the perfect time in my life. Thank you for sharing!',
                    'Really enjoyed the practical advice. Looking forward to applying these concepts.',
                    'What a thoughtful way to build community! Loved the book.',
                    'The insights in this book were eye-opening. Grateful for the experience.',
                    'Amazing initiative! The book resonated with me deeply.',
                ]),
                'how_found' => fake()->randomElement([
                    'Friend recommendation',
                    'Found it in a café',
                    'Library book exchange',
                    'Gift from stranger',
                    'Found on park bench',
                    'Office book sharing',
                    'Community event',
                ]),
                'interests' => fake()->randomElements([
                    'Self-improvement',
                    'Business & Entrepreneurship',
                    'Psychology & Philosophy',
                    'Technology & Innovation',
                    'Literature & Fiction',
                    'Health & Wellness',
                ], fake()->numberBetween(1, 3)),
                'registered_at' => $distribution->distribution_date->addDays(fake()->numberBetween(1, 30)),
            ]);
        }

        $this->command->info("✅ Created {$registeredDistributions->count()} community members");

        $this->command->info('🎉 Seeding completed successfully!');
        $this->command->info('📊 Summary:');
        $this->command->info("  📚 Books: {$books->count()}");
        $this->command->info("  📦 Distributions: {$totalDistributions}");
        $this->command->info("  👥 Community Members: {$registeredDistributions->count()}");
    }
}
