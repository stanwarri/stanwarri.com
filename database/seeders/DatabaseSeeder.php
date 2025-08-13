<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user for testing
        User::factory()->create([
            'name' => 'Stanley Ojadovwa',
            'email' => 'stanley.warri@gmail.com',
        ]);

        // Seed book community data
        $this->call(BookCommunitySeeder::class);
    }
}
